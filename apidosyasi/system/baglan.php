<?php
try {
     $db = new PDO("mysql:host=localhost;dbname=kitapevi_otomasyonu;charset=utf8", "root", "");

} catch ( PDOException $e ){
     print $e->getMessage();
}

?>

