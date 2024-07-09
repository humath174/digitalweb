<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

</head>
<body class="bg-content">
<main class="dashboard d-flex">

<?php
include('component/sidebar.php');

?>


    <div class="bg-gray-100 min-h-screen flex items-center justify-center">
        <div class="w-full max-w-screen-xl">
            <div class="grid grid-cols-9 gap-4">
                <div class="grid-item border-4">01</div>
                <div class="grid-item border-4">02</div>
                <div class="grid-item border-4">03</div>
                <div class="grid-item border-4">04</div>
                <div class="grid-item border-4">05</div>
                <div class="grid-item border-4">06</div>
                <div class="grid-item border-4">07</div>
                <div class="grid-item border-4">08</div>
                <div class="grid-item border-4">09</div>
            </div>
        </div>
    </div>


</main>
    <script src="../../bbra/js/script.js"></script>
    <script src="/js/bootstrap.bundle.js"></script>
</body>

</html>