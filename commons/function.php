<?php

// Hỗ trợ show bất kỳ data nào
function debug($data)
{
    echo "<pre>";

    print_r($data);

    die;
}

// Kết nối CSDL qua PDO

class connect_db {
function connect_db(){
    $hostname=DB_HOST;
    $dbname=DB_NAME;
    try{
        $conn= new PDO("mysql:host=$hostname;dbname=$dbname",DB_USERNAME,DB_PASSWORD);
        // Cài đặt chế độ sử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        // Cài đặt chế độ trả về dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        return $conn;
    }catch(PDOException $e){
        $e->getMessage();
    }
}
}