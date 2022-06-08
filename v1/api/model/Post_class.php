<?php

class Post {
  //private properties for database
  private $db;
  private $table = "panel_blog";

  //get property
  public $get_id;

  //post properties
  public $hash_id;
  public $title;
  public $category;
  public $body;
  public $image;
  public $visibility = "show";

  //Automicatically do this when object is instantiated with class Post
  public function __construct($con, $gid=""){
    $this->db = $con;
    $this->get_id = $gid;
  }

  //The method to fetch contents
  public function read(){

    $query = '
        SELECT b.id, b.hash_id, b.input_title, c.input_blog_category AS category, text_body,	image_1
        FROM '.$this->table.' AS b INNER JOIN selection_blog_category AS c ON b.select_blog_category = c.hash_id
    ';

    if($this->get_id != ""){
      $get_id_query = $query . "
      WHERE b.hash_id = ?
      ";
    }

    $stmt = $this->db->prepare($query);
    if($this->get_id != ""){
      $stmt = $this->db->prepare($get_id_query);
      $stmt->bindParam(1, $this->get_id);
    }
    $stmt->execute();

    return $stmt;
  }

  //The method to insert/create contents
  public function create(){
    $query = '
        INSERT INTO '.$this->table.' (hash_id,input_title,select_blog_category,text_body,image_1,visibility) VALUES(:hash_id,:input_title,:select_blog_category,:text_body,:image_1,:visibility)
    ';

    $stmt = $this->db->prepare($query);

    //Clean data
    $this->hash_id = htmlspecialchars(strip_tags($this->hash_id));
    $this->title = htmlspecialchars(strip_tags($this->title));
    $this->category = htmlspecialchars(strip_tags($this->category));
    $this->body = htmlspecialchars(strip_tags($this->body));
    $this->image = htmlspecialchars(strip_tags($this->image));
    $this->visibility = htmlspecialchars(strip_tags($this->visibility));

    //bind Parameters
    $stmt->bindParam(":hash_id", $this->hash_id);
    $stmt->bindParam(":input_title", $this->title);
    $stmt->bindParam(":select_blog_category", $this->category);
    $stmt->bindParam(":text_body", $this->body);
    $stmt->bindParam(":image_1", $this->image);
    $stmt->bindParam(":visibility", $this->visibility);


    if($stmt->execute()){
      return true;
    }

    printf("Error: %s.\n", $stmt->error);
    return false;

  }

  //The method to update contents
  public function update(){
    $query = '
        UPDATE '.$this->table.'
        SET
          input_title = :input_title,
          select_blog_category = :select_blog_category,
          text_body = :text_body,
          image_1 = :image_1,
          visibility = :visibility
        WHERE
          hash_id = :hash_id
    ';

    $stmt = $this->db->prepare($query);

    // clean data
    $this->hash_id = htmlspecialchars(strip_tags($this->hash_id));
    $this->title = htmlspecialchars(strip_tags($this->title));
    $this->category = htmlspecialchars(strip_tags($this->category));
    $this->body = htmlspecialchars(strip_tags($this->body));
    $this->image = htmlspecialchars(strip_tags($this->image));
    $this->visibility = htmlspecialchars(strip_tags($this->visibility));

    //bind Parameters
    $stmt->bindParam(":hash_id", $this->hash_id);
    $stmt->bindParam(":input_title", $this->title);
    $stmt->bindParam(":select_blog_category", $this->category);
    $stmt->bindParam(":text_body", $this->body);
    $stmt->bindParam(":image_1", $this->image);
    $stmt->bindParam(":visibility", $this->visibility);


    if($stmt->execute()){
      return true;
    }

    printf("Error: %s.\n", $stmt->error);
    return false;

  }

  //method to delete
  public function delete(){
    $query = '
      DELETE FROM '.$this->table.' WHERE hash_id = :id
    ';

    $stmt = $this->db->prepare($query);
    $stmt->bindParam(":id", $this->hash_id);

    if($stmt->execute()){
      return true;
    }

    printf("Error: %s.\n", $stmt->error);
    return false;

  }
}
