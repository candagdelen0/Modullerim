<?php
require_once("baglan.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anket</title>
</head>
<body>
    <?php
    $anketSorgu = $db->prepare("SELECT * FROM anket LIMIT 1");
    $anketSorgu->execute();
    $sayi = $anketSorgu->rowCount();
    $kayit = $anketSorgu->fetch(PDO::FETCH_ASSOC);

    if($sayi>0) {
    ?>
    <form action="oyver.php" method="POST">
        <table width="300" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr height="30">
                <td colspan="2"><?php echo $kayit["soru"]; ?></td>
            </tr>
            <tr height="30">
                <td width="25"><input type="radio" name="cevap" value="1"></td>
                <td width="275"><?php echo $kayit["cevapbir"]; ?></td>
            </tr>
            <tr height="30">
                <td width="25"><input type="radio" name="cevap" value="2"></td>
                <td width="275"><?php echo $kayit["cevapiki"]; ?></td>
            </tr>
            <tr height="30">
                <td width="25"><input type="radio" name="cevap" value="3"></td>
                <td width="275"><?php echo $kayit["cevapuc"]; ?></td>
            </tr>
            <tr height="30">
                <td colspan="2"><input type="submit" value="Oyu Gönder"></td>
            </tr>
            <tr height="30">
                <td colspan="2" align="right"><a href="sonuclar.php" style="text-decoration: none;">Anket Sonuçlarını Göster</a></td>
            </tr>
        </table>
    </form>
    <?php
    }else {
    ?>
    Anket Bulunmuyor..
    <?php
    } 
    ?>
</body>
</html>

<?php
$db = null;
?>