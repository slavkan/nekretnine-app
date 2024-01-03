<?php 
   session_start();
   if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {  $_SESSION['lastValidUrl'] = $_SERVER['REQUEST_URI']; ?>


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
  <div class="container vertical-center mt-3">
    <div class="row">
      <div class="col-md-4 col-10 mx-auto text-center">
        <h2>Registracija novog naloga</h2>
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
    <div class="row">
      <div class="col-md-4 col-10 mx-auto">
        <form class="" action="php/check-registration.php" method="POST" enctype="multipart/form-data">
          <div class="form-group" class="">
            <label for="username">Korisničko ime</label>
            <input type="text" class="form-control" id="username" placeholder="Korisničko ime" name="username">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1" class="mt-3">Šifra</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Šifra" name="password">
          </div>
          <div class="form-group">
            <label for="inputEmail" class="mt-3">Email</label>
            <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email">
          </div>
          <div class="form-group">
            <label for="inputFullName" class="mt-3">Ime</label>
            <input type="text" class="form-control" id="inputFullName" placeholder="Ime" name="fullName">
          </div>
          <div class="form-group">
            <label for="inputTelephone" class="mt-3">Telefon</label>
            <input type="text" class="form-control" id="inputTelephone" placeholder="Telefon" name="telephone">
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
            <label class="form-check-label" for="exampleCheck1">Agencija</label>
            <br>
            <input type="checkbox" class="form-check-input" id="exampleCheck2" name="isUser" value="isUser">
            <label class="form-check-label" for="exampleCheck2">Korisnik</label>
          </div>
          <div class="form-group">
            <label for="slika" class="mt-3">Izaberite sliku:</label>
            <input type="file" class="form-control-file" name="imageProfile" id="slika" accept="image/*" />
          </div>
          <button type="submit" class="btn btn-primary mt-3">Registriraj se</button>
          <hr>
          <a href="./index.php" class="btn btn-success mt-3">Povratak na početnu stranicu</a>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="placesOnChange.js"></script>
</body>
</html>

<?php }else{
	header("Location: " . $_SESSION['lastValidUrl']);
} ?>