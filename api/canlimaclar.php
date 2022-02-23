<?php

if(@$_GET['tarih'] == "") {
    $uyari = 'Lütfen Tarihi Giriniz.';
    die($uyari);
}
$date=explode("/",$_GET['tarih']);
if(checkdate ($date[1] ,$date[0] ,$date[2]))
{
    $tarih = $_GET['tarih'];
}
else 
{
    $uyari = 'Lütfen Tarihi Giriniz.';
    die($uyari);
}
$veri = file_get_contents("http://goapi.mackolik.com/livedata?date=" . $_GET['tarih']);
$dizi = json_decode($veri, true);
$maclar = $dizi['m'];
$v = "0";
$sayi = count($maclar);
    for ($i=0; $i<$sayi; $i++)
      {
        //if (empty($maclar[$i][6]) || $maclar[$i][6] === "MS")
        if($maclar[$i][23] !== 1)
        {
            unset($maclar[$i]);
        }
        else
        {
            $mac[$v] = $maclar[$i];
            $v++;
        }

      }
$sayi1 = count($mac);
echo json_encode([
    "maclar" => $mac
]);
?>