<?php
require_once('config.php');
function db_init($host, $duser, $dpw, $dname){
$conn=mysqli_connect($host,$duser, $dpw);
mysqli_select_db($conn,$dname);
return $conn;
}
$conn=db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]); // $conn=mysqli_connect('localhost','root','dydgh12'); mysqli_select_db($conn,'openttorials2');
$author=mysqli_real_escape_string($conn,$_POST['author']);
$sql="SELECT*FROM user WHERE name='{$author}'";
$result=mysqli_query($conn,$sql);


if($result->num_rows==0){

$sql="INSERT INTO `user` (id, name) VALUES (NULL,'{$author}');";
mysqli_query($conn,$sql);
$user_id=mysqli_insert_id($conn);

}else{
  $row=mysqli_fetch_assoc($result);
  $user_id=$row['id'];
}
$title=mysqli_real_escape_string($conn,$_POST['title']);
$description=mysqli_real_escape_string($conn,$_POST['description']);
$sql="INSERT INTO `topic` (`id`, `title`, `description`, `author`, `created`)
VALUES (NULL, '".$title."', '".$description."', '".$user_id."', now());";
$result=mysqli_query($conn,$sql);

header('Location:index.php');


 ?>
