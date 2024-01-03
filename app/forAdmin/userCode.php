<?php
session_start();
require '../php/db_conn.php';

if(isset($_POST['delete_user'])){
  $id = $_POST["delete_user"];

  $query = "SELECT profile_picture_url FROM users WHERE id='$id'";
  $query_run = mysqli_query($conn, $query);
  if(mysqli_num_rows($query_run) > 0){
    foreach($query_run as $nekretnina){
      $imagesToDelete = [];

      for ($i = 1; $i <= 1; $i++) {
        $columnName = "slika_url" . $i;
        $url = $nekretnina[$columnName];
        
        if ($url !== null) {
            $imagesToDelete[] = $url;
        }
      }
      var_dump($imagesToDelete);
    }
  }

  foreach($imagesToDelete as $image){
    if(file_exists($image)){
      if(unlink($image)){
        echo "Image deleted<br>";
      }
    }
  }

  $query = "DELETE FROM users WHERE id='$id' ";
  $query_run = mysqli_query($conn, $query);

  if($query_run){
    header("Location: home.php?success=Korisnik obrisan");
    exit(0);
  }
  else{
    header("Location: home.php?error=Korisnik nije obrisan");
    exit(0);
  }
}