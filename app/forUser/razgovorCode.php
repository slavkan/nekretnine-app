<?php
session_start();
require '../php/db_conn.php';

if(isset($_POST['save_razgovor'])){
  $newMsg = $_POST["newMsg"];
  $your_id = $_POST["your_id"];
  $chat_id = $_POST["chat_id"];
  $currentDate = date("Y-m-d");
  $currentTime = date("H:i:s");

  $query = "INSERT INTO poruka_za_kupovinu (razgovor_id, posiljatelj_id, datum, vrijeme, poruka)
            VALUES ('$chat_id', '$your_id', '$currentDate', '$currentTime', '$newMsg')";


  echo "<br><h3>".$query."<h3><br>";

  $query_run = mysqli_query($conn, $query);

  if($query_run){
    $_SESSION['message'] = "Uspješno kreirana nekretnina";
    header("Location: " . $_SESSION['lastValidUrl']);
    exit(0);
  }
  else{
      $_SESSION['message'] = "Došlo je do greške prilikom kreiranja nekretnine. Probajte drugi put.";
      header("Location: " . $_SESSION['lastValidUrl']);
      exit(0);
  }
}







