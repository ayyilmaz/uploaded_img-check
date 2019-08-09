<?php 

$sabit_resim = "<img src='public/img/turkbayrak.JPG'>";
$dosya = "public/upload/$value->icerik_foto";
$resim_url = "$value->icerik_foto";
$find_letters = array('jpg', 'jpeg', 'png','gif');

$match = (str_replace($find_letters, '', substr($resim_url,-4)) != substr($resim_url,-4));
//resim_url son 4 karakteri ile $find_letters array içeirisindek kelime ya da harfler 4 karakterle eşleşiyorsa 1 eşleşmiyorsa false dönüyor
//şimdilik dış kaynaktan url eklerken sonu bu uzantılarla biten bir link olursa ekleyemiyoruz

if (empty($value->icerik_foto)) { //database'de resim bilgisi boş ise önceden belirlenmiş bir resmi yerleştiriyor
echo $sabit_resim;												
}elseif (file_exists($dosya)) { //eğer database'de fotoğraf bilgisi varas önce sunucuda olup olmadığını kontrol ediyor
echo "<img src='".$dosya."'>";
//print_r($dosya);
}elseif (strlen($resim_url)>=3) { //Eğer databaseden gelen verinin uzunluğu 3 karakterden fazlaysa
/*databaseden gelen resim urlsinin geçerliliğini kontrol ediyor $resim_url geçerli değil değilse ve uzantı kontrolü için oluşturduğumuz
$match true dönüyorsa urly yi src kısmına atıyor ve resmi dış kaynaktan çekiyor. */
if (filter_var($resim_url, FILTER_VALIDATE_URL) !== false && $match==true) { 
echo "<img src='".$resim_url."'>";
}else{
echo $sabit_resim; //inceki şart olmazsa sabit resim gelecek yine
}
}else{
echo $sabit_resim;
}

?>
