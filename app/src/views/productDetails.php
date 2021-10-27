<?php 
include 'header.php';
require PROJECT_ROOT_PATH.'/vendor/autoload.php';

$product = $productController->getProductById($action);

if(isset($_POST['addToCart'])){
  $cartController->createCartItem($_POST["profileId"], $_POST["productId"], $_POST["quantity"]);
  header("location: index.php?action=cart");
}

if(!$product){
  header("location: index.php?action=home");
}

echo "
<div class='container'>
  <div class='row border rounded shadow mt-5'>
    <div class='col-6 d-flex flex-column p-5'>
      <sup>Category: $product[category]</sup>
      <b class='text-center'>$product[title]</b>
      <p class='flex-fill'>$product[description]</p>
      <div class='d-flex justify-content-around'
        <p>Price: $$product[price]</p>
        ";
        if(!$product['available']){
          echo "<p>Out of Stock</p>";
        }else{
        echo "
        <p>Stock: $product[quantity]</p>
      </div>
      <form action='' method='post' class='d-flex flex-reverse'>
        <input type='hidden' name='productId' value='$product[id]'>
        <input type='hidden' name='profileId' value='$profile[id]'>
        <input class='order-2 qty-num ml-2' type='number' name='quantity' value='1' min='1' max='$product[quantity]'>
        <input class='btn btn-primary ml-3' type='submit' name='addToCart' value='Add To Cart'>
      </form>";
        }
        echo "
    </div>
      <img class='col-6 img-fluid' src='$product[picture]' alt='$product[picture]' title='$product[title]'>
  </div>
</div>
";

include 'footer.php';