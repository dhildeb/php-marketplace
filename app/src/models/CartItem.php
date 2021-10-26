<?php

class CartItem
{

  public $id;
  public $productId;
  public $profileId;
  public $quantity;
  public $purchased;
  
  function __construct($newProfileId, $newProductId, $newQuantity=1)
  {
    $this->id = uniqid();
    $this->productId = $newProductId;
    $this->profileId = $newProfileId;
    $this->quantity = intval($newQuantity);
    $this->purchased = 0;
  }
  
}