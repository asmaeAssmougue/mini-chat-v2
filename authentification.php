<?php
session_start();
include ('connexion.php');    
if(isset($_POST['connexion'])){
    if(isset($_POST['login']) && isset($_POST['password'])){
    function validate($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

$username = validate($_POST['login']);
$pass = validate($_POST['password']);
if(empty($username)){
    echo "<span style=\"color:#fff; background-color:red;font-size:1.2em;text-align:center;\">the login is required!!</span>";
}else if(empty($pass)){
    echo "<span style=\"color:#fff; background-color:red;font-size:1.2em;text-align:center;\">the password is required!!</span>";
}else{ 
    $sql = "SELECT * FROM `user` WHERE login ='$username'";
    $reslt = mysqli_query($link, $sql);
    if(mysqli_num_rows($reslt) === 1){
        $row = mysqli_fetch_assoc($reslt);
        if($row['login'] == $username && password_verify($pass, $row['pass'])){
            
            $_SESSION['nom'] = $row['nom'];
            $_SESSION['prenom'] = $row['prenom'];
            $_SESSION['login'] = $row['login'];
            header("Location: liste.php?succes=1");
            exit();
        }
        }
    else{
           echo "<span style=\"color:#fff; background-color:red;font-size:1.2em;text-align:center;\">the password or login is incorrect!!</span>";

        }
    }
    
}
}

?>
<!DOCTYPE html>
<html>
<head>
   <title>Login</title>
   <style type="text/css">
    body{
      padding-right:10px;
      padding-top:20px;
      min-height:600px;
      width:900px;
     margin:auto;
    }
    #monform{
      margin:auto;
      width:50%;
    }
    #monform input{
      display:block;
      margin:20px;
      padding:5px;
      border:1px solid #00b4d8;
      width:90%;
      height:30px;
      border-radius:10px;
    }
    #monform input[type="submit"]{
      cursor: pointer;

    }
    .sty{
                  display:inline-block;
                  width:250px;
                  background: blue;
                  border:1px solid #fff;
                  
                  font-size:1.2em;
                  text-align:center;
            }
            a{
                  text-decoration:none;
                  color:#fff;
            }
            article,aside{
     display:inline-block;
      vertical-align: top;
}
article{
  position:absolute;
      width:250px;
      padding-left:10px;
      float:left;
      left:10px;
      top:5px;
}
aside{
      position:absolute;
      width:950px;
    margin-bottom:10px;
    float:right;
    right:20px;
   
}
h1{
  color:#f72585;
}
  </style>


</head>
<body>
  <article>
            <h1>Le menu:</h1>
            <span class="sty"><a href="nouveau.php">ACCEUIL</a></span>
            <span class="sty"><a href="index.php">CREER COMPTE</a></span>
            <span class="sty"><a href="authentification.php">CONNEXION</a></span>
            <span class="sty"><a href="liste.php">ENVOYER UN MESSAGE</a></span>
           <span class="sty"><a href="deconnexion.php">DECONNEXION</a></span>

      </article>
      <aside>
  <form action="" method="post" id="monform"> 
    <?php if(isset($_GET['error'])){ ?>
    <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>
    <label>Login</label>
    <input type="text" name="login" placeholder="login"><br>
    <label>Password</label>
    <input type="password" name="password" placeholder="password"><br>
    <input type="submit" name="connexion" value="connexion">
    

</form>
</aside>
</body>    
</html>
<?php  mysqli_close($link); ?>


