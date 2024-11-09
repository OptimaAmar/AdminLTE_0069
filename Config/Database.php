<?php 
function GetKoneksi(){
    try{
        $db = new PDO ('mysql:host=localhost; dbname=toko_0069', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }catch (PDOException $e){
        echo "Connection Failed: " . $e->getMessage();

    }
}