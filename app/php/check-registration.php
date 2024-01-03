<?php
session_start();
include "./db_conn.php";

  $username = $_POST["username"];
  $password = $_POST["password"];
  $passwordMd5 = md5($password);
  $email = $_POST["email"];
  $fullName = $_POST["fullName"];
  $telephone = $_POST["telephone"];
  $zupanija = $_POST["zupanija"];
  $grad = $_POST["grad"];
  $isAgency = 0;
  $isUser = 0;
  if (isset($_POST['isAgency'])) $isAgency = 1;
  if (isset($_POST['isUser'])) $isUser = 1;

  $usernameUnique = 1;
  $sql = "SELECT korisnicko_ime FROM users";
  $allUsernames = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($allUsernames)) {
    if($username === $row['korisnicko_ime']) {
      $usernameUnique = 0; 
    }
  }

  $emailUnique = 1;
  $sql = "SELECT email FROM users";
  $allemails = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($allemails)) {
    if($email === $row['email']) {
      $emailUnique = 0; 
    }
  }

  echo "<br>";
var_dump($usernameUnique);
echo "<br>";
var_dump($emailUnique);
echo "<br>";

if($usernameUnique == 0) echo "<br>USERNAME == 0<br>";


  if(empty($username) || empty($email) || empty($fullName) || empty($telephone)){
    header("Location: ../new-account.php?error=Morate popuniti sva polja");
    exit;
  }
  if (strlen($password) < 3) {
    header("Location: ../new-account.php?error=Šifra mora imati barem 3 karaktera");
    exit;
  }
  if($usernameUnique == 0 || $emailUnique == 0){
    header("Location: ../new-account.php?error=Korisničko ime ili email su već iskorišteni");
    exit;
  }
  if ($isAgency == 0 && $isUser == 0) {
    header("Location: ../new-account.php?error=Morate odabrati barem jednu ulogu");
    exit;
  }
  if($zupanija === "Odaberite županiju" || $grad === "Odaberite grad"){
    header("Location: ../new-account.php?error=Morate odabrati županiju i grad");
    exit;
  }

  
  $filename = $_FILES['imageProfile']['name'];
  $extension = pathinfo($filename, PATHINFO_EXTENSION);
  $timestamp = time();
  $newFilename = $timestamp . '_' . $filename;
  $location = "../assets/upload/profiles/" . $newFilename;

  if (move_uploaded_file($_FILES['imageProfile']['tmp_name'], $location)) {
    echo "File uploaded";
  } else{
    echo "File not fond";
    $location = "../assets/default_profile_picture.jpg";
  }

  $query = "INSERT INTO users (korisnicko_ime, pass, email, puno_ime, zupanija, grad, telefon, isAdmin, isAgency, isUser, profile_picture_url) 
  VALUES ('$username', '$passwordMd5', '$email', '$fullName', '$zupanija', '$grad', '$telephone', 0, '$isAgency', '$isUser', '$location')";
  $query_run = mysqli_query($conn, $query);

  if($query_run){
    $_SESSION['message'] = "Uspješno kreiran nalog";
    header("Location: ../index.php");
    exit(0);
  }
  else{
      $_SESSION['message'] = "Došlo je do greške prilikom kreiranja naloga. Probajte drugi put.";
      header("Location: ../index.php");
      exit(0);
  }

?>