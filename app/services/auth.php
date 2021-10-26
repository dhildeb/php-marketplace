<?php
require PROJECT_ROOT_PATH.'/vendor/autoload.php';

  use Auth0\SDK\Auth0;
  use Auth0\SDK\Configuration\SdkConfiguration;
  use Auth0\SDK\Utility\HttpResponse;
  use Buzz\Client\MultiCurl;
  use Nyholm\Psr7\Factory\Psr17Factory;
  
  Dotenv\Dotenv::createImmutable(__DIR__)->safeLoad();
  
  // PSR-17 HTTP Factory (creates http requests and responses)
  $Psr17Library = new Psr17Factory();
  
  // PSR-18 HTTP Client (delivers http requests created by the PSR-17 factory above)
  $Psr18Library = new MultiCurl($Psr17Library);

  $configuration = new SdkConfiguration(
     // The values below are found in the Auth0 dashboard, under application settings:
    domain: $_SERVER['AUTH0_DOMAIN'],
    clientId: $_SERVER['AUTH0_CLIENT_ID'],
    clientSecret: $_SERVER['AUTH0_CLIENT_SECRET'],
    redirectUri: $_SERVER['AUTH0_REDIRECT_URI'],
    scope: ['openid', 'email', 'profile', 'picture'],
    // The secret used to derive an encryption key for the user identity in a session cookie and to sign the transient cookies used by the login callback.
    cookieSecret: $_SERVER['AUTH0_COOKIE_SECRET'],
    // cookieExpires: 3600, REVIEW uncomment to cause reloggin after a time
    // An instance of your PSR-18 HTTP Client library:
    httpClient: $Psr18Library,
    
    // Instances of your PSR-17 HTTP Client library:
    httpRequestFactory: $Psr17Library,
    httpResponseFactory: $Psr17Library,
    httpStreamFactory: $Psr17Library,
  );
  
  $auth0 = new Auth0($configuration);
  
  try{
    $userinfo = $auth0->getUser();
  }catch(Exception $e){
    var_dump($e);
  }

  // Auth0::getCredentials() returns either null if no session is active, or an object.
  $session = $auth0->getCredentials();
  
  // Is this end-user already signed in?
  if ($session === null && isset($_GET['code']) && isset($_GET['state'])) {
    if ($auth0->exchange() === false) {
      die("Authentication failed.");
    }
    // Authentication complete!
    $auth0->getUser();
  }
