<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

       <!-- bootstrap css -->
       <link rel="stylesheet" href="../../css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="../../css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="../../css/responsive.css">
            <!-- Scrollbar Custom CSS -->
            <link rel="../../stylesheet" href="css/jquery.mCustomScrollbar.min.css">
</head>
<body>


<div class="header">

            <div class="container">
               <div class="row">
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                     <div class="full">
                        <div class="center-desk">
                           <div class="logo">
                              <a href="http://localhost/e-hotel/dashboard/dhoma/index.php"><img src="images/logo.png" alt="#" /></a>
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
                          

                          
                              <li class="nav-item ">
                                 <a class="nav-link fs-6" href="http://localhost/e-hotel/dashboard/dhoma/index.php">Dhoma</a>
                              </li>
                              <li class="nav-item fs-6 ">
                                 <a class="nav-link" href="http://localhost/e-hotel/dashboard/dhoma/dhoma.php">Regjistro</a>
                              </li>
                              
                              <li class="nav-item fs-6">
                                 <a class="nav-link" href="http://localhost/e-hotel/dashboard/categories/index.php">Kategorite</a>
                              </li>
                              <li class="nav-item fs-6">
                                 <a class="nav-link" href="http://localhost/e-hotel/dashboard/categories/create.php">Regjistro Kateg</a>
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
      <?php 
session_start();

$customer_pages = [
   'http://localhost/e-hotel/dashboard/index.php',
   'http://localhost/e-hotel/dashboard/dhoma/dhoma.php',
   'http://localhost/e-hotel/dashboard/categories/index.php',
   'http://localhost/e-hotel/dashboard/categories/create.php'
    
];

$current_page = $_SERVER['SCRIPT_NAME'];

if(isset($_SESSION['roli'])) {
    if( $_SESSION['roli'] === 'admin') {
        if(in_array($current_page, $customer_pages)) {
            die("You don't have permissions to view this page!");
        }
    }
 else {
    die("You don't have permissions to view this page!");
}
}


if(isset($_GET['action']) && ($_GET['action'] === 'logout')) {
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['is_loggedin']);
    unset($_SESSION['roli']);

    header('Location: http://localhost/e-hotel/');
}

?>