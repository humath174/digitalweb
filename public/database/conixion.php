<?php 
    try {
        $con = new PDO("mysql:host=192.168.1.24;dbname=bbra", "monty", "some_pass");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
       catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
?>