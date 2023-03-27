<?php


include('includes/header.php');
$database = Database::getInstance()->getConnection();



if (isset($_POST['email']) && isset($_POST['password'])) {
  // Marrim vlerat nga forma e login-it
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Verifikojmë kredencialet
  $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
  $result = $database->query($sql);
 
  
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['user_id'] = $row['id']; // Ruajmë id e userit në sesion
    $_SESSION['roli'] = $row['roli']; // Ruajmë rolin e userit në sesion
  
    // Kontrollojmë nëse useri është admin ose customer
 
    if ($_SESSION['roli'] == 'admin') {
      header('Location: dashboard/index.php'); // Shkojme ne faqen dashboard.php
      exit(); // Duhet te jete e sigurte qe kodi i tjere nuk do te ekzekutohet
    } elseif ($_SESSION['roli'] == 'customer') {
      header('Location: shiko_dhomat.php'); // Shkojme ne faqen rezervo.php
     
      exit(); // Duhet te jete e sigurte qe kodi i tjere nuk do te ekzekutohet
    }
    
  } else {
    echo 'Kredencialet janë gabim.';
  }
 
}
 // Mbyllim lidhjen me databazën
?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        
<div class="auth py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
            
            </div>
            <div class="col-lg-5 offset-lg-1 col-md-5 offset-md-1 col-sm-12 offset-sm-0 d-flex align-items-center">
                <div class="login w-100">
                    <h2>Login</h2>
                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="form-group my-4">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" />
                        </div>
                        <div class="form-group my-4">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" />
                        </div>
                        <button type="submit" name="login_btn" class="btn btn-sm btn-outline-danger">Login</button>
                        <a href="register.php" class="btn btn-sm btn-link text-danger">Regjistrohu</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


    </body>
    </html>


<?php include('includes/footer.php'); ?>
