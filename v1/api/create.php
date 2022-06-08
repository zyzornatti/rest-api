<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-type, Access-Control-Allow-Methods, Authorization, X-Request-With");

$post = new Post($conn);

//get the post values and decode it cos its coming in json format
$data  = json_decode(file_get_contents("php://input"));
// echo json_encode($data);
// die;
$post->hash_id = $data->hash_id;
$post->title = $data->title;
$post->category = $data->category;
$post->body = $data->body;
$post->image = $data->image;

if($post->create()){
  echo json_encode([
    "message" => "Post Created Successfully"
  ]);
}else{
  echo json_encode([
    "message" => "Post Not Created, Something went wrong!!!"
  ]);
}
 ?>
