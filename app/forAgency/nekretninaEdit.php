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
  <link rel="stylesheet" href="./css/editing.css">
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
						<a href="./nekretninaTable.php" class="btn btn-danger float-end">Nazad</a>
					</h4>
				</div>
				<div class="card-body">
          <?php
            if(isset($_GET['id'])){
              $nekretnina_id = mysqli_real_escape_string($conn, $_GET['id']);
              $query = "SELECT id, naziv, cijena, lokacija_zupanija, lokacija_grad, adresa, sprat, broj_soba, broj_kvadrata, stanje, prodano, opis,
                slika_url1, slika_url2, slika_url3, slika_url4, slika_url5, slika_url6, slika_url7, slika_url8, slika_url9, slika_url10 
              FROM nekretnina
              WHERE id = '$nekretnina_id'";
              $query_run = mysqli_query($conn, $query);
              if(mysqli_num_rows($query_run) > 0){
                $nekretnina = mysqli_fetch_array($query_run);
              }
            }
          ?>
					<form action="nekretninaCode.php" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label>Naziv nekretnine</label>
							<input type="text" name="naziv" class="form-control" value="<?=$nekretnina['naziv'];?>">
						</div>
            <div class="form-group">
							<label class="mt-3">Cijena nekretnine</label>
							<input type="number" name="cijena" class="form-control" value="<?=$nekretnina['cijena'];?>">
						</div>
            <!-- Zupanije i gradovi -->
            <div class="form-group">
              <label for="zupanija" class="mt-3">Županija:</label>
              <select class="form-select" id="zupanija" name="zupanija" onchange="popuniGradove()">
              </select>

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
							<input type="text" name="adresa" class="form-control" value="<?=$nekretnina['adresa'];?>">
						</div>
            <div class="form-group">
              <label for="sprat" class="mt-3">Sprat</label>
              <select class="form-select" id="sprat" name="sprat">
                <?php
                $defaultSprat = $nekretnina['sprat'];
                $options = ["-3", "-2", "-1", "Suteren", "Prizemlje", "Visoko prizemlje", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20+"];

                foreach ($options as $option) {
                  $selected = ($option == $defaultSprat) ? 'selected' : '';
                  echo '<option value="' . $option . '" ' . $selected . '>' . $option . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="broj_soba" class="mt-3">Broj soba</label>
              <select class="form-select" id="broj_soba" name="broj_soba">
                <?php
                $defaultBrojSoba = $nekretnina['broj_soba'];
                $options = ["Garsonjera", "Jednosoban", "Jednoiposoban", "Dvosoban", "Trosoban", "Četverosoban", "Petosoban i više"];

                foreach ($options as $option) {
                  $selected = ($option == $defaultBrojSoba) ? 'selected' : '';
                  echo '<option value="' . $option . '" ' . $selected . '>' . $option . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="form-group">
							<label class="mt-3">Broj kvadrata</label>
							<input type="number" name="broj_kvadrata" class="form-control" value="<?=$nekretnina['broj_kvadrata'];?>">
						</div>
            <div class="form-group">
              <label for="stanje" class="mt-3">Stanje</label>
              <select class="form-select" id="stanje" name="stanje">
                <?php
                $defaultStanje = $nekretnina['stanje'];
                $options = ["Novogradnja", "Renoviran", "Dobro stanje", "Parcijalno renoviran", "Za renoviranje", "U izgradnji"];

                foreach ($options as $option) {
                  $selected = ($option == $defaultStanje) ? 'selected' : '';
                  echo '<option value="' . $option . '" ' . $selected . '>' . $option . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label class="mt-3">Opis</label>
              <textarea class="form-control" id="opis" name="opis" style="height: 100px"><?=$nekretnina['opis'];?></textarea>

            </div>
            <div class="form-group">
              <label for="slika" class="mt-3 mb-3">Odaberite slike:</label>
            </div>
            <div class="delete-flex-container">
              <div class="delete-grid-container editing-add-row-grid">
                <!-- 1 -->
                <button class="btn btn-light delete-btn-custom" type="button" onclick="removeUploadedFile(this, document.querySelector('#slika1'), 1, 'previewOld1')">
                  <img src="../assets/svg/x-circle.svg" alt="X">
                </button>
                <input type="file" class="image-upload-button" name="imageUpload1" id="slika1" accept="image/*" onchange="previewImage(this, 'preview1', 'previewOld1')">
                <img id="preview1" src="../assets/No_Preview_image.png" alt="No Preview" class="preview-image">
                <img id="previewOld1" src="../assets/No_Preview_image.png" alt="No Preview" class="preview-image">
                <!-- 2 -->
                <button class="btn btn-light delete-btn-custom" type="button" onclick="removeUploadedFile(this, document.querySelector('#slika2'), 2, 'previewOld2')">
                  <img src="../assets/svg/x-circle.svg" alt="X">
                </button>
                <input type="file" class="image-upload-button" name="imageUpload2" id="slika2" accept="image/*" onchange="previewImage(this, 'preview2', 'previewOld2')">
                <img id="preview2" src="../assets/No_Preview_image.png" alt="No Preview" class="preview-image">
                <img id="previewOld2" src="../assets/No_Preview_image.png" alt="No Preview" class="preview-image">
                <!-- 3 -->
                <button class="btn btn-light delete-btn-custom" type="button" onclick="removeUploadedFile(this, document.querySelector('#slika3'), 3, 'previewOld3')">
                  <img src="../assets/svg/x-circle.svg" alt="X">
                </button>
                <input type="file" class="image-upload-button" name="imageUpload3" id="slika3" accept="image/*" onchange="previewImage(this, 'preview3', 'previewOld3')">
                <img id="preview3" src="../assets/No_Preview_image.png" alt="No Preview" class="preview-image">
                <img id="previewOld3" src="../assets/No_Preview_image.png" alt="No Preview" class="preview-image">
                <!-- 4 -->
                <button class="btn btn-light delete-btn-custom" type="button" onclick="removeUploadedFile(this, document.querySelector('#slika4'), 4, 'previewOld4')">
                  <img src="../assets/svg/x-circle.svg" alt="X">
                </button>
                <input type="file" class="image-upload-button" name="imageUpload4" id="slika4" accept="image/*" onchange="previewImage(this, 'preview4', 'previewOld4')">
                <img id="preview4" src="../assets/No_Preview_image.png" alt="No Preview" class="preview-image">
                <img id="previewOld4" src="../assets/No_Preview_image.png" alt="No Preview" class="preview-image">
                <!-- 5 -->
                <button class="btn btn-light delete-btn-custom" type="button" onclick="removeUploadedFile(this, document.querySelector('#slika5'), 5, 'previewOld5')">
                  <img src="../assets/svg/x-circle.svg" alt="X">
                </button>
                <input type="file" class="image-upload-button" name="imageUpload5" id="slika5" accept="image/*" onchange="previewImage(this, 'preview5', 'previewOld5')">
                <img id="preview5" src="../assets/No_Preview_image.png" alt="No Preview" class="preview-image">
                <img id="previewOld5" src="../assets/No_Preview_image.png" alt="No Preview" class="preview-image">
              </div>
              <div class="delete-grid-container mini-top-margin editing-add-row-grid">
                <!-- 6 -->
                <button class="btn btn-light delete-btn-custom" type="button" onclick="removeUploadedFile(this, document.querySelector('#slika6'), 6, 'previewOld6')">
                  <img src="../assets/svg/x-circle.svg" alt="X">
                </button>
                <input type="file" class="image-upload-button" name="imageUpload6" id="slika6" accept="image/*" onchange="previewImage(this, 'preview6', 'previewOld6')">
                <img id="preview6" src="../assets/No_Preview_image.png" alt="No Preview" class="preview-image">
                <img id="previewOld6" src="../assets/No_Preview_image.png" alt="No Preview" class="preview-image">
                <!-- 7 -->
                <button class="btn btn-light delete-btn-custom" type="button" onclick="removeUploadedFile(this, document.querySelector('#slika7'), 7, 'previewOld7')">
                  <img src="../assets/svg/x-circle.svg" alt="X">
                </button>
                <input type="file" class="image-upload-button" name="imageUpload7" id="slika7" accept="image/*" onchange="previewImage(this, 'preview7', 'previewOld7')">
                <img id="preview7" src="../assets/No_Preview_image.png" alt="No Preview" class="preview-image">
                <img id="previewOld7" src="../assets/No_Preview_image.png" alt="No Preview" class="preview-image">
                <!-- 8 -->
                <button class="btn btn-light delete-btn-custom" type="button" onclick="removeUploadedFile(this, document.querySelector('#slika8'), 8, 'previewOld8')">
                  <img src="../assets/svg/x-circle.svg" alt="X">
                </button>
                <input type="file" class="image-upload-button" name="imageUpload8" id="slika8" accept="image/*" onchange="previewImage(this, 'preview8', 'previewOld8')">
                <img id="preview8" src="../assets/No_Preview_image.png" alt="No Preview" class="preview-image">
                <img id="previewOld8" src="../assets/No_Preview_image.png" alt="No Preview" class="preview-image">
                <!-- 9 -->
                <button class="btn btn-light delete-btn-custom" type="button" onclick="removeUploadedFile(this, document.querySelector('#slika9'), 9, 'previewOld9')">
                  <img src="../assets/svg/x-circle.svg" alt="X">
                </button>
                <input type="file" class="image-upload-button" name="imageUpload9" id="slika9" accept="image/*" onchange="previewImage(this, 'preview9', 'previewOld9')">
                <img id="preview9" src="../assets/No_Preview_image.png" alt="No Preview" class="preview-image">
                <img id="previewOld9" src="../assets/No_Preview_image.png" alt="No Preview" class="preview-image">
                <!-- 10 -->
                <button class="btn btn-light delete-btn-custom" type="button" onclick="removeUploadedFile(this, document.querySelector('#slika10'), 10, 'previewOld10')">
                  <img src="../assets/svg/x-circle.svg" alt="X">
                </button>
                <input type="file" class="image-upload-button" name="imageUpload10" id="slika10" accept="image/*" onchange="previewImage(this, 'preview10', 'previewOld10')">
                <img id="preview10" src="../assets/No_Preview_image.png" alt="No Preview" class="preview-image">
                <img id="previewOld10" src="../assets/No_Preview_image.png" alt="No Preview" class="preview-image">
              </div>
            </div>
            <input type="hidden" value="<?=$nekretnina['id'];?>" id="id" name="id">
            <input type="hidden" value="<?=$nekretnina['lokacija_zupanija'];?>" id="tempZupanija" name="tempZupanija">
            <input type="hidden" value="<?=$nekretnina['lokacija_grad'];?>" id="tempGrad" name="tempGrad">
            <input type="hidden" value="<?=$nekretnina['slika_url1'];?>" id="tempSlikaUrl1" name="tempSlikaUrl1">
            <input type="hidden" value="<?=$nekretnina['slika_url2'];?>" id="tempSlikaUrl2" name="tempSlikaUrl2">
            <input type="hidden" value="<?=$nekretnina['slika_url3'];?>" id="tempSlikaUrl3" name="tempSlikaUrl3">
            <input type="hidden" value="<?=$nekretnina['slika_url4'];?>" id="tempSlikaUrl4" name="tempSlikaUrl4">
            <input type="hidden" value="<?=$nekretnina['slika_url5'];?>" id="tempSlikaUrl5" name="tempSlikaUrl5">
            <input type="hidden" value="<?=$nekretnina['slika_url6'];?>" id="tempSlikaUrl6" name="tempSlikaUrl6">
            <input type="hidden" value="<?=$nekretnina['slika_url7'];?>" id="tempSlikaUrl7" name="tempSlikaUrl7">
            <input type="hidden" value="<?=$nekretnina['slika_url8'];?>" id="tempSlikaUrl8" name="tempSlikaUrl8">
            <input type="hidden" value="<?=$nekretnina['slika_url9'];?>" id="tempSlikaUrl9" name="tempSlikaUrl9">
            <input type="hidden" value="<?=$nekretnina['slika_url10'];?>" id="tempSlikaUrl10" name="tempSlikaUrl10">
						<div class="mb-3 mt-3">
							<button type="submit" name="update_nekretnina" class="btn btn-primary">Uredi nekretninu</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="./js/placesForEdit.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="./js/nekretninaEdit.js"></script>
</body>
</html>








<?php }else{
	// header("Location: ../index.php");
	header("Location: " . $_SESSION['lastValidUrl']);
} ?>