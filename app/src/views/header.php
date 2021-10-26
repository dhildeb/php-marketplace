<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="app/src/assets/css/style.css" />
  <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- paypal -->
<script
src='https://www.paypal.com/sdk/js?client-id=ATPgYFG5OhTeDEmSm2Pg7KjPgsKuIbuXLOCiEP-_IZJ1YqF7s1eHCLOeXCBZTQ-tFiCa-nmU73tk2-4i&currency=USD'>
</script>
  <script type="text/javascript" src="app\src\util\jsFunctions.js"></script>

  <title>PHP Template</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <a class="text-white mr-3" href="?action=home">Home</a>
          <a class="text-white mr-3" href="?action=products">Products</a>
          <a class="text-white mr-3" href="?action=cart">Cart</a>

          <?php
            require PROJECT_ROOT_PATH.'/vendor/autoload.php';
            require PROJECT_ROOT_PATH.'/app/src/app.php';

            // get userinfo from auth0 login
            $user = onIndexRoute();

            if($user){
            // get profile from email that logged in, if user isnt in the database yet add them.
              $profile = $profileController->getProfileByEmail($user['email']);

              if(is_null($profile)){
                $profile = $profileController->createProfile($user['nickname'], $user['email'], $user['picture']);
              }
              
              echo "<a class='text-white' href='?action=logout'>Logout</a>";

            }else{
              echo "Please <a class='text-white' href='?action=login'>Login</a>";
            }
          ?>

        </ul>
      </div>
    </div>
  </nav>