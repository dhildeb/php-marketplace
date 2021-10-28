<?php
require PROJECT_ROOT_PATH.'/vendor/autoload.php';

class CartController{

  private $db;
  private $productController;

  function __construct()
  {
    $this->db = new Database();
    $this->productController = new ProductController();
  }

  public function getCartByProfileId($id){
    $cart = [];
    $stmt = $this->db->conn->prepare("SELECT *, c.id AS itemId, p.id AS pId, p.quantity AS qty, c.quantity AS quantity FROM cart as c LEFT JOIN products AS p ON c.productId=p.id WHERE profileId=?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows > 0) {
      while($row = $res->fetch_assoc()) {
        array_push($cart, $row);
      }
    } else {
      echo "0 results";
    }

    return $cart;
  }

  public function createCartItem($profileId, $productId, $quantity){
    $newCartItem = new CartItem($profileId, $productId, $quantity);
    console_log($newCartItem);
    $stmt = $this->db->conn->prepare("INSERT INTO cart (id, profileId, productId, quantity, purchased) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
      die ("Statement Error: " . $this->db->conn->error);
    }
    $res = $stmt->bind_param("sssii", $newCartItem->id, $newCartItem->profileId, $newCartItem->productId, $newCartItem->quantity, $newCartItem->purchased);
    if(!$res){
      console_log("error binding params:".$stmt->error);
    }
    $res = $stmt->execute();
    if(!$res){
      console_log("error executing:".$stmt->error);
    }
    $stmt->close();
    }
  
  public function removeFromCart($id){
    $query = 'DELETE FROM cart WHERE id = ? LIMIT 1';
    $stmt = $this->db->conn->prepare($query);
    if(!$stmt){
      error_log('mysqli prepare() failed: ');
      error_log( print_r( htmlspecialchars($stmt->error), true ) );
      exit;
    }
    $stmt->bind_param('s', $id);
    if(!$stmt){
      console_log('error deleting');
    }
    $stmt->execute();
    $stmt->close();
  }

  public function buyItems($profileId){
    // get all items in profile cart
    $cart = $this->getCartByProfileId($profileId);
    // remove qty from products
    foreach($cart as $c){
      // update product
      $newQty = $c['qty']-$c['quantity'];
      $this->productController->updateProductQty($c['id'], $newQty);
      // remove products from cart
      $this->removeFromCart($c['itemId']);
    }
  }
  
}