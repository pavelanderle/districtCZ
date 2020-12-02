<?php
    require "vendor/autoload.php";
    
    $latte = new Latte\Engine;

    $latte->setTempDirectory('temp');

    $conn = new mysqli("localhost", "root", "root", "kraje_okresy");
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql="SET CHARACTER SET UTF8";
    $conn->query($sql);

    $sql = "SELECT id,nazev FROM kraj";
   
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $kraje[]=$row;
      }
    } else {
        $kraje=[];
    }
    $conn->close();
    
    $params = [
        'kraje' => $kraje,
    ];

    
    
    
    $latte->render('template/homeTemplate.latte', $params);
?>