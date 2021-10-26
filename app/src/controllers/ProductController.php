<?php
require PROJECT_ROOT_PATH.'/vendor/autoload.php';

class ProductController{

  private $db;

  function __construct()
  {
    $this->db = new Database();
  }

  public function getProducts(){
    $products = [];
    $sql = "SELECT * FROM products";
    $res = $this->db->conn->query($sql);
    if ($res->num_rows > 0) {
      while($row = $res->fetch_assoc()) {
        array_push($products, $row);
      }
    } else {
      echo "0 results";
    }
    return $products;
  }

  public function getProductsByCategory($category){
    $products = [];
    $stmt = $this->db->conn->prepare("SELECT * FROM products WHERE category=?");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows > 0) {
      while($row = $res->fetch_assoc()) {
        console_log($row);
        array_push($products, $row);
      }
    } else {
      echo "0 results";
    }
    return $products;
  }

  public function getProductById($id){
    $stmt = $this->db->conn->prepare("SELECT * FROM products WHERE id=?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    if(!$res){
      console_log('no product found');
      return;
    }
    $product = $res->fetch_assoc();
    return $product;
  }

  public function createProduct($category, $ownerId, $picture, $title, $description, $price, $quantity){
    $newProduct = new Product($category, $ownerId, $picture, $title, $description, $price, $quantity);
    $stmt = $this->db->conn->prepare("INSERT INTO products (id, category, price, available, ownerId, quantity, picture, title, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
      die ("Statement Error: " . $this->db->conn->error);
    }
    $stmt->bind_param("ssiisisss", $newProduct->id, $newProduct->category, $newProduct->price, $newProduct->available, $newProduct->ownerId, $newProduct->quantity, $newProduct->picture, $newProduct->title, $newProduct->description);
    $stmt->execute();
    $stmt->close();
    }
  
  public function deleteEnetry($id){
    $query = 'DELETE FROM products WHERE id = ?';
    $stmt = $this->db->conn->prepare($query);
    if(!$stmt){
      error_log('mysqli prepare() failed: ');
      error_log( print_r( htmlspecialchars($stmt->error), true ) );
      exit;
    }
    $stmt->bind_param('s', $id);
    if(!$stmt){
      console_log('error deleting');
    }else{
      console_log('profile deleted');
    }
    $stmt->execute();
    $stmt->close();
  }
  
}