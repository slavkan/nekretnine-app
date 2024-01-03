<?php 
  session_start();
  include "../php/db_conn.php";
  if (isset($_SESSION['korisnicko_ime']) && isset($_SESSION['id']) && isset($_SESSION['isUser'])) { $_SESSION['lastValidUrl'] = $_SERVER['REQUEST_URI'];  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/global.css">
  <link rel="stylesheet" href="./css/singleNekretnina.css">
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

<div class="nekretnina-view-container pt-3">
  <?php   
    $session_id = $_SESSION['id'];
    $nekretnina_id = $_GET['id'];
    // $query = "SELECT id, naziv, cijena, lokacija_zupanija, lokacija_grad, adresa, sprat, broj_soba, broj_kvadrata, stanje, prodano, opis,
    // slika_url1, slika_url2, slika_url3, slika_url4, slika_url5, slika_url6, slika_url7, slika_url8, slika_url9, slika_url10 
    // FROM nekretnina WHERE id = '$nekretnina_id'";
    $query = "SELECT n.id, n.naziv, n.cijena, n.lokacija_zupanija, n.lokacija_grad, n.adresa, n.sprat, 
    n.broj_soba, n.broj_kvadrata, n.stanje, n.prodano, n.opis, n.slika_url1, n.slika_url2, 
    n.slika_url3, n.slika_url4, n.slika_url5, n.slika_url6, n.slika_url7, n.slika_url8, 
    n.slika_url9, n.slika_url10, u.id AS user_id, u.profile_picture_url, u.puno_ime
    FROM nekretnina AS n
    INNER JOIN users AS u ON n.vlasnik_id = u.id
    WHERE n.id = '$nekretnina_id';";

    
    
    $query_run = mysqli_query($conn, $query);
    if(mysqli_num_rows($query_run) > 0){
      foreach($query_run as $nekretnina){
        $imagesToShow = [];

        for ($i = 1; $i <= 10; $i++) {
          $columnName = "slika_url" . $i;
          $url = $nekretnina[$columnName];

          if ($url !== null) {
              $imagesToShow[] = $url;
          }
        }
        $isDisabled = True;
        if($_SESSION['id'] != $nekretnina['user_id']){
          $isDisabled = False;
        }
        ?>
        <div class="card single-nekretnina-card">
          <div class="card-body-top top-card-flex">
            <h5 class="card-title"><?= $nekretnina['naziv']; ?></h5>
            <div>
              <p><?= $nekretnina['puno_ime']; ?></p>
              <img src="<?= $nekretnina['profile_picture_url']; ?>" alt="" class="profile-pic-nekretnina">
            </div>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Cijena: <b><?= $nekretnina['cijena']; ?> KM</b></li>
            <li class="list-group-item">Županija: <b><?= $nekretnina['lokacija_zupanija']; ?></b></li>
            <li class="list-group-item">Grad: <b><?= $nekretnina['lokacija_grad']; ?></b></li>
            <li class="list-group-item">Adresa: <b><?= $nekretnina['adresa']; ?></b></li>
            <li class="list-group-item">Sprat: <b><?= $nekretnina['sprat']; ?></b></li>
            <li class="list-group-item">Broj soba: <b><?= $nekretnina['broj_soba']; ?></b></li>
            <li class="list-group-item">Broj kvadrata: <b><?= $nekretnina['broj_kvadrata']; ?></b></li>
            <li class="list-group-item">Stanje: <b><?= $nekretnina['stanje']; ?></b></li>
            <li class="list-group-item">Opis: <b><?= $nekretnina['opis']; ?></b></li>
          </ul>
          <div class="card-body ">
            <a href='./razgovor.php?idSender=<?= $_SESSION['id'] ?>&idReciever=<?= $nekretnina['user_id'] ?>&idNekretnina=<?= $nekretnina['id'] ?>' class="btn btn-primary btn-style-custom <?= $isDisabled ? 'disabled' : '' ?>">Pokreni razgovor za kupovinu</a>
          </div>
        </div>
        
        <div class="container my-3">
          <!-- Carousel -->
          <div id="demo" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <?php
            $firstImage = true;
                  
            foreach ($imagesToShow as $image) {
              if (file_exists($image)) {
                $activeClass = $firstImage ? 'active' : '';
              
                echo "<div class='carousel-item $activeClass h-100'>
                        <img src='$image' alt='$image' class='d-block w-100'>
                      </div>";

                $firstImage = false;
              }
            }
            ?>
            
          </div>
          <!-- Left and right controls/icons -->
          <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>
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


  <!-- <h1>Agencija</h1>
  <h5>
	  <?=$_SESSION['puno_ime']?>
  </h5> -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="./js/sidebar.js"></script>
<script src="../placesOnChange.js"></script>
</body>
</html>

<?php }else{
	// header("Location: ../index.php");
	header("Location: " . $_SESSION['lastValidUrl']);
} ?>