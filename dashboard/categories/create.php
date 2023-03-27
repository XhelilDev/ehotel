<?php 
      include('../includes/header.php'); 
      include('../../classes/CRUD.php');

    $errors = [];
    $crud = new CRUD;

    if(isset($_POST['create_category_btn'])) {
        $dhoma_lloji = $_POST['dhoma_lloji'];

        if(empty($name)) {
            $errors[] = 'Name is empty!';
        }

        if($crud->create('kategori', ['dhoma_lloji' => $dhoma_lloji]) === true) {
            header('Location: index.php?action=create&status=success');
        } else {
            $errors = 'Something want wrong!';
        }
    }
?>

<div class="dashboard my-5">
    <div class="container">
        <h3 class="mb-4">Lloji i dhomës</h3>
        <div class="card">
            <div class="card-body">
                <?php if($errors): ?>
                    <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="form-group mb-4">
                        <label for="name">Lloji i dhomës</label>
                        <input type="text" name="dhoma_lloji" id="dhoma_lloji" class="form-control" required="">
                    </div>
                    <button type="submit" class="btn btn-danger" name="create_category_btn">Vëndo</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>