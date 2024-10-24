<?php
$host = 'localhost'; // ชื่อโฮสต์
$db = 'tirawit'; // ชื่อฐานข้อมูล
$user = 'root'; // ชื่อผู้ใช้
$pass = ''; // รหัสผ่าน

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $e->getMessage();
    exit; // หยุดการทำงานของสคริปต์เมื่อเชื่อมต่อไม่สำเร็จ
}
?>
