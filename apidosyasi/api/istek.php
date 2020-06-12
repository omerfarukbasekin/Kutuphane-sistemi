<?php session_start();
include '../system/baglan.php';
include '../system/fonksiyon.php';
$islem = isset($_GET["islem"]) ? addslashes(trim($_GET["islem"])) : null;
$jsonArray = array(); 
$jsonArray["hata"] = FALSE; 
 
$_code = 200; 
$_method = $_SERVER["REQUEST_METHOD"]; 

if($_SERVER['REQUEST_METHOD'] == "GET") {
 
    $query = $db->query("SELECT * FROM kitaplar", PDO::FETCH_ASSOC);
    if ( $query->rowCount() ){

         foreach( $query as $row ){
             $jsonArray["veri"][] =  $row;
         }
    }
    
}
else if($_SERVER['REQUEST_METHOD'] == "POST") {
    $kitapadi = $_GET["kitapadi"];
    $kitapyazari = $_GET["kitapyazari"];
    $kitapturu = $_GET["kitapturu"];
    $kitapmevcut = $_GET["kitapmevcut"];

    $query = $db->exec("INSERT INTO `kitaplar`(`kitapadi`, `kitapyazari`, `kitapturu`, `kitapmevcut`) VALUES ('{$kitapadi}','{$kitapyazari}','{$kitapturu}','{$kitapmevcut}')");
    if ( $query){

         $jsonArray["mesaj"] = "Kayıt Yapıldı";
    }
    else
    {
        $jsonArray["hata"] = TRUE; 
        $jsonArray["hataMesaj"] = "hata oluştu"; 
    }
    
}
else if($_SERVER['REQUEST_METHOD'] == "PUT") {
    $kitapadi = $_GET["kitapadi"];
    $kitapyazari = $_GET["kitapyazari"];
    $kitapturu = $_GET["kitapturu"];
    $kitapmevcut = $_GET["kitapmevcut"];
    $id = $_GET["id"];

    $query = $db->exec("UPDATE `kitaplar` SET `kitapadi`='{$kitapadi}',`kitapyazari`='{$kitapyazari}',`kitapturu`='{$kitapturu}',`kitapmevcut`='{$kitapmevcut}' WHERE `id`='{$id}'");
    if ( $query){

         $jsonArray["mesaj"] = "Kayıt Güncellendi";
    }
    else
    {
        $jsonArray["hata"] = TRUE; 
        $jsonArray["hataMesaj"] = "hata oluştu"; 
    }
    
}
else if($_SERVER['REQUEST_METHOD'] == "DELETE") {
    $id = $_GET["id"];

    $query = $db->exec("DELETE FROM `kitaplar` WHERE `id`='{$id}'");
    if ( $query){

         $jsonArray["mesaj"] = "Kayıt Silindi";
    }
    else
    {
        $jsonArray["hata"] = TRUE; 
        $jsonArray["hataMesaj"] = "hata oluştu"; 
    }
    
}
else { 
    $jsonArray["hata"] = TRUE; 
    $jsonArray["hataMesaj"] = "Girilen İşlem Bulunmuyor."; 
}
 
SetHeader($_code);
$jsonArray[$_code] = HttpStatus($_code);
echo json_encode($jsonArray);
 ?>