<?php 
    include 'pages/conixion.php';
    $id = $_GET['Id'];

    if(isset($id)){
        $stmt = $con ->prepare("DELETE FROM devis WHERE Id=$id");
        $stmt -> execute();

    }
    header('location:devis-rec.php');
?>