<?php
include "header.php";
?>


<?php

$result="";
$wait="";
if(isset($_GET["submit"]))
{
$en=$_GET["en"];


$alphabets="1234567890";

// ob_flush();
// flush();

$flag=0;
for($i=0;$i<10;$i++)
{
for($j=0;$j<10;$j++)

{
    if(password_verify($alphabets[$i].$alphabets[$j],$en))
    {
    $result=$alphabets[$i].$alphabets[$j];
    $flag=1;
    break;
    }
    
}
if($flag==1)
break;
}
// ob_end_flush();
if($result==="")
$result="cannot determine password";
  
$wait ="";
}
?>

<div class="decrypt">
    <form action="index.php" method="GET">
        <input type="text" name="en" id="en" placeholder="Enter encrypted passowrd....">
        <input type="submit" value="Decrypt" name="submit">

        <?php
        echo "<p class='result'>";
        echo $result;
        echo "</p>";
       
        ?>
    </form>
</div>

<div class="users">
    <table>
        <tr>

            <th>
                Username
            </th>
            <th>
                Encrypted Password
            </th>

        </tr>

        <?php
        include "database.php";
        $sql = "Select * from users";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) { ?>

        <tr>
            <?php
            echo "<td>";
            echo $row["user"];
            echo "</td>";
            echo "<td>";
            echo $row["pass"];
            echo "</td>";
        }

            ?>
        </tr>
    </table>
</div>