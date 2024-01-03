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
  <!-- <link rel="stylesheet" href="/css/login.css"> -->
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
  <div class="container vertical-center mt-3">
    <div class="row">
      <div class="col-md-4 col-10 mx-auto text-center">
        <h2>Uređivanje naloga</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-4 col-10 mx-auto text-center">
        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger col-md-4 col-10 mx-auto text-center d-flex justify-content-between" role="alert">
                <?=$_GET['error']?>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
      </div>
    </div>
    <?php
      if(isset($_SESSION['id'])){
        $my_id = $_SESSION['id'];
        $query = "SELECT korisnicko_ime, pass, email, puno_ime, zupanija, grad, telefon, profile_picture_url, isAdmin, isAgency, isUser
        FROM users
        WHERE id = '$my_id'";
        $query_run = mysqli_query($conn, $query);
        if(mysqli_num_rows($query_run) > 0){
          $user_info = mysqli_fetch_array($query_run);
        }
      }
    ?>
    <div class="row">
      <div class="col-md-4 col-10 mx-auto">
        <form class="" action="./profileCode.php" method="POST" enctype="multipart/form-data">
          <div class="form-group" class="">
            <label for="username">Korisničko ime</label>
            <input disabled type="text" class="form-control" id="username" placeholder="Korisnicko ime" name="username" value="<?=$user_info['korisnicko_ime'];?>">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1" class="mt-3">Nova šifra (ukoliko ne unesete polje zadržat ćete staru šifru)</label>
            <input disabled type="password" class="form-control" id="exampleInputPassword1" placeholder="Sifra" name="password" value="">
          </div>
          <div class="form-group">
            <label for="inputEmail" class="mt-3">Email</label>
            <input disabled type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" value="<?=$user_info['email'];?>">
          </div>
          <div class="form-group">
            <label for="inputFullName" class="mt-3">Ime</label>
            <input type="text" class="form-control" id="inputFullName" placeholder="Ime" name="fullName" value="<?=$user_info['puno_ime'];?>">
          </div>
          <div class="form-group">
            <label for="inputTelephone" class="mt-3">Telefon</label>
            <input type="text" class="form-control" id="inputTelephone" placeholder="Telefon" name="telephone" value="<?=$user_info['telefon'];?>">
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
          <p class="mt-3 mb-1">Izaberite uloge</p>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="isAgency" value="isAgency">
            <label class="form-check-label" for="exampleCheck1">Agency</label>
            <br>
            <input type="checkbox" class="form-check-input" id="exampleCheck2" name="isUser" value="isUser">
            <label class="form-check-label" for="exampleCheck2">User</label>
          </div>
          <div class="form-group">
            <label for="slika" class="mt-3">Izaberite sliku:</label>
            <input type="file" class="form-control-file" name="imageProfile" id="slika" accept="image/*" />
          </div>
          <button type="submit" class="btn btn-primary mt-3">Uredi profil</button>
          <hr>
          <a href="./home.php" class="btn btn-success mt-3">Povratak na početnu stranicu</a>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="../placesOnChange.js"></script>
</body>
</html>

<?php }else{
	// header("Location: ../index.php");
	header("Location: " . $_SESSION['lastValidUrl']);
} ?>