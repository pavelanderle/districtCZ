<?php
    $idk=$_GET['idk'];

    $conn = new mysqli("localhost", "root", "root", "kraje_okresy");
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql="SET CHARACTER SET UTF8";
    $conn->query($sql);

    $sql = "SELECT kod,nazev FROM okres where kraj_id='$idk'";
   
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $okres[]=$row;
      }
    } else {
        $okres=[];
    }

    echo json_encode($okres);

    $conn->close();