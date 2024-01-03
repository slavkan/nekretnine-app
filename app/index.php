<?php 
   session_start();
   if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) { $_SESSION['lastValidUrl'] = $_SERVER['REQUEST_URI'];  ?>

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
        <h2>Prijava</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-4 col-10 mx-auto text-center">
      <?php include('message.php'); ?>
      <?php if (isset($_GET['error'])) { ?>
        <div class="alert alert-danger" role="alert">
          <?=$_GET['error']?>
        </div>
        <?php } ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-10 mx-auto">
        <form class="" action="php/check-login.php" method="POST">
          <div class="form-group" class="">
            <label for="username">korisničko ime</label>
            <input type="text" class="form-control" id="username" placeholder="Korisničko ime" name="username">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Šifra</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Šifra" name="password">
          </div>
          <label for="roleSelect" class="mt-3 mb-1">Izaberi ulogu za prijavu</label>
          <select class="form-select" id="roleSelect" name="role">
            <option selected value="isAdmin">Admin</option>
            <option value="isAgency">Agencija</option>
            <option value="isUser">Korisnik</option>
          </select>
          <button type="submit" class="btn btn-primary mt-3">Prijavi se</button>
          <hr>
        </form>
      <a href="./new-account.php" class="btn btn-success mt-3">Kreiraj nalog</a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

<?php }else{
	header("Location: " . $_SESSION['lastValidUrl']);
} ?>