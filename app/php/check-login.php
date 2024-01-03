<?php
session_start();
include "./db_conn.php";

if(isset($_POST['username']) && isset($_POST['password'])){
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
  
      $username = test_input($_POST['username']);
      $password = test_input($_POST['password']);
      $role = test_input($_POST['role']);


      if(empty($username)){
        header("Location: ../index.php?error=Potrebno je korisničko ime");
      }else if(empty($password)){
        header("Location: ../index.php?error=Potrebna je šifra");
      }else{
        $password = md5($password);
        echo $password;
        $sql = "SELECT * FROM users WHERE korisnicko_ime='$username' AND pass='$password'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            if ($row['pass'] === $password && $row[$role] == 1){
                $_SESSION['id'] = $row['id'];
                $_SESSION['korisnicko_ime'] = $row['korisnicko_ime'];
                $_SESSION['puno_ime'] = $row['puno_ime'];
                $_SESSION[$role] = $row[$role];
                $_SESSION['lastValidUrl'] = $_SERVER['REQUEST_URI'];


                if($role == "isAdmin") header("Location: ../forAdmin/home.php");
                else if($role == "isAgency") header("Location: ../forAgency/home.php");
                else if($role == "isUser") header("Location: ../forUser/home.php");

                
            } else header("Location: ../index.php?error=Neispravna uloga za prijavu");
        } else header("Location: ../index.php?error=Netočno korisničko ime ili šifra");
    }

}else{
    header("Location: ../index.php");
}

?>