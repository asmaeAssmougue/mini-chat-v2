<?php
include('connexion.php');
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>message</title>
	<meta charset="utf-8">
    <style type="text/css">
        #forme{
            border:1px solid #00b4d8;
            padding-top:10px;
            width:900px;
            margin-bottom:50px;

        }
        #mess{
            display:inline-block;
            color:red;
            font-size:1.3em;
            font-weight:bold;
            margin-left:10px;
            letter-spacing: 1px;
        }
        input[type="text"]{
            
            width:300px;
           
        }
        #pseud{
            display:inline-block;
            margin-left:50px;
            width:300px;
           
        }
         #messag{
               display: inline-block;
               margin-left:50px;
               width:350px;  
               margin-top:10px;
         }

        input[type="submit"]{
            margin-left:390px;
            margin-bottom:50px;
            margin-top:50px;
            cursor: pointer;
        }
        .button {
   
    float: right;
    background: #555;
    padding: 10px 15px;
    color: #fff;
    border-radius: 5px;
    margin-right: 10px;
    border: none;
    text-decoration:none;
    cursor: pointer;
    position:relative;
    bottom:13vh;
    right:20px;
}
       
    </style>
</head>
<body>
     <form method="get" action="traitement.php" id="forme">
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
        $nom=$data12['nom'];
        $prenom=$data12['prenom'];
        $photo=$data12['photo'];
     
    
        ?>
         <div class="icone">
             <?php
             echo "<img src=\"photo/$photo\" alt=\"photo de profil\"  style=\"width: 70px;height: 70px; border:2px solid purple;border-radius: 50%;\"/>";
    echo '<span id="mess">'.htmlspecialchars($nom)." ".htmlspecialchars($prenom).":"."</span>";
             ?>
         </div>
     	<label for="message" id="messag">Message:</label><input type="text" name="message" id="message"><br>
     	<input type="submit" name="envoyer" value="envoyer"><br>
        <a href="deconnexion.php" class="button">deconnexion</a>
     </form>
    <?php
    
     //recuperer les 10lign
     $sql="SELECT * FROM `messages` ORDER BY id_message DESC LIMIT 0,10 ";
     $result= mysqli_query($link,$sql);
      
     //affichage des mess des donn sont prot
     while ($data=mysqli_fetch_assoc($result)){
        $sql2 = "SELECT * FROM `user` WHERE  `id_user` = '".$data['id_user']."'";
        $rest2 = mysqli_query($link, $sql2);
        $data2 = mysqli_fetch_assoc($rest2);
        $login = $data2['login'];
      
        if(!empty($login)){
      
        
        echo '<span id="mess">'.htmlspecialchars($login).":"."</span>";
        echo  "".htmlspecialchars($data['message'])."<br>";
  }

}
 
      ?>
  
      
</body>
</html>
<?php 
}
 mysqli_close($link);
 ?>