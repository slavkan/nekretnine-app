<?php 
  session_start();
  include "../php/db_conn.php";
  if (isset($_SESSION['korisnicko_ime']) && isset($_SESSION['id']) && isset($_SESSION['isUser'])) { $_SESSION['lastValidUrl2'] = $_SERVER['REQUEST_URI'];  ?>


<div class="messages-container">
  <?php
    if(isset($_GET['id'])){
      $razgovor_id = $_GET['id'];
      $owner_id = $_GET['owner_id'];
      $query = "SELECT p.id, razgovor_id, u.korisnicko_ime, posiljatelj_id, DATE_FORMAT(vrijeme, '%H:%i') AS formatted_vrijeme, datum, poruka
      FROM poruka_za_kupovinu as p
      INNER JOIN users as u ON p.posiljatelj_id = u.id
      WHERE razgovor_id = '$razgovor_id'
      ORDER BY id DESC;";
      $query_run = mysqli_query($conn, $query);
      if(mysqli_num_rows($query_run) > 0) {
        foreach($query_run as $poruka) {
            $containerClass = ($poruka['posiljatelj_id'] == $_SESSION['id']) ? 'poruka-container-right' : 'poruka-container-left';
            
            ?>
            <div class="poruka-container <?= $containerClass; ?>">
                <b><?= $poruka['korisnicko_ime']; ?></b>
                <div class="msg-content"><?= $poruka['poruka']; ?></div>
                <div class="date-time-row">
                    <div class="date-msg-container"><?= $poruka['datum']; ?></div>
                    <div><?= $poruka['formatted_vrijeme']; ?></div>
                </div>
            </div>
            <?php
        }
    }
      else{
        // echo "<h4 id='noMsg'>Nema poruka u razgovoru</h4>";
      }
    }
  ?>
</div>









<?php }else{
	// header("Location: ../index.php");
	header("Location: " . $_SESSION['lastValidUrl']);
} ?>