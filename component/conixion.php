<?php 
    try {
        $con = new PDO("mysql:host=192.168.1.24;dbname=dashboard", "nouveau_utilisateur", "mot_de_passe");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
       catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
?>