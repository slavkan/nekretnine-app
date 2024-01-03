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
  <link rel="stylesheet" href="./css/adding.css">
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

<div class="container mt-5 mb-5">
<?php if (isset($_GET['error'])) { ?>
    <div class="alert alert-danger col-md-12 mx-auto text-center alert-dismissible d-flex justify-content-between" role="alert">
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        <?=$_GET['error']?>
    </div>
<?php } ?>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4>Dodavanje nekretnine 
						<!-- <a href="./nekretninaTable.php" class="btn btn-danger float-end">Nazad</a> -->
					</h4>
				</div>
				<div class="card-body">
					<form action="nekretninaCode.php" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label>Naziv nekretnine</label>
							<input type="text" name="naziv" class="form-control">
						</div>
            <div class="form-group">
							<label class="mt-3">Cijena nekretnine</label>
							<input type="number" name="cijena" class="form-control">
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
							<label class="mt-3">Adresa</label>
							<input type="text" name="adresa" class="form-control">
						</div>
            <div class="form-group">
              <label for="sprat" class="mt-3">Sprat</label>
              <select class="form-select" id="sprat" name="sprat">
                <option value="-3">-3</option>
                <option value="-2">-2</option>
                <option value="-1">-1</option>
                <option value="Suteren">Suteren</option>
                <option value="Prizemlje">Prizemlje</option>
                <option value="Visoko prizemlje">Visoko prizemlje</option>
                <option value="1" selected>1</option>
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
                <option value="Garsonjera">Garsonjera</option>
                <option value="Jednosoban">Jednosoban</option>
                <option value="Jednoiposoban">Jednoiposoban</option>
                <option value="Dvosoban">Dvosoban</option>
                <option value="Trosoban">Trosoban</option>
                <option value="Četverosoban">Četverosoban</option>
                <option value="Petosoban">Petosoban i više</option>
              </select>
            </div>
            <div class="form-group">
							<label class="mt-3">Broj kvadrata</label>
							<input type="number" name="broj_kvadrata" class="form-control">
						</div>
            <div class="form-group">
              <label for="stanje" class="mt-3">Stanje</label>
              <select class="form-select" id="stanje" name="stanje">
                <option value="Novogradnja">Novogradnja</option>
                <option value="Renoviran">Renoviran</option>
                <option value="Dobro stanje">Dobro stanje</option>
                <option value="Parcijalno renoviran">Parcijalno renoviran</option>
                <option value="Za renoviranje">Za renoviranje</option>
                <option value="U izgradnji">U izgradnji</option>
              </select>
            </div>
            <div class="form-group">
              <label class="mt-3">Opis</label>
              <textarea class="form-control"  id="opis" name="opis" style="height: 100px"></textarea>
            </div>
            <div class="form-group">
              <label for="slika" class="mt-3 mb-3">Odaberite slike:</label>
            </div>
            <div class="delete-flex-container">
              <div class="delete-grid-container">
                <!-- 1 -->
                <button class="btn btn-light delete-btn-custom" type="button" onclick="removeUploadedFile(this, document.querySelector('#slika1'), 1)">
                  <img src="../assets/svg/x-circle.svg" alt="X">
                </button>
                <input type="file" class="image-upload-button mb-2" name="imageUpload1" id="slika1" accept="image/*" onchange="previewImage(this, 'preview1')">
                <img id="preview1" src="../assets/No_Preview_image.png" alt="No Preview" style="width: 100px; height: 100px;">
                <!-- 2 -->
                <button class="btn btn-light delete-btn-custom" type="button" onclick="removeUploadedFile(this, document.querySelector('#slika2'), 2)">
                  <img src="../assets/svg/x-circle.svg" alt="X">
                </button>
                <input type="file" class="image-upload-button mb-2" name="imageUpload2" id="slika2" accept="image/*" onchange="previewImage(this, 'preview2')">
                <img id="preview2" src="../assets/No_Preview_image.png" alt="No Preview" style="width: 100px; height: 100px;">
                <!-- 3 -->
                <button class="btn btn-light delete-btn-custom" type="button" onclick="removeUploadedFile(this, document.querySelector('#slika3'), 3)">
                  <img src="../assets/svg/x-circle.svg" alt="X">
                </button>
                <input type="file" class="image-upload-button mb-2" name="imageUpload3" id="slika3" accept="image/*" onchange="previewImage(this, 'preview3')">
                <img id="preview3" src="../assets/No_Preview_image.png" alt="No Preview" style="width: 100px; height: 100px;">
                <!-- 4 -->
                <button class="btn btn-light delete-btn-custom" type="button" onclick="removeUploadedFile(this, document.querySelector('#slika4'), 4)">
                  <img src="../assets/svg/x-circle.svg" alt="X">
                </button>
                <input type="file" class="image-upload-button mb-2" name="imageUpload4" id="slika4" accept="image/*" onchange="previewImage(this, 'preview4')">
                <img id="preview4" src="../assets/No_Preview_image.png" alt="No Preview" style="width: 100px; height: 100px;">
                <!-- 5 -->
                <button class="btn btn-light delete-btn-custom" type="button" onclick="removeUploadedFile(this, document.querySelector('#slika5'), 5)">
                  <img src="../assets/svg/x-circle.svg" alt="X">
                </button>
                <input type="file" class="image-upload-button mb-2" name="imageUpload5" id="slika5" accept="image/*" onchange="previewImage(this, 'preview5')">
                <img id="preview5" src="../assets/No_Preview_image.png" alt="No Preview" style="width: 100px; height: 100px;">

              </div>
              <div class="delete-grid-container mini-top-margin">
              <!-- 6 -->
              <button class="btn btn-light delete-btn-custom" type="button" onclick="removeUploadedFile(this, document.querySelector('#slika6'), 6)">
                <img src="../assets/svg/x-circle.svg" alt="X">
              </button>
              <input type="file" class="image-upload-button mb-2" name="imageUpload6" id="slika6" accept="image/*" onchange="previewImage(this, 'preview6')">
              <img id="preview6" src="../assets/No_Preview_image.png" alt="No Preview" style="width: 100px; height: 100px;">
              <!-- 7 -->
              <button class="btn btn-light delete-btn-custom" type="button" onclick="removeUploadedFile(this, document.querySelector('#slika7'), 7)">
                <img src="../assets/svg/x-circle.svg" alt="X">
              </button>
              <input type="file" class="image-upload-button mb-2" name="imageUpload7" id="slika7" accept="image/*" onchange="previewImage(this, 'preview7')">
              <img id="preview7" src="../assets/No_Preview_image.png" alt="No Preview" style="width: 100px; height: 100px;">
              <!-- 8 -->
              <button class="btn btn-light delete-btn-custom" type="button" onclick="removeUploadedFile(this, document.querySelector('#slika8'), 8)">
                <img src="../assets/svg/x-circle.svg" alt="X">
              </button>
              <input type="file" class="image-upload-button mb-2" name="imageUpload8" id="slika8" accept="image/*" onchange="previewImage(this, 'preview8')">
              <img id="preview8" src="../assets/No_Preview_image.png" alt="No Preview" style="width: 100px; height: 100px;">
              <!-- 9 -->
              <button class="btn btn-light delete-btn-custom" type="button" onclick="removeUploadedFile(this, document.querySelector('#slika9'), 9)">
                <img src="../assets/svg/x-circle.svg" alt="X">
              </button>
              <input type="file" class="image-upload-button mb-2" name="imageUpload9" id="slika9" accept="image/*" onchange="previewImage(this, 'preview9')">
              <img id="preview9" src="../assets/No_Preview_image.png" alt="No Preview" style="width: 100px; height: 100px;">
              <!-- 10 -->
              <button class="btn btn-light delete-btn-custom" type="button" onclick="removeUploadedFile(this, document.querySelector('#slika10'), 10)">
                <img src="../assets/svg/x-circle.svg" alt="X">
              </button>
              <input type="file" class="image-upload-button mb-2" name="imageUpload10" id="slika10" accept="image/*" onchange="previewImage(this, 'preview10')">
              <img id="preview10" src="../assets/No_Preview_image.png" alt="No Preview" style="width: 100px; height: 100px;">
              </div>
            </div>
            

            

						<div class="mb-3 mt-3">
							<button type="submit" name="save_nekretnina" class="btn btn-primary">Kreiraj nekretninu</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="../placesOnChange.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="./js/nekretninaCreate.js"></script>

<script>
  
</script>

</body>
</html>








<?php }else{
	// header("Location: ../index.php");
	header("Location: " . $_SESSION['lastValidUrl']);
} ?>