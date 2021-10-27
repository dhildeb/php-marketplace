<?php

class Product{

  public $id;
  public $category;
  public $price;
  public $available;
  public $ownerId;
  public $quantity;
  public $picture;
  public $title;
  public $description;

  function __construct($newCategory, $newOwnerId, $newPicture, $newTitle, $newDescription, $newPrice = 0.01, $newQuantity = 1)
  {
    $this->id = uniqid();
    $this->category = $newCategory;
    $this->ownerId = $newOwnerId;
    $this->price = intval($newPrice);
    $this->picture = $newPicture;
    $this->title = $newTitle;
    $this->description = $newDescription;
    $this->quantity = intval($newQuantity);
    $this->available = $this->quantity > 0 ? 1 : 0;
  }
}