<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-type, Access-Control-Allow-Methods, Authorization, X-Request-With");

$post = new Post($conn);

//get the post values and decode it cos its coming in json format
$data  = json_decode(file_get_contents("php://input"));

//set ID that would be used to DELETE
$post->hash_id = $data->id;

if($post->update()){
  echo json_encode([
    "message" => "Post Deleted Successfully"
  ]);
}else{
  echo json_encode([
    "message" => "Post Not Deleted, Something went wrong!!!"
  ]);
}
 ?>
