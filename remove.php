<?php 
    include 'pages/conixion.php';
    $id = $_GET['nom'];

    if(isset($id)){
        $stmt = $con ->prepare("DELETE FROM contact WHERE nom=$nom");
        $stmt -> execute();

    }
    header('location:contact-rec.php');
?>