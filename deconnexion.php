<?php
session_start();
session_unset();
session_destroy();
echo "<span style=\"color:red;font-size:1.6em;\">Vous avez bien deconnecté</span>";

?>
<!DOCTYPE html>
<html>
<head>
	<title>deconnexion</title>
	<meta charset="utf-8">
	<style type="text/css">
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
           
.article{
	position:absolute;
      text-align:center;
      width:300px;
      padding-left:20px;
      
}
h1{
	font-weight: bold;
	font-size: 1.5em;
	color:#48cae4;
}

	</style>
</head>
<body>
     <div class="article">
           <h1>voici le menu</h1>
           <span class="sty"><a href="nouveau.php">ACCEUIL</a></span>
            <span class="sty"><a href="index.php">CREER COMPTE</a></span>
            <span class="sty"><a href="authentification.php">CONNEXION</a></span>
            <span class="sty"><a href="liste.php">ENVOYER UN MESSAGE</a></span>
           <span class="sty"><a href="deconnexion.php">DECONNEXION</a></span>

      </div>
</body>
</html>
