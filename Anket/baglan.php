<?php
try{
    $db = new PDO("mysql:host=localhost;dbname=modullerim;charset=UTF8","root","");
}catch (PDOException $Hata) {
    echo "Bağlantı Hatası<br />". $Hata->getMessage();
    die();
}
function Filtrele($deger) {
    $a = trim($deger); 
    $b = strip_tags($a); 
    $c = htmlspecialchars($b, ENT_QUOTES);
    $sonuc = $c;
    return $sonuc;
}

$IPAdresi = $_SERVER["REMOTE_ADDR"];
$zamanDamgasi = time();
$oyKullanmaSiniri = 86400;
$zamaniGeriAl = $zamanDamgasi - $oyKullanmaSiniri;


?>