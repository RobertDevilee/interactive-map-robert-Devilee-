<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form method= "post">
   <div onderwerp="mb-3">
      <label>Name</label><br>
      <input type="text" name="naam"/><br>
    </div>
   <div onderwerp="mb-3">
      <label >Email address</label><br>
      <input type="email" name="email"  placeholder="name@example.com" /><br>
    </div>
    <div onderwerp="mb-3">
      <label >onderwerp</label><br>
      <input type="text" name="onderwerp"  /><br>
    </div>
    <div onderwerp="mb-3">
      <label >bericht</label><br>
      <input type="textarea" name="bericht"  /><br>
    </div>
      <input type="submit" name="verzend"   />

</form>

<?php

session_start();
if(isset($_POST['verzend'])) {
  
  if (!empty($_POST['naam']) && !empty($_POST['email'])&& !empty($_POST['onderwerp'])&& !empty($_POST['bericht']) && !empty($_POST['akkord'])) {
    $check = filter_input(INPUT_POST ,'email', FILTER_VALIDATE_EMAIL);
  }
  else {
     echo  "je vergeet een veld je modet alle velden goed invullen";
  }
  if($check === false ){
    echo 'email is no correet';
  }
  else {
    $nameLand= $_SESSION['naam'] = $_POST['naam'];
    $emailUser=$_SESSION['email'] = $_POST['email'];
     $onderwerpUser=$_SESSION['onderwerp'] = $_POST['onderwerp'];
     $berichtUser=$_SESSION['bericht'] = $_POST['bericht'];
     
     //echo '<script>location.replace("index.php")</script>';
  
   }
}



try {
    $db = new PDO("mysql:host=localhost;dbname=map","root","");
    $quyre = $db->prepare("INSERT INTO `land`(`landnaam`, `email`, `onderwerp`, `bericht`) VALUES (:naam, :email, :onderwerp, :bericht)");
    $quyre->bindParam('naam', $nameLand);
    $quyre->bindParam('email', $emailUser);
    $quyre->bindParam('onderwerp', $onderwerpUser);
    $quyre->bindParam('bericht', $berichtUser);

    $quyre->execute();
    $result = $quyre->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($result);

}catch (PDOException $e){
    
    die("ERROR!".$e->getMessage());

}


?>