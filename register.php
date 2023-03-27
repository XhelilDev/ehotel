<?php 
    include('includes/header.php');
    
   

    $errors = [];

    if(isset($_POST['register_btn'])) {
        // data
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];


        if(empty($username)) {
            $errors[] = 'Vendo nje emer shfrytezuesi!';
        }

        if(empty($email)) {
            $errors[] = 'Email is required!';
        }

        if(empty($password)) {
            $errors[] = 'Password is required!';
        }

        if(empty($confirm_password)) {
            $errors[] = 'Repeat password is required!';
        }

        if($password !== $confirm_password) {
            $errors[] = 'Fields: Password & Repeat password must have same values!';
        }

        if(count($errors) === 0) {
            $data = [
                
                'username' => $username,
                'email' => $email,
                'password' =>$password
            ];
   
            // insert user -> db: users
            if($crud->create('users', $data)) {
                header('Location: login.php?action=register&status=1');
            } 
        }
    }
?>

<!-- Register -->
<div class="auth py-5">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-5 offset-lg-1 col-md-5 offset-md-1 col-sm-12 offset-sm-0 d-flex align-items-center">
                <div class="login w-100">
                    <h2>Register</h2>
                    <?php if($errors): ?>
                        <ul>
                        <?php foreach($errors as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="form-group">
                            <label for="username my-2">Fullname</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Sheno nje emer shfrytezuesi" />
                        </div>
                        <div class="form-group my-4">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" />
                        </div>
                        <div class="form-group my-4">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" />
                        </div>
                        <div class="form-group my-4">
                            <label for="confirm_password">Repeat password</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Repeat your password" />
                        </div>
                        <button type="submit" name="register_btn" class="btn btn-sm btn-outline-primary">Register</button>
                        <a href="login.php" class="btn btn-sm btn-link">Login</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>