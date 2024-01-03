<?php
require '../php/db_conn.php';

$newMsg = $_POST["newMsg"];
$your_id = $_POST["your_id"];
$chat_id = $_POST["chat_id"];
$currentDate = date("Y-m-d");
$currentTime = date("H:i:s");

$query = "INSERT INTO poruka_za_kupovinu (razgovor_id, posiljatelj_id, datum, vrijeme, poruka)
          VALUES ('$chat_id', '$your_id', '$currentDate', '$currentTime', '$newMsg')";

$query_run = mysqli_query($conn, $query);

echo json_encode(['status' => 'success', 'message' => "Sent"]);

?>