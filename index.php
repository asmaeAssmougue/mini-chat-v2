<?php
session_start();
include ("connexion.php");
if(isset($_POST['envoyer'])){
  
  function validate($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
$pass = validate($_POST['password']);
$login = validate($_POST['login']);
$re_pass = validate($_POST['re_password']);
$nom =validate($_POST['nom']);
$prenom =validate($_POST['prenom']);

$user_data = 'login='. $login. '&nom='. $nom;
 if(isset($_FILES['fichier']) and $_FILES['fichier']['error']==0)
  {
    $dossier = 'photo/';
    $temp_name = $_FILES['fichier']['tmp_name'];
    if(!is_uploaded_file($temp_name))
    {
            exit("le fichier est introuvable");
    }
        if($_FILES['fichier']['size'] >= 1000000){
          exit("Erreur le fichier est volumineux");
        }
        $infosfichier = pathinfo($_FILES['fichier']['name']);
        $extension_upload = $infosfichier['extension'];
        $extension_upload = strtolower($extension_upload);
        $extensions_autorisee = array('jpg','png','jpeg');
        if(!in_array($extension_upload,$extensions_autorisee))
        {
          exit("Erreur , veuillez inserer une image(extension autorise: png)");

        }
        $nom_photo=$login.".".$extension_upload;
        if(!move_uploaded_file($temp_name, $dossier.$nom_photo)){
          exit("Problem dans le téléchargement de l'image, ressayez");

        }
        $ph_name=$nom_photo;
        
  }
  else{
     $ph_name="inconnu.jpg";
  }
if(empty($pass)){
  header("Location: index.php?error=Password is required&$user_data");
  exit();
}else if(empty($login)){
  header("Location: index.php?error=name is required&$user_data");
  exit();
}
else if(empty($re_pass)){
  header("Location: index.php?error=Re Password is required&$user_data");
  exit();
}
else if($re_pass != $pass){
  header("Location: index.php?error=the confirmation password does not match&$user_data");
  exit();
}
else{
 
  
  $sql = "SELECT * FROM `user` WHERE login = '$login'";
  $reslt = mysqli_query($link, $sql);
  if(mysqli_num_rows($reslt) > 0){
    
      header("Location: index.php?error=The login is taken try another&$user_data");
      exit();
    }
    else{
      $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
      $sql2 = "INSERT INTO `user`(`login`, `pass`, `nom`, `prenom`, `photo`) VALUES ('$login', '$pass_hash', '$nom','$prenom','$ph_name')";
      $reslt2 = mysqli_query($link, $sql2);
      if($reslt2){
        header("Location: authentification.php?success=Your account has been created successflly");
      exit();
      }
      else{
        header("Location: index.php?error=unknown error occurred&$user_data");
      exit();
      }

    }
  
}
}
else{
  
  ?>
<!DOCTYPE html>
<html>
<head>
	 <title>Creer compte</title>
	 <link rel="stylesheet" type="text/css" href="style.css">
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
	<form action="" method="post" enctype="multipart/form-data">
    <h2>Veuilllez remplir ce formulaire pour s'inscrire</h2>	
    <?php if(isset($_GET['error'])){ ?>
    <p class="error"><?php echo $_GET['error'];  ?></p>
    <?php } ?>

    <?php if(isset($_GET['success'])){ ?>
    <p class="success"><?php echo $_GET['success'] ?></p>
    <?php } ?>


    <label>login</label>
    <?php if(isset($_GET['login'])){ ?>
    <input type="text" name="login" placeholder="login" value="<?php echo $_GET['login'];  ?>"><br>
    <?php }else{ ?>
    <input type="text" name="login" placeholder="login"><br>
    <?php } ?>
    <label>mot de passe</label>
    <input type="password" name="password" placeholder="password"><br>
    <label>mot de passe(verification)</label>
    <input type="password" name="re_password" placeholder="re_password"><br>
  
          <label>Nom</label>
    <?php if (isset($_GET['nom'])) { ?>
               <input type="text" 
                      name="nom" 
                      placeholder="nom"
                      value="<?php echo $_GET['nom']; ?>"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="nom" 
                      placeholder="nom" required="required"><br>
          <?php }?>
          <label>Prenom</label>
    <?php if (isset($_GET['prenom'])) { ?>
               <input type="text" 
                      name="prenom" 
                      placeholder="prenom"
                      value="<?php echo $_GET['prenom']; ?>"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="prenom" 
                      placeholder="prenom" required="required"><br>
          <?php }?>
    
    <label for="photo">image personnelle:</label>
       <input type="file" name="fichier"><br><br>
    <button type="submit" name="envoyer">envoyer</button>
    <a href="authentification.php" class="ca">Already have an account</a>

</form>
</aside>
</body>	 	 
</html>
<?php } mysqli_close($link); ?>	
