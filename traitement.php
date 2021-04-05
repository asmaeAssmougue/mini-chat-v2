<?php
include('connexion.php');
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>traitement</title>
	<meta charset="utf-8">
</head>
<body>
      <?php
      
      if(empty($_SESSION['login'])){
            header('Location: authentification.php?emptysession');
            exit();
        }
        else{
            $login=$_SESSION['login'];
            $sql12 = "SELECT * FROM `user` WHERE  `login` = '".$login."'";
        $rest12 = mysqli_query($link, $sql12);
        $data12 = mysqli_fetch_assoc($rest12);
        $id_user=$data12['id_user'];
       $message=addslashes(htmlspecialchars($_GET['message']));
       $sql="INSERT INTO `messages`(`id_user`, `message`) VALUES ('$id_user','$message')";
       $resultat=mysqli_query($link,$sql);
      
       
       header('location: liste.php');
       ?>


</body>
</html>
<?php 
 }
 mysqli_close($link);
 ?>