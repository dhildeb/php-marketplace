<?php 
include 'header.php';
require PROJECT_ROOT_PATH.'/vendor/autoload.php';
//relocate if not logged in
if(!$profile){
  header('location: index.php?action=login');
}

echo "<h1 class='text-center my-5'>Welcome $profile[name]</h1>";

include 'footer.php';