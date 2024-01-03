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
  <link rel="stylesheet" href="./css/global.css">
  <title>Nekretnine</title>
  <link rel="icon" type="image/x-icon" href="/favicon.ico">
</head>
<body>
<nav class="navbar navbar-expand-lg custom-navbar">
  <div class="container-fluid">
    <a class="navbar-brand text-dark" href="#">NEKRETNINE</a>
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

<div class="main-page-flex">
  <div class="sidebar-container" id="sidebar">
    <button id="toggleButton" class="remove-btn-style mt-2">
      <img src="../assets/svg/arrow-left-circle.svg" alt="Shrink sidebar" class="img-to-rotate">
    </button>

    
    <form action="./home.php" method="POST" class="form-width">
			<div class="form-group">
				<label>Naziv nekretnine</label>
				<input type="text" name="naziv" class="form-control">
			</div>
      <div class="form-group">
        <label for="" class="mt-3">Cijena</label>
        <div class="row">
          <div class="col">
            <label class="">Min</label>
            <input type="number" name="cijenaMin" class="form-control">
          </div>
          <div class="col">
            <label class="">Max</label>
            <input type="number" name="cijenaMax" class="form-control">
          </div>
        </div>
      </div>
      <!-- Zupanije i gradovi -->
      <div class="form-group">
        <label for="zupanija" class="mt-3">Županija:</label>
        <select class="form-select" id="zupanija" name="zupanija" onchange="popuniGradove()">
        </select>
      </div>
      <div class="form-group">
        <label for="grad" class="mt-3">Grad:</label>
        <select class="form-select" id="grad" name="grad" default="Odaberite grad">
        <option value="Odaberite grad" selected>Odaberite grad</option>
        </select>
      </div>
      <!--  -->
      <div class="form-group">
        <label for="sprat" class="mt-3">Sprat</label>
        <select class="form-select" id="sprat" name="sprat">
          <option value="Odaberite">Odaberite</option>
          <option value="-3">-3</option>
          <option value="-2">-2</option>
          <option value="-1">-1</option>
          <option value="Suteren">Suteren</option>
          <option value="Prizemlje">Prizemlje</option>
          <option value="Visoko prizemlje">Visoko prizemlje</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20+">20+</option>
        </select>
      </div>
      <div class="form-group">
        <label for="broj_soba" class="mt-3">Broj soba</label>
        <select class="form-select" id="broj_soba" name="broj_soba">
          <option value="Odaberite">Odaberite</option>
          <option value="Garsonjera">Garsonjera</option>
          <option value="Jednosoban">Jednosoban</option>
          <option value="Jednoiposoban">Jednoiposoban</option>
          <option value="Dvosoban">Dvosoban</option>
          <option value="Trosoban">Trosoban</option>
          <option value="Četverosoban">Četverosoban</option>
          <option value="Petosoban">Petosoban i više</option>
        </select>
      </div>
      <!-- <div class="form-group">
				<label class="mt-3">Broj kvadrata</label>
				<input type="number" name="broj_kvadrata" class="form-control">
			</div> -->
      <div class="form-group">
        <label for="" class="mt-3">Broj kvadrata</label>
        <div class="row">
          <div class="col">
            <label class="">Min</label>
            <input type="number" name="broj_kvadrataMin" class="form-control">
          </div>
          <div class="col">
            <label class="">Max</label>
            <input type="number" name="broj_kvadrataMax" class="form-control">
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="stanje" class="mt-3">Stanje</label>
        <select class="form-select" id="stanje" name="stanje">
          <option value="Odaberite">Odaberite</option>
          <option value="Novogradnja">Novogradnja</option>
          <option value="Renoviran">Renoviran</option>
          <option value="Dobro stanje">Dobro stanje</option>
          <option value="Parcijalno renoviran">Parcijalno renoviran</option>
          <option value="Za renoviranje">Za renoviranje</option>
          <option value="U izgradnji">U izgradnji</option>
        </select>
      </div>
			<div class="mb-3 mt-3 d-flex justify-content-center">
        <button type="submit" name="filter_nekretnina" class="btn btn-primary mx-auto">Filtriraj nekretnine</button>
      </div>
		</form>




  </div>
  <div class="main-page-container" id="mainPage">
  <?php    
    $query = "SELECT n.id, n.naziv, n.cijena, n.lokacija_zupanija, n.lokacija_grad, n.adresa, n.sprat, n.broj_soba, n.broj_kvadrata, n.stanje, n.prodano, n.opis,
    n.slika_url1, n.slika_url2, n.slika_url3, n.slika_url4, n.slika_url5, n.slika_url6, n.slika_url7, n.slika_url8, n.slika_url9, n.slika_url10, u.puno_ime
    FROM nekretnina AS n
    INNER JOIN users AS u ON n.vlasnik_id = u.id";
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $naziv = $_POST["naziv"];
      $cijenaMin = $_POST["cijenaMin"];
      $cijenaMax = $_POST["cijenaMax"];
      $zupanija = $_POST["zupanija"];
      $grad = $_POST["grad"];
      $sprat = $_POST["sprat"];
      $broj_soba = $_POST["broj_soba"];
      $broj_soba = $_POST["broj_soba"];
      $broj_kvadrataMin = $_POST["broj_kvadrataMin"];
      $broj_kvadrataMax = $_POST["broj_kvadrataMax"];
      $stanje = $_POST["stanje"];

      $filterQuery = " WHERE ";

      if(!empty($naziv)){
        $filterQuery .= "naziv LIKE '%" . $naziv . "%' AND ";
      }
      if(!empty($cijenaMin) || !empty($cijenaMax)){
        if(!empty($cijenaMin) && !empty($cijenaMax)){
          $filterQuery .= "cijena BETWEEN " . $cijenaMin . " AND " . $cijenaMax . " AND " ;
        }
        else if(empty($cijenaMin)){
          $filterQuery .= "cijena < " . $cijenaMax . " AND ";
        }
        else if(empty($cijenaMax)){
          $filterQuery .= "cijena > " . $cijenaMin . " AND ";
        }
      }
      if($zupanija !== "Odaberite županiju"){
        $filterQuery .= "lokacija_zupanija ='" . $zupanija . "' AND ";
      }
      if($grad !== "Odaberite grad"){
        $filterQuery .= "lokacija_grad ='" . $grad . "' AND ";
      }
      if($sprat !== "Odaberite"){
        $filterQuery .= "sprat ='" . $sprat . "' AND ";
      }
      if($broj_soba !== "Odaberite"){
        $filterQuery .= "broj_soba ='" . $broj_soba . "' AND ";
      }
      if(!empty($broj_kvadrataMin) || !empty($broj_kvadrataMax)){
        if(!empty($broj_kvadrataMin) && !empty($broj_kvadrataMax)){
          $filterQuery .= "broj_kvadrata BETWEEN " . $broj_kvadrataMin . " AND " . $broj_kvadrataMax . " AND " ;
        }
        else if(empty($broj_kvadrataMin)){
          $filterQuery .= "broj_kvadrata < " . $broj_kvadrataMax . " AND ";
        }
        else if(empty($broj_kvadrataMax)){
          $filterQuery .= "broj_kvadrata > " . $broj_kvadrataMin . " AND ";
        }
      }
      if($stanje !== "Odaberite"){
        $filterQuery .= "stanje ='" . $stanje . "' AND ";
      }
      
      $filterQuery = substr($filterQuery, 0, -6);
      $query .= $filterQuery;
    }
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
        <div class="card custom-card-style">
          <img class="card-img-top" src="<?= $validImage ?>" alt="Card image cap">
          <div class="card-body card-body-top">
            <h5 class="card-title"><?= $nekretnina['naziv']; ?></h5>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><b><?= $nekretnina['cijena']; ?> KM</b></li>
            <li class="list-group-item"><?= $nekretnina['lokacija_zupanija']; ?></li>
            <li class="list-group-item"><?= $nekretnina['lokacija_grad']; ?></li>
            <li class="list-group-item"><?= $nekretnina['adresa']; ?></li>
            <li class="list-group-item">Prodano: <?= $nekretnina['prodano']; ?></li>
          </ul>
          <div class="card-body card-body-bottom">
            <a href="singleNekretnina.php?id=<?= $nekretnina['id']; ?>" class="btn btn-primary">Otvori</a>
            <span><?php echo $nekretnina['puno_ime'] ?></span>
          </div>
        </div>
      <?php
      }
    }
    else{
      echo "<h5>Nema nekretnina u bazi!</h5>";
    }
  ?>
  </div>
</div>


  <!-- <h1>Agencija</h1>
  <h5>
	  <?=$_SESSION['puno_ime']?>
  </h5> -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="./js/sidebar.js"></script>
<script src="../placesOnChange.js"></script>
</body>
</html>

<?php }else{
	// header("Location: ../index.php");
	header("Location: " . $_SESSION['lastValidUrl']);
} ?>