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

    $anketBirinciOysayisi = $kayit["oysayisibir"];
    $anketIkinciOysayisi = $kayit["oysayisiiki"];
    $anketUcuncuOysayisi = $kayit["oysayisiuc"];
    $anketToplamOysayisi = $kayit["toplamoysayisi"];

    $birinciYuzdeHesap =  ($anketBirinciOysayisi/$anketToplamOysayisi)*100;
    $birinciYuzdeFormat = number_format($birinciYuzdeHesap, 2, ",","");
    $ikinciYuzdeHesap =  ($anketIkinciOysayisi/$anketToplamOysayisi)*100;
    $ikinciYuzdeFormat = number_format($ikinciYuzdeHesap, 2, ",","");
    $ucuncuYuzdeHesap =  ($anketUcuncuOysayisi/$anketToplamOysayisi)*100;
    $ucuncuYuzdeFormat = number_format($ucuncuYuzdeHesap, 2, ",","");


    if($sayi>0) {
    ?>
    <table width="300" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="30">
            <td colspan="2"><?php echo $kayit["soru"]; ?></td>
        </tr>
        <tr height="30">
            <td width="75">% <?php echo $birinciYuzdeFormat; ?></td>
            <td width="275"><?php echo $kayit["cevapbir"]; ?></td>
        </tr>
        <tr height="30">
            <td width="75">% <?php echo $ikinciYuzdeFormat; ?></td>
            <td width="275"><?php echo $kayit["cevapiki"]; ?></td>
        </tr>
        <tr height="30">
            <td width="75">% <?php echo $ucuncuYuzdeFormat; ?></td>
            <td width="275"><?php echo $kayit["cevapuc"]; ?></td>
        </tr>
        <tr height="30">
            <td colspan="2" align="right"><a href="index.php" style="text-decoration: none;">Anasayfaya Dön</a></td>
        </tr>
    </table>    
    <?php
    }else {
        header("Location:index.php");
        exit();
    } 
    ?>
</body>
</html>

<?php
$db = null;
?>