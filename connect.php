<?php
$host = '127.0.0.1';
$db   = 'add_inf'; // Tên cơ sở dữ liệu
$user = 'root'; 
$pass = ''; 
$charset = 'utf8mb4';

// Sửa dòng này: sử dụng biến $db thay vì $add_inf
$dsn = "mysql:host=$host;dbname=$db;charset=$charset"; 
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Kết nối thành công!";
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>