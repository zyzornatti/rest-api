<?php
$uri = explode("/",$_SERVER['REQUEST_URI']);


if (count($uri) > 2) {

  if (!empty($_GET)) {
  $query_string = explode("?",$uri[2])[1];
}else{
  $query_string = "";
}

  switch ($uri[1]."/".$uri[2]) {
    case 'api/read':
    include APP_PATH."/api/read.php";
    break;

    case 'api/read?'.$query_string:
    include APP_PATH."/api/read.php";
    break;

    case 'api/create':
    include APP_PATH."/api/create.php";
    break;

    case 'api/update':
    include APP_PATH."/api/update.php";
    break;

    case 'api/delete':
    include APP_PATH."/api/delete.php";
    break;



  }

}else{
  if (!empty($_GET)) {
  $query_string = explode("?",$uri[1])[1];
}else{
  $query_string = "";
}
  // $query_string = explode("?",$uri[1])[1];
  switch ($uri[1]) {
    case 'test':
    include APP_PATH."/admin/test.php";
    break;

    case 'test?'.$query_string:
    include APP_PATH."/admin/test.php";
    break;

    case '':
    include APP_PATH."/views/home.php";
    break;

    case 'home':
    include APP_PATH."/views/home.php";
    break;


  }

}






 ?>
