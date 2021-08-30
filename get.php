<body style="background-color:powderblue;">
<form action="index.php" method="post"> 
    <input type="submit" value="ANASAYFA" />
</form>
<h1 style="color:red;">
    SİTEDEKİ KEYWORDLER
 </h1> 
</body>

<?php
function anahtarkelimeBul($string){
    $stopWords = array('title','navbar','reflist','parser','view','facefont','stylenormalfont','width','margin','font','cookie','popup','banner'
    ,'sliding','button','class','have','your','would','page','which','there','some','just','0','1','2','3','4','5','6','7','8','9','i','a'
    ,'about','an','and','are','href','hrefcitenote','class','output','note','as','at','be','by','com','de','en','for','from','how','in','is','it','la'
    ,'of','on','or','that','the','this','to','was','what','when','where','who','will','with','und','the','www');

    $string = preg_replace('/\s\s+/i', '', $string);
    $string = trim($string); // trim the string
    $string = preg_replace('/[^a-zA-Z -]/', '', $string); 
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
    $wordCountArr = array_slice($wordCountArr, 0, 10);
    return $wordCountArr;
}

$site=$_POST['site'];
//$veri=file_get_contents($site);
//echo file_get_html('http://www.google.com/')->plaintext;
/*preg_match_all(/<td.*?>(.*?)<\/td>/,$veri,$baslik);
$cikti= implode("",$baslik[1]);*/
$content=file_get_contents($site);
$veri=strip_tags($content);
preg_match_all("/\b[a-zA-Z0-9]{2,10}\b/", $veri, $veriler);
//preg_match("/<p.*\/p>/s", $veri, $matches);
$veri=$veriler[0];
$veri=implode(" ",$veri);
$words= anahtarkelimeBul($veri);
echo '<div style="font-size:1.25em;color:#0e3c68;font-weight:bold;"><span style="font-size:1.25em;color:#0e3c68;font-weight:bold;">'.implode(',', array_keys($words)).'</span></div>';
//echo implode(',', array_keys($words));
//echo impolde(',',array_keys($words[$val]));
//echo $veri;


?>

