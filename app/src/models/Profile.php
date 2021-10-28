<?php

class Profile
{

  public $id;
  public $name;
  public $email;
  public $picture;
  
  function __construct($newName = "", $newEmail = "", $newPicture = "")
  {
    $this->id = $newId ?? uniqid();
    $this->name = $newName;
    $this->email = $newEmail;
    $this->picture = $newPicture;
  }
  
}
