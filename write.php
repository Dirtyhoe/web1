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
  <p>
  <form class="write" action="process.php" method="post">
    <label for="title1">title :</label></br>
    <input type="text" id="title1" name="title">
  </p>

  <p>
    <label for="name">name :</label></br>
    <input type="text" id="name" name="author">
  </p>

  <p>
    <label for="description">description :</label>
    <textarea name="description" id="description" rows="8" cols="70"></textarea>

  </p>
<input type="submit" value="Submit">
  </form>



<hr>
<div class="button">
<input type="button" name="white" value="White" onclick="document.getElementById('body').className=''">
<input type="button" name="black" value="Black" onclick="document.getElementById('body').className='black'">
<a href="write.php" style="text-decoration:none"><input type="button" name="write" value="쓰기"></a>
</div>
</article>
  </body>
</html>
