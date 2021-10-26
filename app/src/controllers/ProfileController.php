<?php
require PROJECT_ROOT_PATH.'/vendor/autoload.php';

class ProfileController{

  private $db;

  function __construct()
  {
    $this->db = new Database();
  }

  public function getProfiles(){
    $dictionary = [];
    $sql = "SELECT * FROM account";
    $res = $this->db->conn->query($sql);
    if ($res->num_rows > 0) {
      while($row = $res->fetch_assoc()) {
        array_push($dictionary, new Profile($row['id'], $row["email"], $row["name"], $row["picture"]));
      }
    } else {
      echo "0 results";
    }
    return $dictionary;
  }

  public function getProfileByEmail($email){
    $stmt = $this->db->conn->prepare("SELECT * FROM account WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();
    if(!$res){
      console_log('no profile found');
      return;
    }
    $profile = $res->fetch_assoc();
    return $profile;
  }

  public function getProfileById($id){
    $stmt = $this->db->conn->prepare("SELECT * FROM account WHERE id=?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    if(!$res){
      console_log('no profile found');
      return;
    }
    $profile = $res->fetch_assoc();
    return $profile;
  }

  public function createProfile($newName, $newEmail, $newPicture){
    $newProfile = new Profile($newName, $newEmail, $newPicture);
    $stmt = $this->db->conn->prepare("INSERT INTO account (id, name, email, picture) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
      die ("Statement Error: " . $this->db->conn->error);
    }
    $stmt->bind_param("ssss", $newProfile->id, $newProfile->name, $newProfile->email, $newProfile->picture);
    $stmt->execute();
    $stmt->close();
    }
  
  public function deleteEnetry($id){
    $query = 'DELETE FROM account WHERE id = ?';
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