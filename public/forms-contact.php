<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AriztoDynamics - Contact</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="./assets/js/init-alpine.js"></script>
  </head>
  <body>
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen}"
    >

    <?php
include ('assets/sidebar.php');
    ?>
                
            <div class="student-list-header d-flex justify-content-between align-items-center py-2">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Demande de contact
            </h2>
            <div class="btn-add d-flex gap-3 align-items-center">
                <div class="short">
                    <i class="far fa-sort"></i>
                </div>
                <?php include 'component/popupadd.php'; ?>
            </div>
        </div>
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                    
                    <th class="px-4 py-3">Nom</th>
                    <th class="px-4 py-3">Prenom</th>
                    <th class="px-4 py-3">Mail</th>
                    <th class="px-4 py-3">Telephone</th>
                    <th class="px-4 py-3">Description</th>
                   
                </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                <?php
               

                include 'database/conixion.php';
                $entreprise_id = $_SESSION['entreprise_id'];
                $result = $con->query("SELECT * FROM demande_contact WHERE entreprise_id = $entreprise_id");
                foreach($result as $value):

                    ?>
                    <tr class="text-gray-700 dark:text-gray-400">
                    <div class="flex items-center text-sm">
                       
                        <div>
                            <p class="font-semibold"> <td class="px-4 py-3"><?php echo $value['nom'] ?></td></p>
                           
                          </div>
                    </div>
                        <td class="px-4 py-3"><?php echo $value['prenom'] ?></td>
                        <td class="px-4 py-3"><?php echo $value['mail'] ?></td>
                        <td class="px-4 py-3"><?php echo $value['telephone'] ?></td>
                        <td class="px-4 py-3"><?php echo $value['message'] ?></td>
                        <td class="d-md-flex gap-3 mt-3">
                            <a href="remove.php?Id=<?php echo $value['nom']?>"><i class="far fa-trash"></i></a>
                        </td>
                    </tr>

                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        </div>
          
        </main>
      </div>
    </div>
  </body>
</html>
