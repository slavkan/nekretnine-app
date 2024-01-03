<?php 
  session_start();
  include "../php/db_conn.php";
  if (isset($_SESSION['korisnicko_ime']) && isset($_SESSION['id']) && isset($_SESSION['isAgency'])) { $_SESSION['lastValidUrl'] = $_SERVER['REQUEST_URI'];  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/main-table.css">
  <title>Nekretnine</title>
  <link rel="icon" type="image/x-icon" href="/favicon.ico">
</head>
<body>
<nav class="navbar navbar-expand-lg custom-navbar" style="background-color: #bfbcb3;">
  <div class="container-fluid">
    <a class="navbar-brand text-dark" href="./home.php">NEKRETNINE</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <img src="../assets/svg/hamburger-icon.svg" alt="X">
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active text-dark" aria-current="page" href="./nekretninaTable.php">Uređivanje nekretnina</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-dark" aria-current="page" href="./razgovorTable.php">Razgovori</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-dark" aria-current="page" href="./profileTable.php">Profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-dark" aria-current="page" href="../php/logout.php">Odjava</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

  <div class="container-fluid custom-table-container">
    <div class="row">
      <div class="col-md-12">
      <div class="mt-5 mb-5">
      <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger col-md-12 mx-auto text-center alert-dismissible d-flex justify-content-between" role="alert">
              <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
              <?=$_GET['error']?>
          </div>
      <?php } ?>
      <?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success col-md-12 mx-auto text-center alert-dismissible d-flex justify-content-between" role="alert">
              <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
              <?=$_GET['success']?>
          </div>
      <?php } ?>
        <div class="card">
          <div class="card-header">
            <h4>
              Nekretnine
              <a href="./nekretninaCreate.php" class="btn btn-primary float-end">Dodaj nekretninu</a>
            </h4>
          </div>
          <div class="card-body">
           <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="center-cell">Naziv</th>
                <th class="center-cell">Cijena</th>
                <th class="center-cell hide-cell-small-screen">Zupanija</th>
                <th class="center-cell hide-cell-small-screen">Grad</th>
                <th class="center-cell hide-cell-medium-screen">adresa</th>
                <th class="center-cell hide-cell-medium-screen">sprat</th>
                <th class="center-cell hide-cell-medium-screen">Broj soba</th>
                <th class="center-cell hide-cell-medium-screen">Broj kvadrata</th>
                <th class="center-cell hide-cell-medium-screen">stanje</th>
                <th class="center-cell">Slika</th>
                <th class="center-cell hide-cell-small-screen">prodano</th>
                <th class="center-cell">CRUD</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $my_id = $_SESSION['id'];
                $query = "SELECT id, naziv, cijena, lokacija_zupanija, lokacija_grad, adresa, sprat, broj_soba, broj_kvadrata, stanje, prodano,
                slika_url1, slika_url2, slika_url3, slika_url4, slika_url5, slika_url6, slika_url7, slika_url8, slika_url9, slika_url10, vlasnik_id
                FROM nekretnina
                WHERE vlasnik_id = '$my_id'";
                $query_run = mysqli_query($conn, $query);
                if(mysqli_num_rows($query_run) > 0){
                  foreach($query_run as $nekretnina){
                    $validImage = "";
                    if($nekretnina['slika_url1'] != NULL || !empty($nekretnina['slika_url1'])) $validImage = $nekretnina['slika_url1'];
                    else if($nekretnina['slika_url2'] != NULL || !empty($nekretnina['slika_url2'])) $validImage = $nekretnina['slika_url2'];
                    else if($nekretnina['slika_url3'] != NULL || !empty($nekretnina['slika_url3'])) $validImage = $nekretnina['slika_url3'];
                    else if($nekretnina['slika_url4'] != NULL || !empty($nekretnina['slika_url4'])) $validImage = $nekretnina['slika_url4'];
                    else if($nekretnina['slika_url5'] != NULL || !empty($nekretnina['slika_url5'])) $validImage = $nekretnina['slika_url5'];
                    else if($nekretnina['slika_url6'] != NULL || !empty($nekretnina['slika_url6'])) $validImage = $nekretnina['slika_url6'];
                    else if($nekretnina['slika_url7'] != NULL || !empty($nekretnina['slika_url7'])) $validImage = $nekretnina['slika_url7'];
                    else if($nekretnina['slika_url8'] != NULL || !empty($nekretnina['slika_url8'])) $validImage = $nekretnina['slika_url8'];
                    else if($nekretnina['slika_url9'] != NULL || !empty($nekretnina['slika_url9'])) $validImage = $nekretnina['slika_url9'];
                    else if($nekretnina['slika_url10'] != NULL || !empty($nekretnina['slika_url10'])) $validImage = $nekretnina['slika_url10'];
                    ?>
                    <tr>
                      <td class="center-cell"><?= $nekretnina['naziv']; ?></td>
                      <td class="center-cell"><?= $nekretnina['cijena']; ?></td>
                      <td class="center-cell hide-cell-small-screen"><?= $nekretnina['lokacija_zupanija']; ?></td>
                      <td class="center-cell hide-cell-small-screen"><?= $nekretnina['lokacija_grad']; ?></td>
                      <td class="center-cell hide-cell-medium-screen"><?= $nekretnina['adresa']; ?></td>
                      <td class="center-cell hide-cell-medium-screen"><?= $nekretnina['sprat']; ?></td>
                      <td class="center-cell hide-cell-medium-screen"><?= $nekretnina['broj_soba']; ?></td>
                      <td class="center-cell hide-cell-medium-screen"><?= $nekretnina['broj_kvadrata']; ?></td>
                      <td class="center-cell hide-cell-medium-screen"><?= $nekretnina['stanje']; ?></td>
                      <td class="preview-image-table"> <img src="<?= $validImage ?>" alt="Image" class="preview-image-table"> </td>
                      <td class="center-cell hide-cell-small-screen"><?= $nekretnina['prodano']; ?></td>
                      <td class="center-cell crud-buttons-flex">
                        <a href="nekretninaEdit.php?id=<?= $nekretnina['id']; ?>" class="btn btn-success btn-sm crud-button-style">Uredi</a>
                        <form action="nekretninaCode.php" method="POST" class="d-inline crud-button-style pt-2">
                          <button type="submit" name="delete_nekretnina" value="<?=$nekretnina['id'];?>" class="btn btn-danger btn-sm crud-button-style">Obriši</button>
                        </form>
                      </td>
                    </tr>
                  <?php
                  }
                }
                else{
                  echo "<h5>Nema nekretnina u bazi!</h5>";
                }
              ?>
            </tbody>
           </table>
          </div>
      </div>
    </div>
  </div> 
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

<?php }else{
	// header("Location: ../index.php");
	header("Location: " . $_SESSION['lastValidUrl']);
} ?>