<?php

require "database.php";
$err="";
if (isset($_GET["submit"])) {
 

  //check if all fields were fields




  $user = $_GET["username"];
  $pass = $_GET["password"];
 


  if (empty($user) || empty($pass) ) {
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
   $rowcount=mysqli_num_rows($result);
   
   if($rowcount<=0)
   $err= "Error: No such user exists";
   
  else{
   while($row= mysqli_fetch_assoc($result)) {

        if(password_verify($pass,$row["pass"]))
      $err = 'Successful hack : Username '.$row["user"]." Password ".$pass ." Credit Card number : ".$row["credit"];
      else
      $err="Error: Wrong password ";
 
     
    } 
}
    
  
   
    mysqli_stmt_close($stm);
    mysqli_close($conn);
  }
$_GET["submit"]="";
}

?>



<?php
include "header.php";
?>
<div class="reg">
    <form action="hack.php" method="get">
        <?php

    echo "<p>";
    echo "$err";
    echo "</p>";




    ?>

        <input type="text" name="username" id="username" placeholder="Username" />
        <input type="password" name="password" id="password" placeholder="Password 2 digit number" />

        <input type="submit" value="HACK" name="submit"></input>


    </form>
</div>




</body>