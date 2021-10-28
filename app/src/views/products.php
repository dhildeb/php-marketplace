<?php 
include 'header.php';
require PROJECT_ROOT_PATH.'/vendor/autoload.php';

$products = $productController->getProducts();

// create new product
if(isset($_POST['productSubmit'])){
  $category = htmlspecialchars($_POST["category"] ?? '', ENT_QUOTES);
  $price = htmlspecialchars($_POST["price"] ?? '', ENT_QUOTES);
  $quantity = htmlspecialchars($_POST["quantity"] ?? '', ENT_QUOTES);
  $picture = htmlspecialchars($_POST["picture"] ?? '', ENT_QUOTES);
  $title = htmlspecialchars($_POST["title"] ?? '', ENT_QUOTES);
  $description = htmlspecialchars($_POST["description"] ?? '', ENT_QUOTES);
  $productController->createProduct($category, $_POST['ownerId'], $picture, $title, $description, $price, $quantity);
  header("location: index.php?action=products");
}
include 'productCreationModal.php';

?>
<!-- HTML -->

<div class="container">
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#productCreation"
    onclick="toggleModal('productCreation')">
    Post a product for Sale!
  </button>

  <div class="row justify-content-between mt-5">

<?php

foreach($products as $p){
  echo "
  <div class='col-3 p-3'>
    <div class='bg-white border rounded shadow product d-flex flex-column click p-3' 
    onclick='changeRoute(`http://localhost/test.php/index.php?action=$p[id]`)'
    >
      <sup>Category: $p[category]</sup>
      <b class='text-center py-2'>$p[title]</b>
      <span id='$p[id]' class='text-hidden pb-1'>$p[description]</span>
      <sub onclick='toggleClass(`$p[id]`, `text-hidden`, event)'>load more...</sub>
      <img class='img-fluid p-img' src='$p[picture]' alt='$p[picture]' title='$p[title]'>
      <div class='d-flex justify-content-around mt-3'>
      <p>Price: $$p[price]</p>
      ";
      if(!$p['quantity']){
        echo "<p class='text-danger'>Out of Stock</p>";
      }
      echo "
      </div>
    </div>
  </div>
  ";
}

?>

    <!-- HTML -->
  </div>
</div>

<?php

include 'footer.php';