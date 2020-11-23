<?php
//$adatbazis = "blan_S6Y0DM";
//$kapcsolat=mysqli_connect("127.0.0.1","blan_S6Y0DM","P8mlJvf1");
$adatbazis ="ora8";
$kapcsolat=mysqli_connect("127.0.0.1","root","");
if(!$kapcsolat)
{
    die("Nem sikerült csatlakozni a kiszolgálóhoz ".mysqli_error($kapcsolat));
}else{
    //echo "Sikeres csatlakozás<br>";
    mysqli_select_db($kapcsolat, $adatbazis) or die("Nem lehet megnyitni az adatbazist. ".mysqli_error($kapcsolat));
    //echo "Kiválasztott adatbazis: ".$adatbazis."<br>";
}


?>