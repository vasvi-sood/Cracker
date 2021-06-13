<?php
$user="root";
$host="localhost";
$pass="";
$dbname="passwordHack";
$conn=mysqli_connect($host,$user,$pass,$dbname);
if(!$conn)
{
echo "failed to connect to db";
die(0);
}
