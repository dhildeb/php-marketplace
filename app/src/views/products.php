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
  <div class='col-3 d-flex flex-column p-3'>
    <div class='border rounded shadow product click p-3' onclick='changeRoute(`http://localhost/test.php/index.php?action=$p[id]`)'>
      <sup>Category: $p[category]</sup>
      <b class='text-center'>$p[title]</b>
      <p>$p[description]</p>
      <div class='d-flex justify-content-around'
        <p>Price: $$p[price]</p>
        <p>Quantity $p[quantity]</p>
      </div>
      <img class='img-fluid' src='$p[picture]' alt='$p[picture]' title='$p[title]'>
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