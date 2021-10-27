<?php

class DB {
  private $con;
  private $host = "localhost";
  private $dbname = "newsahead";
  private $user = "root";
  private $password = "root";

  public function __construct() {
    $dsn = "mysql:host=" . $this->host . ";dbname=" .
    $this->dbname;

    try{
      $this->con = new PDO($dsn, $this->user, $this->password);
      $this->con->setAttribute(PDO::ATTR_ERRMODE,
      PDO::ERRMODE_EXCEPTION);

    }catch(PDOException $e){
      echo "Connection failed: " . $e->getMessage();
    }
  }

  public function viewData(){
    $query = "SELECT * FROM article1 LIMIT 5";
    $stmt = $this->con->prepare($query);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }

  public function searchData($name){
    $query = "SELECT * FROM article1 WHERE article_title LIKE :name LIMIT 5";
    $stmt = $this->con->prepare($query);
    $stmt->execute(["name" => "%" . $name . "%"]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }
}

?>
