<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

       <!-- bootstrap css -->
       <link rel="stylesheet" href="../css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="../css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="../css/responsive.css">
            <!-- Scrollbar Custom CSS -->
            <link rel="../stylesheet" href="css/jquery.mCustomScrollbar.min.css">

           
</head>
<body>


<div class="header">

            <div class="container">
               <div class="row">
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                     <div class="full">
                        <div class="center-desk">
                           <div class="logo">
                              <a href="http://localhost/e-hotel/dashboard/dhoma/index.php"><img src="../images/logo.png" alt="#" /></a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                     <nav class="navigation navbar navbar-expand-md navbar-dark ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarsExample04">
                           <ul class="navbar-nav mr-auto">
                          
                           <li class="nav-item active">
                                 <a class="nav-link text-12" href="http://localhost/e-hotel/dashboard/index.php">Home</a>
                              </li>
                              
                              <li class="nav-item">
                                 <a class="nav-link text-12" href="http://localhost/e-hotel/dashboard/dhoma/index.php">Dhoma</a>
                              </li>
                              <li class="nav-item ">
                                 <a class="nav-link text-12" href="http://localhost/e-hotel/dashboard/dhoma/dhoma.php">Regjistro</a>
                              </li>
                              <li class="nav-item ">
                                 <a class="nav-link text-12" href="http://localhost/e-hotel/dashboard/categories/index.php">Kategorite</a>
                              </li>
                              <li class="nav-item fs-6">
                                 <a class="nav-link" href="http://localhost/e-hotel/dashboard/categories/create.php">Regjistro</a>
                              </li>
                              <li class="nav-item fs-6">
                                 <a class="nav-link" href="http://localhost/e-hotel/dashboard/rezervimet/rezervimet.php">Rezervimet</a>
                              </li>
                              <li class="nav-item fs-6">
                              <a class="nav-link" href="?action=logout">Sign out</a>
                           </li>
                           </ul>
                        </div>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </header>

</body>
</html>
      <?php 
session_start();

// $customer_pages = [
//     '/e-hotel/dashboard/index.php'
    
// ];

// $current_page = $_SERVER['SCRIPT_NAME'];

// if(isset($_SESSION['is_loggedin']) && $_SESSION['is_loggedin'] == 1) {
//     if(isset($_SESSION['roli']) && $_SESSION['roli'] === 'customer') {
//         if(!in_array($current_page, $customer_pages)) {
//             die("You don't have permissions to view this page!");
//         }
//     }
// } else {
//     die("You don't have permissions to view this page!");
// }


if(isset($_GET['action']) && ($_GET['action'] === 'logout')) {
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['is_loggedin']);
    unset($_SESSION['roli']);

    header('Location: http://localhost/e-hotel/');
}

?>


<?php 
 

include('../classes/CRUD.php');
$crud = new CRUD;


$kategori = count($crud->read('kategori'));
$dhoma = count($crud->read('dhoma'));
$users=count($crud->read('users'));

$rezervimet = 0;



if(isset($_SESSION['roli'])) {
    if($_SESSION['roli'] == 'admin') {
        $users = count($crud->read('users'));
    } else if($_SESSION['roli'] == 'customer') {
        $users = count($crud->read('users', ['column' => 'id', 'value' => $_SESSION['id']]));
    }
}


?>

    <div class="container my-5">
        <div class="d-flex justify-content-between mb-5">
            <div>
                <h3><?= $_SESSION['roli'] ?></h3>
               
            </div>
            <div>
                <a href="?action=logout" class="btn btn-sm btn-outline-secondary" onclick="return confirm('Are you sure?')">
                    Log out
                </a>
            </div>
        </div>
        <div class="row">
         

            <?php if(isset($_SESSION['roli']) && $_SESSION['roli'] == 'admin'): ?>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h2><?= $kategori ?></h2>
                        <p>Kategorite e dhomave</p>
                        <a href="categories/" class="btn btn-sm btn-outline-danger">Manage</a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if(isset($_SESSION['roli']) && $_SESSION['roli'] == 'admin'): ?>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h2><?= $dhoma ?></h2>
                        <p>Dhomat</p>
                        <a href="dhoma/" class="btn btn-sm btn-outline-danger">Manage</a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h2><?= $rezervimet ?></h2>
                        <p>Orders</p>
                        <a href="orders/" class="btn btn-sm btn-outline-secondary">Manage</a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>


    <?php include('includes/footer.php'); ?>