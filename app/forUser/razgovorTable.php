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
              <!-- <a href="./nekretninaCreate.php" class="btn btn-primary float-end">Dodaj nekretninu</a> -->
            </h4>
          </div>
          <div class="card-body">
           <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="center-cell">Ime prodavača</th>
                <th class="center-cell">Ime kupca</th>
                <th class="center-cell">Nekretnina</th>
                <th class="center-cell">Otvori</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $your_id = $_SESSION['id'];
                $query = "SELECT uO.korisnicko_ime AS seller_name, uB.korisnicko_ime AS buyer_name, n.naziv,
                n.id AS nekretnina_id, uO.id AS seller_id, uB.id AS buyer_id
                FROM razgovor_za_kupovinu r
                INNER JOIN users AS uO ON r.vlasnik_id = uO.id
                INNER JOIN users AS uB on r.kupac_id = uB.id
                INNER JOIN nekretnina AS n ON r.nekretnina_id = n.id
                WHERE r.vlasnik_id = '$your_id' OR r.kupac_id = '$your_id'";
                $query_run = mysqli_query($conn, $query);
                if(mysqli_num_rows($query_run) > 0){
                  foreach($query_run as $razgovor){
                    ?>
                    <tr>
                      <td class="center-cell"><?= $razgovor['seller_name']; ?></td>
                      <td class="center-cell"><?= $razgovor['buyer_name']; ?></td>
                      <td class="center-cell"><?= $razgovor['naziv']; ?></td>
                      <td class="center-cell crud-buttons-flex">
                      <a href='./razgovor.php?idSender=<?= $razgovor['buyer_id'] ?>&idReciever=<?= $razgovor['seller_id'] ?>&idNekretnina=<?= $razgovor['nekretnina_id'] ?>' class="btn btn-success btn-sm crud-button-style">Otvori razgovor</a>
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