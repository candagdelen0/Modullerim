<?php
require_once("baglan.php");
$gelenCevap = Filtre($_POST["cevap"]);

$kontrolSorgusu = $db->prepare("SELECT * FROM oykullananlar WHERE ipadresi = ? AND tarih >= ?"); 
$kontrolSorgusu->execute([$IPAdresi, $zamaniGeriAl]);
$kontrolSayisi = $kontrolSorgusu->rowCount();

if($kontrolSayisi>0) {
    echo "HATA!<br />";
    echo "Daha önce oy kullanmışsınız. Lütfen 24 saat sonra tekrar deneyin.<br />";
    echo "Anasayfaya dönmek için <a href='index.php'>tıklayınız</a>";
}else {
    
    if($gelenCevap==1) {
        $guncelle = $db->prepare("UPDATE anket SET oysayisibir=oysayisibir+1, toplamoysayisi=toplamoysayisi+1");
        $guncelle->execute();
    }elseif($gelenCevap==2) {
        $guncelle = $db->prepare("UPDATE anket SET oysayisiiki=oysayisiiki+1, toplamoysayisi=toplamoysayisi+1");
        $guncelle->execute();
    }elseif($gelenCevap==3) {
        $guncelle = $db->prepare("UPDATE anket SET oysayisiuc=oysayisiuc+1, toplamoysayisi=toplamoysayisi+1");
        $guncelle->execute();
    }else {
        echo "HATA<br />";
        echo "Geçersiz bir işlem yaptınız!<br />";
        echo "Anasayfaya dönmek için <a href='index.php'>tıklayınız</a>";
    }

    $ekle = $db->prepare("INSERT INTO oykullananlar(ipadresi,tarih) values (?, ?)");
    $guncelle->execute([$IPAdresi,$zamanDamgasi]);
    $ekleKontrol = $ekle->rowCount();

    if($ekleKontrol>0) {
        echo "Teşekkürler<br />";
        echo "Oyunuz sisteme kaydedildi!<br />";
        echo "Anasayfaya dönmek için <a href='index.php'>tıklayınız</a>";
    }else {
        echo "HATA<br />";
        echo "İşlem sırasında beklenmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.<br />";
        echo "Anasayfaya dönmek için <a href='index.php'>tıklayınız</a>";
    }
}
?>
