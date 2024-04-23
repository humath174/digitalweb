<?php 
    include 'conixion.php';
    if(isset($_POST['submit'])){


        $Name = $_POST['Name'];
        $Email = $_POST['Email'];
        $Phone = $_POST['Phone'];


        $requete = $con->prepare("INSERT INTO client (nom,email,telephone) VALUES('$Name','$Email','$Phone')");
        //$requete->execute(array($image,$Name,$Email,$Phone,$EnrollNumber,$DateOfAdmission));
        $requete->execute();
    }
    header('location:./bbra/fichier_client.php')
    ?>