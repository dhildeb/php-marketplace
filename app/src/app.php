<?php
require PROJECT_ROOT_PATH.'/vendor/autoload.php';

// load controllers here, dont forget to 'composer update'
$profileController = new ProfileController();
$productController = new ProductController();
$cartController = new CartController();
?>