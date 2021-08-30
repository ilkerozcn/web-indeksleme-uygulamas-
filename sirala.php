<body style="background-color:powderblue;">

</body>
<form action="index.php" method="post"> 
    <input type="submit" value="ANASAYFA" />
</form>
<form action="index.php" method="post"> 
    <input type="submit" value="ANASAYFA" />
</form>
<?php
function anahtarkelimeBul($string){
    $stopWords = array('title','navbar','reflist','parser','view','facefont','stylenormalfont','width','margin','font','cookie','popup','banner'
    ,'sliding','button','class','have','your','would','page','which','there','some','just','0','1','2','3','4','5','6','7','8','9','i','a'
    ,'about','an','and','are','href','hrefcitenote','class','output','note','as','at','be','by','com','de','en','for','from','how','in','is','it','la'
    ,'of','on','or','that','the','this','to','was','what','when','where','who','will','with','und','the','www');

    $string = preg_replace('/\s\s+/i', '', $string); // replace whitespace
    $string = trim($string); // trim the string
    $string = preg_replace('/[^a-zA-Z -]/', '', $string); // only take alphanumerical characters, but keep the spaces and dashes too…
    $string = strtolower($string); // make it lowercase
    strip_tags($string);
    preg_match_all('/\b.*?\b/i', $string, $matchWords);
    $matchWords = $matchWords[0];

    foreach ( $matchWords as $key=>$item ) {
        if ( $item == '' || in_array(strtolower($item), $stopWords) || strlen($item) <= 3 ) {
            unset($matchWords[$key]);
        }
    }   
    $wordCountArr = array();
    if ( is_array($matchWords) ) {
        foreach ( $matchWords as $key => $val ) {
            $val = strtolower($val);
            if ( isset($wordCountArr[$val]) ) {
                $wordCountArr[$val]++;
            } else {
                $wordCountArr[$val] = 1;
            }
        }
    }
    arsort($wordCountArr);
    $wordCountArr = array_slice($wordCountArr, 0, 5);
    return $wordCountArr;
}
function benzerlikOrani($metin,$word){
    $metin = preg_replace('/\s\s+/i', '', $metin); // replace whitespace
    $metin = trim($metin); // trim the string
    $metin = preg_replace('/[^a-zA-Z -]/', '', $metin); // only take alphanumerical characters, but keep the spaces and dashes too…
    $metin = strtolower($metin); // make it lowercase
    $kelimeler = explode(' ', $metin);
    $word = preg_replace('/\s\s+/i', '', $word); // replace whitespace
    $word = trim($word); // trim the string
    $word = preg_replace('/[^a-zA-Z -]/', '', $word); // only take alphanumerical characters, but keep the spaces and dashes too…
    $word = strtolower($word); // make it lowercase
    $wor= explode(' ', $word);
   // $wor = explode(' ', $words);
   $sayi=0;
   $kont=0;
   $bos=0;
   $skor=1;
   $fin=0;
    foreach ($wor as $kontrol) {
        // kelimelerin sayısını tutacağımız değişkenimiz
        $sayac = 0;
        $kont++;
        // tüm kelimeleri bir biriyle kontrol etmek için tekrar döngüye sokuyoruz.
        foreach ($kelimeler as $kelime) {
            $sayi++;
           // echo $kontrol;
            // ilk döngüdeki kelime ile bu döngüdeki kelimenin eşitlik durumunu kontrol ediyoruz.
            if($kelime === $kontrol){
                // kelimeler eşit ise sayac değişkenimizi bir arttıyoruz.
                $sayac++;
                $bos++;
            }
        }
        // işlemlerin sonucunu sonuc adlı bir diziye hangi kelime ve kaç adet kullanıldığını aktarıyoruz.
        if($sayac>0){
        $sonuc[] = $kontrol." kelimesi ".$sayac." tane var";
        $skor=$skor*$sayac;}
      /*  if($sayac<=0 && $fin>5)
        $fin=$fin-7;
        if($sayac>0 && $sayac<10)
            $fin=$fin+4;
            if($sayac>=10 && $sayac<20)
            $fin=$fin+8;
            if($sayac>=10 && $sayac<20)
            $fin=$fin+12;
            if($sayac>=20 && $sayac<30)
            $fin=$fin+16;
            if($sayac>=30 && $sayac<65)
            $fin=$fin+18;
            if($sayac>=65)
            $fin=$fin+20;*/
            $ek=floatval(($sayac*20)/100);
            if($ek>20){
                while($ek>20){
                $ek=$ek-1;}
            }
            if($sayac==0){
                $fin=$fin-3;
            }
            if($sayac<20){
                $fin=$fin+$ek;
            }
            if($sayac>=1 && $sayac<20){
                $fin = $fin + $ek+2;}
            if($sayac>=20 && $sayac<30){
            $fin = $fin + $ek+4;}
            if($sayac>=30 && $sayac<40){
            $fin = $fin + $ek+6;}
            if($sayac>=40){
            $fin = $fin + $ek+8;}
            
         
        }
        echo "<font color = FF0000 size =5em>2 URL Arasındaki Benzerlik Oranı:     </font>";
        if($fin>100){
            while($fin>100){
                $fin=$fin-5;}}
                if($fin<0){
                    $fin=0;
                }
        echo floatval($fin);
    
   
    /*if($fin<1)
    echo " (Benzerlik Oranı :Çok Düşük)";
    if($fin>=1 && $fin <11) 
    echo " (Benzerlik Oranı :Düşük)";
    if($fin>=11 && $fin<25)
    echo " (Benzerlik Oranı :Orta)";
    if($fin>=25 && $fin<75)
    echo " (Benzerlik Oranı :Yüksek)";
    if($fin>=75)
    echo " (Benzerlik Oranı :Çok Yüksek)";*/
    echo"<br>";echo"<br>";
    echo"<font color = FF0000 size =5em>1. URLde Geçen Anahtar Kelimelerin Sayısı </font><br>";
    // php'nin hazır fonksiyonlarından array_unique ile bir dizideki aynı elamanların fazlasını siliyor hepsinden 1 adet bırakıyor.
    //Bu bizim sorunumuzu ortan kaldırıyor
    if ($bos>0){
    $sonuc = array_unique($sonuc);
    $sonuc = implode("<br>", $sonuc);
    
    return $sonuc;}
    else return "Hiç Ortak Kelime Yok";
}
function countOccurences($string, $word) {
    return $string.split($word).length - 1;
 }
$site1=$_POST['site1'];
$site2=$_POST['site2'];
$site3=$_POST['site3'];
$site4=$_POST['site4'];
$site5=$_POST['site5'];



//preg_match_all('/http[s]?[^\s]*/', $dri, $match);
//echo implode("<br> ",$match[0]);
$content=file_get_contents($site1);

$veri=strip_tags($content);
//preg_match("/<p.*\/p>/s", $veri, $matches);
$words= anahtarkelimeBul($veri);
echo  "<font color = FF0000 size =5em>2. URLdeki Anahtar Kelimeler </font>";
echo '<div style="font-size:1.25em;color:#0e3c68;font-weight:bold;"><span style="font-size:1.25em;color:#0e3c68;font-weight:bold;">'.implode(',', array_keys($words)).'</span></div>';
echo"<br>";
$content=file_get_contents($site2);
$dri=$content;

echo '<span style="font-size:3em;color:#0e3c68;font-weight:bold;">'."------------------------------1. URL-------------------------------------".'</span>';
echo"<br>";
echo '<span style="font-size:2em;color:#0e3c68;font-weight:bold;">'."ANA URL : ".'</span>'.$site2;
echo "<br>";
echo benzerlikOrani($content,implode(' ', array_keys($words)));
echo "<br>-----------------------------------------------------------------------------";
echo"<br>";
$dom = new DOMDocument();
@$dom->loadHTML($dri);
$xpath = new DOMXPath($dom);
$hrefs = $xpath->evaluate("/html/body//a");
$a=0;
for($i = 0; $i < $hrefs->length; $i++){
    $href = $hrefs->item($i);
    $url = $href->getAttribute('href');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    if(!filter_var($url, FILTER_VALIDATE_URL) === false){
        echo '<a href="'.$url.'">'.$url.'</a><br />';
        $content=file_get_contents($url);
        echo benzerlikOrani($content,implode(' ', array_keys($words)));
        echo "<br>-----------------------------------------------------------------------------<br>";
        echo"<br>";
        $a++;
    }
    if($a == 5)
    {break;}
}
echo "<br>-----------------------------------------------------------------------------";
echo"<br>";
$content=file_get_contents($site3);

echo '<span style="font-size:3em;color:#0e3c68;font-weight:bold;">'."------------------------------2. URL-------------------------------------".'</span>';
echo"<br>";
$dri=$content;
echo '<span style="font-size:2em;color:#0e3c68;font-weight:bold;">'."ANA URL : ".'</span>'.$site3;
echo "<br>";
echo benzerlikOrani($content,implode(' ', array_keys($words)));
echo "<br>-----------------------------------------------------------------------------";
echo"<br>";
$dom = new DOMDocument();
@$dom->loadHTML($dri);
$xpath = new DOMXPath($dom);
$hrefs = $xpath->evaluate("/html/body//a");
$a=0;
for($i = 0; $i < $hrefs->length; $i++){
    $href = $hrefs->item($i);
    $url = $href->getAttribute('href');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    if(!filter_var($url, FILTER_VALIDATE_URL) === false){
        echo '<a href="'.$url.'">'.$url.'</a><br />';
        $content=file_get_contents($url);
        echo benzerlikOrani($content,implode(' ', array_keys($words)));
        echo "<br>-----------------------------------------------------------------------------<br>";
        echo"<br>";
        $a++;
    }
    if($a == 5)
    {break;}
}
echo "<br>-----------------------------------------------------------------------------";
echo"<br>";
$content=file_get_contents($site4);
echo '<span style="font-size:3em;color:#0e3c68;font-weight:bold;">'."------------------------------3. URL-------------------------------------".'</span>';
echo"<br>";
$dri=$content;
echo '<span style="font-size:2em;color:#0e3c68;font-weight:bold;">'."ANA URL : ".'</span>'.$site4;
echo "<br>";
echo benzerlikOrani($content,implode(' ', array_keys($words)));
echo "<br>-----------------------------------------------------------------------------";
echo"<br>";
$dom = new DOMDocument();
@$dom->loadHTML($dri);
$xpath = new DOMXPath($dom);
$hrefs = $xpath->evaluate("/html/body//a");
$a=0;
for($i = 0; $i < $hrefs->length; $i++){
    $href = $hrefs->item($i);
    $url = $href->getAttribute('href');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    if(!filter_var($url, FILTER_VALIDATE_URL) === false){
        echo '<a href="'.$url.'">'.$url.'</a><br />';
        $content=file_get_contents($url);
        echo benzerlikOrani($content,implode(' ', array_keys($words)));
        echo "<br>-----------------------------------------------------------------------------<br>";
        echo"<br>";
        $a++;
    }
    if($a == 5)
    {break;}
}
echo "<br>-----------------------------------------------------------------------------";
echo"<br>";
$content=file_get_contents($site5);
echo '<span style="font-size:3em;color:#0e3c68;font-weight:bold;">'."------------------------------4. URL-------------------------------------".'</span>';
echo"<br>";
$dri=$content;
echo '<span style="font-size:2em;color:#0e3c68;font-weight:bold;">'."ANA URL : ".'</span>'.$site5;
echo "<br>";
echo benzerlikOrani($content,implode(' ', array_keys($words)));
echo "<br>-----------------------------------------------------------------------------";
echo"<br>";
$dom = new DOMDocument();
@$dom->loadHTML($dri);
$xpath = new DOMXPath($dom);
$hrefs = $xpath->evaluate("/html/body//a");
$a=0;
for($i = 0; $i < $hrefs->length; $i++){
    $href = $hrefs->item($i);
    $url = $href->getAttribute('href');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    if(!filter_var($url, FILTER_VALIDATE_URL) === false){
        echo '<a href="'.$url.'">'.$url.'</a><br />';
        $content=file_get_contents($url);
        echo benzerlikOrani($content,implode(' ', array_keys($words)));
        echo "<br>-----------------------------------------------------------------------------<br>";
        echo"<br>";
        $a++;
    }
    if($a == 5)
    {break;}
}
echo "<br>-----------------------------------------------------------------------------";
echo"<br>";/*
$content=file_get_contents($site5);
echo '<span style="font-size:3em;color:#0e3c68;font-weight:bold;">'."------------------------------5. URL-------------------------------------".'</span>';
echo"<br>";
$a=0;
for($i = 0; $i < $hrefs->length; $i++){
    $href = $hrefs->item($i);
    $url = $href->getAttribute('href');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    if(!filter_var($url, FILTER_VALIDATE_URL) === false){
        echo '<a href="'.$url.'">'.$url.'</a><br />';
        $content=file_get_contents($url);
        echo benzerlikOrani($content,implode(' ', array_keys($words)));
        echo "<br>-----------------------------------------------------------------------------<br>";
        echo"<br>";
        $a++;
    }
    if($a == 5)
    {break;}
}
echo "<br>-----------------------------------------------------------------------------";
echo"<br>";
//$veri=strip_tags($content);
//echo $veri;
//$word=implode(' ', array_keys($words));
//echo benzerlikOrani($veri,implode(' ', array_keys($words)));
*/


?>
