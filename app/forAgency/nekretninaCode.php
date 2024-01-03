<?php
session_start();
require '../php/db_conn.php';

if(isset($_POST['save_nekretnina'])){
  $naziv = $_POST["naziv"];
  $cijena = $_POST["cijena"];
  $zupanija = $_POST["zupanija"];
  $grad = $_POST["grad"];
  $adresa = $_POST["adresa"];
  $sprat = $_POST["sprat"];
  $broj_soba = $_POST["broj_soba"];
  $broj_kvadrata = $_POST["broj_kvadrata"];
  $stanje = $_POST["stanje"];
  $opis = $_POST["opis"];
  $userId = $_SESSION['id'];
  $uploadedFiles = [];
  $filenames = [];
  $i = 0;
  foreach($_FILES as $file){
    $uploadedFiles[$i] = $file;
    $filenames[$i] = $uploadedFiles[$i]['name'];
    echo $filenames[$i++];
  }

  if(empty($naziv) || empty($cijena) || empty($adresa) || empty($broj_kvadrata) || empty($opis)){
    header("Location: ./nekretninaCreate.php?error=Morate popuniti sva polja");
    exit;
  }
  else if($zupanija === "Odaberite županiju" || $grad === "Odaberite grad"){
    header("Location: ./nekretninaCreate.php?error=Morate odabrati županiju i grad");
    exit;
  }

  $numberOfValidFiles = 0;
  $numberOfInvalidFiles = 0;
  foreach ($filenames as $file) {
    if ($file !== null && $file !== "") {
      $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
      $validExtensions = array("jpg", "jpeg", "png");
      if (in_array(strtolower($fileExtension), $validExtensions)) {
        $numberOfValidFiles++;
        echo "<br>Valid File: " . $file . "<br>";
      } else {
        $numberOfInvalidFiles++;
        echo "<br>Invalid File: " . $file . "<br>";
      }
    }
  }

  if($numberOfInvalidFiles > 0){
    header("Location: ./nekretninaCreate.php?error=Odabrali ste pogrešan tip datoteke za sliku.");
    exit;
  }
  if($numberOfValidFiles < 1){
    header("Location: ./nekretninaCreate.php?error=Morate odabrati barem jednu sliku");
    exit;
  }

  echo "<br>MORE DODAVANJE<br>";

  $i=0;
  $query = "INSERT INTO nekretnina (naziv, cijena, lokacija_zupanija, lokacija_grad, adresa, sprat, broj_soba, broj_kvadrata, stanje, opis, prodano, vlasnik_id, ";
  $queryValues = "VALUES ('$naziv', '$cijena', '$zupanija', '$grad', '$adresa', '$sprat', '$broj_soba', '$broj_kvadrata', '$stanje', '$opis', 'NE', '$userId',";

  foreach($filenames as $filename){
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $timestamp = time();
    $newFilename = $timestamp . '_' . $filename;
    $location = "../assets/upload/realEstates/" . $newFilename;
    $tmp_name = $timestamp."_".$i;

    if (move_uploaded_file($uploadedFiles[$i]['tmp_name'], $location)) {
      echo "File uploaded<br>";
      $query .= "slika_url" . ($i + 1) . ",";
      $queryValues .= "'" . $location . "'" . ",";
    } else{
      echo "File not fond<br>";
      $location = "../assets/default_profile_picture.jpg";
    }
    $i++;
  }

  $query = substr($query, 0, -1);
  $queryValues = substr($queryValues, 0, -1);

  $query .= ") ";
  $queryValues .= ")";
  
  $query .= $queryValues;

  echo "<br><h3>".$query."<h3><br>";

  $query_run = mysqli_query($conn, $query);

  if($query_run){
    $_SESSION['message'] = "Uspješno kreirana nekretnina";
    header("Location: ./nekretninaTable.php");
    exit(0);
  }
  else{
      $_SESSION['message'] = "Došlo je do greške prilikom kreiranja nekretnine. Probajte drugi put.";
      header("Location: ./nekretninaTable.php");
      exit(0);
  }
}


if(isset($_POST['update_nekretnina'])){
  $id = $_POST["id"];
  $naziv = $_POST["naziv"];
  $cijena = $_POST["cijena"];
  $zupanija = $_POST["zupanija"];
  $grad = $_POST["grad"];
  $adresa = $_POST["adresa"];
  $sprat = $_POST["sprat"];
  $broj_soba = $_POST["broj_soba"];
  $broj_kvadrata = $_POST["broj_kvadrata"];
  $stanje = $_POST["stanje"];
  $opis = $_POST["opis"];
  $uploadedFiles = [];
  $filenames = [];
  $oldFilenames = [
    $_POST["tempSlikaUrl1"],
    $_POST["tempSlikaUrl2"],
    $_POST["tempSlikaUrl3"],
    $_POST["tempSlikaUrl4"],
    $_POST["tempSlikaUrl5"],
    $_POST["tempSlikaUrl6"],
    $_POST["tempSlikaUrl7"],
    $_POST["tempSlikaUrl8"],
    $_POST["tempSlikaUrl9"],
    $_POST["tempSlikaUrl10"]
  ];
  echo $oldFilenames[1] . "<br>";
  echo $oldFilenames[1] . "<br>";
  $i = 0;
  foreach($_FILES as $file){
    $uploadedFiles[$i] = $file;
    $filenames[$i] = $uploadedFiles[$i]['name'];
    echo $filenames[$i++];
  }
  echo $naziv . "<br>";
  echo $zupanija . "<br>";
  echo $grad . "<br>";
  echo $adresa . "<br>";
  echo $sprat . "<br>";
  echo $broj_soba . "<br>";
  echo $broj_kvadrata . "<br>";
  echo $stanje . "<br>";
  echo $opis . "<br>";
  echo "<br><br><br>";


  if(empty($naziv) || empty($cijena) ||  empty($adresa) || empty($broj_kvadrata) || empty($opis)){
    header("Location: ./nekretninaTable.php?error=Morate popuniti sva polja");
    exit;
  }
  else if($zupanija === "Odaberite županiju" || $grad === "Odaberite grad"){
    header("Location: ./nekretninaTable.php?error=Morate odabrati županiju i grad");
    exit;
  }

  $numberOfValidFiles = 0;
  $numberOfInvalidFiles = 0;
  foreach ($filenames as $file) {
    if ($file !== null && $file !== "") {
      $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
      $validExtensions = array("jpg", "jpeg", "png");
      if (in_array(strtolower($fileExtension), $validExtensions)) {
        $numberOfValidFiles++;
        echo "<br>Valid File: " . $file . "<br>";
      } else {
        $numberOfInvalidFiles++;
        echo "<br>Invalid File: " . $file . "<br>";
      }
    }
  }

  if($numberOfInvalidFiles > 0){
    header("Location: ./nekretninaTable.php?error=Odabrali ste pogrešan tip datoteke za sliku.");
    exit;
  }

  echo "<br>MORE EDIT<br>";

  //$query = "UPDATE nekretnina SET naziv='$naziv', studij_id='$studij_id' WHERE id='$nekretnina_id' ";
  //$query = "UPDATE nekretnina SET (naziv, lokacija_zupanija, lokacija_grad, adresa, sprat, broj_soba, broj_kvadrata, stanje, opis, prodano,";



  $query = "UPDATE nekretnina SET naziv='$naziv', cijena='$cijena', lokacija_zupanija='$zupanija', lokacija_grad='$grad', adresa='$adresa', sprat='$sprat', broj_soba='$broj_soba', broj_kvadrata='$broj_kvadrata', stanje='$stanje', opis='$opis',";

  $i=0;
  foreach($filenames as $filename){
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $timestamp = time();
    $newFilename = $timestamp . '_' . $filename;
    $location = "../assets/upload/realEstates/" . $newFilename;
    $tmp_name = $timestamp."_".$i;

    if (move_uploaded_file($uploadedFiles[$i]['tmp_name'], $location)) {
      echo "File uploaded<br>";
      $query .= "slika_url" . ($i + 1) . "='" . $location . "',";
      $oldFilename = $oldFilenames[$i];
      if (file_exists($oldFilename)) {
        if (unlink($oldFilename)) {
            echo "Old file deleted<br>";
        }
      }
    } else{
      echo "File not fond<br>";
      $location = "../assets/default_profile_picture.jpg";
    }
    $i++;
  }

  $query = substr($query, 0, -1);
  $query .= " WHERE id=" . $id;

  echo "<br><h3>".$query."<h3><br>";

  $query_run = mysqli_query($conn, $query);

  if($query_run){
    header("Location: nekretninaTable.php?success=Nekretnina uređenaHeader");
    exit(0);
  }
  else{
    header("Location: nekretninaTable.php?error=Nekretnina nije uređena");
    exit(0);
  }

}




if(isset($_POST['delete_nekretnina'])){
  $id = $_POST["delete_nekretnina"];

  $query = "SELECT slika_url1, slika_url2, slika_url3, slika_url4, slika_url5, slika_url6, slika_url7, slika_url8, slika_url9, slika_url10 FROM nekretnina WHERE id='$id'";
  $query_run = mysqli_query($conn, $query);
  if(mysqli_num_rows($query_run) > 0){
    foreach($query_run as $nekretnina){
      $imagesToDelete = [];

      for ($i = 1; $i <= 10; $i++) {
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

  $query = "DELETE FROM nekretnina WHERE id='$id' ";
  $query_run = mysqli_query($conn, $query);

  if($query_run){
    header("Location: nekretninaTable.php?success=Nekretnina obrisana");
    exit(0);
  }
  else{
    header("Location: nekretninaTable.php?error=Nekretnina nije obrisana");
    exit(0);
  }
}