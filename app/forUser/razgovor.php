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
  <link rel="stylesheet" href="./css/razgovor.css">
  <script defer src="http://localhost:3001/socket.io/socket.io.js"></script>
  <script defer src="./js/script.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <title>Nekretnine</title>
  <link rel="icon" type="image/x-icon" href="/favicon.ico">
</head>
<body onload = "table();">
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
    $sender_id = $_GET['idSender'];
    $reciever_id = $_GET['idReciever'];
    $nekretnina_id = $_GET['idNekretnina'];

    $query = "SELECT r.vlasnik_id, r.kupac_id, r.nekretnina_id,
    uS.korisnicko_ime AS vlasnik_name,
    uR.korisnicko_ime AS kupac_name
    FROM razgovor_za_kupovinu AS r
    INNER JOIN users AS uS ON r.vlasnik_id = uS.id
    INNER JOIN users AS uR ON r.kupac_id = uR.id
    WHERE r.vlasnik_id = '$reciever_id' AND r.kupac_id = '$sender_id' AND r.nekretnina_id = '$nekretnina_id';";
    
    $query_run = mysqli_query($conn, $query);
    if(mysqli_num_rows($query_run) == 0){
      $currentDate = date("Y-m-d");
      $currentTime = date("H:i:s");
      $queryCreateNewConvo = "
      INSERT INTO razgovor_za_kupovinu (nekretnina_id, vlasnik_id, kupac_id, datum, vrijeme)
      VALUES ('$nekretnina_id', '$reciever_id', '$sender_id', '$currentDate', '$currentTime');";
      $query_run = mysqli_query($conn, $queryCreateNewConvo);

      // echo "new convo created";
    }

    $query = "SELECT r.id, r.vlasnik_id, r.kupac_id, r.nekretnina_id,
    uR.korisnicko_ime AS vlasnik_name,
    uS.korisnicko_ime AS kupac_name,
    uR.profile_picture_url AS sender_pic,
    uS.profile_picture_url AS reciever_pic
    FROM razgovor_za_kupovinu AS r
    INNER JOIN users AS uS ON r.kupac_id = uS.id
    INNER JOIN users AS uR ON r.vlasnik_id = uR.id
    WHERE r.vlasnik_id = '$reciever_id' AND r.kupac_id = '$sender_id' AND r.nekretnina_id = '$nekretnina_id';";
    // echo $query;
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) > 0){
      foreach($query_run as $razgovor_info){
        // var_dump($razgovor_info);

        $owner_id = $razgovor_info["vlasnik_id"];
        $owner_name = $razgovor_info["vlasnik_name"];
        $owner_pic = $razgovor_info["reciever_pic"];

        $buyer_id = $razgovor_info["kupac_id"];
        $buyer_name = $razgovor_info["kupac_name"];
        $buyer_pic = $razgovor_info["sender_pic"];

        $your_name = $_SESSION['korisnicko_ime'];
        $your_id = $_SESSION['id'];
        $chat_id = $razgovor_info['id'];

        ?>
        <form enctype="multipart/form-data" id="send-container">
          <div class="new-msg-form">
            <div class="form-group container">
              <input type="text" name="newMsg" class="form-control" placeholder="New message" id="newMsgField">
              <input type="text" name="your_name" id="your_name" value="<?php echo $your_name; ?>" hidden>
              <input type="text" name="your_id" id="your_id" value="<?php echo $your_id; ?>" hidden>
              <input type="text" name="chat_id" id="chat_id" value="<?php echo $chat_id; ?>" hidden>
            </div>
            <div class="mb-3 mt-3 container">
              <button type="submit" name="save_razgovor" id="addBtn" class="btn btn-primary" id="sendButton" >Pošalji poruku</button>
            </div>
          </div>
        </form>
          <div id="output"></div>
        <div id="razgovorIdDiv" class="container my-3 razgovor-container" style="min-height: 70px">
          
          <script type="text/javascript">
            function table(){
              const xhttp = new XMLHttpRequest();
              xhttp.onload = function(){
                document.getElementById("razgovorIdDiv").innerHTML = this.responseText;
              }
              xhttp.open("GET", "chatGet.php?id=<?php echo $chat_id; ?>&owner_id=<?php echo $owner_id; ?>");
              xhttp.send();
            }
          </script>
        </div>

        <script>
          $(document).ready(function(){
            $('#addBtn').click(function(){
              $.ajax({
                type: 'POST',
                url: 'newMessage.php',
                data: {
                  newMsg: $('#newMsgField').val(),
                  your_id: $('#your_id').val(),
                  chat_id: $('#chat_id').val(),
                },
              })
            });
          });
        </script>

      <?php
      }
    }
    else{
      // echo "<h5>Nije moguce pokrenuti razgovor</h5>";
    }
  ?>
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- <script src="./js/sidebar.js"></script> -->
<!-- <script src="../placesOnChange.js"></script> -->
</body>
</html>

<?php }else{
	// header("Location: ../index.php");
	header("Location: " . $_SESSION['lastValidUrl']);
} ?>