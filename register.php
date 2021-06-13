<?php
$err = " ";
$succ = "";
require "database.php";

if (isset($_POST["submit"])) {
  var_dump($err);

  //check if all fields were fields




  $user = $_POST["username"];
  $pass = $_POST["password"];
  $credit = $_POST["card"];


  if (empty($user) || empty($pass) || empty($credit)) {
    $err = "Error: Fields cannot be empty";
  } 
  
  else if(strlen($pass)!=2)
  {
    $err="Error: Password length 2";
  }
  
  else if($pass[0]<"0"|| $pass[0]>"9"||$pass[1]<"0"||$pass[1]>"9" )
  {
    $err="Error: Password must be 2 digit number";
  }
  else {
    $hpass = password_hash($pass, PASSWORD_DEFAULT);
    // check if username exists
    $sql = "Select * from users where user = ? ";
    $stm = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stm, $sql)) {
      echo "SQL statement failed.";
      die(0);
    }


    mysqli_stmt_bind_param($stm, "s", $user);
    mysqli_stmt_execute($stm);
    $result = mysqli_stmt_get_result($stm);
    $rowcount = mysqli_num_rows($result);
    if ($rowcount > 0) {
      $err = "Error: Username Exists";

      //   header("Location:register.php?error=usernameexists");
      //  exit();
    } 
    
  
    else {
      //add to database
      $sql = "Insert into users (user,pass,credit) values (?,?,?)";
      if (!mysqli_stmt_prepare($stm, $sql)) {
        echo "mysql error";
        die(0);
      }
      mysqli_stmt_bind_param($stm, "ssi", $user, $hpass, $credit);
      mysqli_stmt_execute($stm);
      $succ = "Success:Record Inserted!!!";
    }
    mysqli_stmt_close($stm);
    mysqli_close($conn);
  }
$_POST["submit"]="";
}

?>



<?php
include "header.php";
?>
<div class="reg">
    <form action="register.php" method="post">
        <?php

    echo "<p>";
    echo "$err";
    echo "</p>";


    echo "<p style='color:green;'>";
    echo "$succ";
    echo "</p>";

    ?>

        <input type="text" name="username" id="username" placeholder="Username" />
        <input type="password" name="password" id="password" placeholder="Password 2 digit number" />
        <input type="number" name="card" id="card" placeholder="Card number" />
        <input type="submit" value="SET" name="submit"></input>


    </form>
</div>




</body>