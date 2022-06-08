<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-type: application/json");

  $post = new Post($conn);
  //check if there is get_id and assign it to get_id property
  if(isset($_GET['id'])){
    $post->get_id = $_GET['id'];
  }
  $result = $post->read();
  $num = $result->rowCount();

  if($num > 0) {
    $post_arr = [];
    $post_arr['data'] = [];

      while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $post_items = array(
          'id' => $id,
          'hash_id' => $hash_id,
          'title' => $input_title,
          'category' => $category,
          'body' => html_entity_decode($text_body),
          'image' => $image_1
        );

        array_push($post_arr['data'], $post_items);
      }

    echo json_encode($post_arr);

  }else{
    echo json_encode(
      [
        "message" => "No Post Found"
      ]
    );
  }


 ?>
