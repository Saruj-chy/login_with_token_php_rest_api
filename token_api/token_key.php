<?php
header('Content-Type: application/json');
require_once 'db.php';
require __DIR__ . '/../vendor/autoload.php';

mysqli_query($conn, 'SET CHARACTER SET utf8');
mysqli_query($conn, "SET SESSION collation_connection ='utf8_general_ci'");
$secretKey  = "39b4520289a6a707c1c8fc97dfcd428c4b7f379a5226a61debb334bc432fde65eb20c87cfe3fb86de56729788e8ce06a8d8ddfb356dec5ff0c2b50d6774c9036";
$refreshKey = "c05883b28c2cec33eafefdd5851c220c0c8226e68d086ab466d35c5ff87a44963475c68c1ff7c9f7c466ec0a9d99f1cbaea775d4824fe487cbb6c42164986cef";
