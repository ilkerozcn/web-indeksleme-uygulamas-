
<body style="background-color:powderblue;">

</body>
<form action="index.php" method="post"> 
    <input type="submit" value="ANASAYFA" />
</form>
<?php
function kelime_say($metin){


   
    foreach ($metin as $met) {
        $count = 0;
        foreach ($metin as $kontrol) {
   
            if($met === $kontrol){

                $count++;
            }
        }
        $sonuc[] = '<span style="font-size:1.25em;color:#0e3c68;font-weight:bold;">'.$met.'</span>'." kelimesi tekrarlanma sayısı : ".$count;
    }

    $sonuc = array_unique($sonuc);

    $sonuc = implode("<br>", $sonuc);

    // geriye sonuc adlı değişkeni gönderiyoruz.
    return $sonuc;
}

$site=$_POST['site'];
$content=file_get_contents($site);
$dri=$content;
//preg_match_all('/http[s]?[^\s]*/', $dri, $match);
//echo implode("<br> ",$match[0]);

$veri=strip_tags($content);
preg_match_all("/\b[a-zA-Z]{2,10}\b/", $veri, $veriler);
$veri=$veriler[0];


echo kelime_say($veri);




?>
