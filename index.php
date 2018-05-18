<?php
require_once('config.php');
function db_init($host, $duser, $dpw, $dname){
$conn=mysqli_connect($host,$duser, $dpw);
mysqli_select_db($conn,$dname);
return $conn;
}
$conn=db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]); // $conn=mysqli_connect('localhost','root','dydgh12'); mysqli_select_db($conn,'openttorials2');
$result=mysqli_query($conn,"SELECT*FROM topic");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>생활코딩</title>
<link rel="stylesheet"  href="css.css">

  </head>
  <body id="body">
    <header>
      <a href="index.php" style="text-decoration:none"><h1>생활코딩 JavaScript</h1></a>

    </header>
    <nav>
    <ol>
<?php

while($row=mysqli_fetch_assoc($result)){
echo '<li><a href="index.php?id='.$row['id'].'" style="text-decoration:none">'.htmlspecialchars($row['title'])."</a></li>";
};
?>
</ol>
    </nav>
<article>
<?php
if(empty($_GET['id'])){
echo "Nice to meet you!";
}else{
$id=mysqli_real_escape_string($conn,$_GET['id']);
$sql = "SELECT topic.id, topic.title, topic.description, user.name, topic.created FROM `topic` LEFT JOIN user ON topic.author=user.id WHERE topic.id=".$id;
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
echo "<h2>".htmlspecialchars($row['title'])."</h2>";
echo strip_tags($row['description'],'<a><h1><h2><h3><ul><ol>');
echo "</br>";?>
<?= htmlspecialchars($row['created'])." | ".htmlspecialchars($row['name'])?>
<?php
}
?>
<hr>
<div class="button">
<input type="button" name="white" value="White" onclick="document.getElementById('body').className=''">
<input type="button" name="black" value="Black" onclick="document.getElementById('body').className='black'">
<a href="write.php" style="text-decoration:none"><input type="button" name="write" value="쓰기"></a>
</div>
</article>
  </body>
</html>
