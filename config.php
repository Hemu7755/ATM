<?php
$server="localhost";
$usename="root";
$password="";
$database="atm";
$conn=new mysqli ($server,$usename,$password,$database);
if($conn!="")
{
echo"";
}
    else
{
echo"connection error";
}
?>