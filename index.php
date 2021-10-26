<?php
define('PROJECT_ROOT_PATH', __DIR__);

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/app/services/auth.php';

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if(!$action) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
if(!$action) {
  $action = 'home';
  }
}
    
    switch($action){
      case 'login':
        onLoginRoute();
        break;
      case 'logout':
        onLogoutRoute();
        break;
      case 'products':
        include PROJECT_ROOT_PATH.'/app/src/views/products.php';
        break;
      case 'cart':
        include PROJECT_ROOT_PATH.'/app/src/views/cartPage.php';
        break;
      case 'home':
        include PROJECT_ROOT_PATH.'/app/src/views/main.php';
        break;
      default:
        include PROJECT_ROOT_PATH.'/app/src/views/productDetails.php';
    }

function onIndexRoute() {
  global $auth0;
  $session = $auth0->getCredentials();
  if ($session === null) {
    // The user isn't logged in.
    return;
  }
  return $session->user;
}

function onLoginRoute() {
  global $auth0;
  // It's a good idea to reset user sessions each time they go to login to avoid "invalid state" errors, should they hit network issues or other problems that interrupt a previous login process:
  $auth0->clear();
  // Setup the user's session and generate a ULP URL:
  $loginUrl = $auth0->login($_SERVER['AUTH0_REDIRECT_URI']);
  // Finally, redirect the user to the Auth0 Universal Login Page.
  header("Location: " . $loginUrl);
  exit;
}

function onLogoutRoute() {
  global $auth0;
  // Setup the user's session and generate a ULP URL:
  $logoutUrl = $auth0->logout($_SERVER['AUTH0_REDIRECT_URI']);
  // Finally, redirect the user to the Auth0 Universal Login Page.
  header("Location: " . $logoutUrl);
  exit;
}