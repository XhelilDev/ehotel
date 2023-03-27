<?php 
    include('../includes/header.php'); 
    include('../../classes/CRUD.php');
    
    $crud = new CRUD;
    $kategori = $crud->read('kategori', ['column' => 'id', 'value' => $_GET['id']] ,1);

    $errors = [];

    if(isset($_POST['update_category_btn'])) {
        $id = $_POST['id'];
        $dhoma_lloji = $_POST['dhoma_lloji'];

        if(empty($dhoma_lloji)) {
            $errors[] = 'Vendo llojin e dhomes!';
        }

        if(empty($id)) {
            header('Location: index.php');
        }

        if($crud->update('kategori', ['dhoma_lloji' => $dhoma_lloji], ['column' => 'id', 'value' => $id]) === true) {
            header('Location: index.php?action=update&status=success');
        } else {
            $errors = 'Something want wrong!';
        }
    }
?>

<div class="dashboard my-5">
    <div class="container">
        <h3 class="mb-4">Update category</h3>
        <div class="card">
            <div class="card-body">
                <?php if($errors): ?>
                    <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <?php if(isset($kategori) && is_array($kategori[0])): ?>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="form-group mb-4">
                        <label for="name">Name</label>
                        <input type="text" name="dhoma_lloji" id="dhoma_lloji" value="<?= $kategori[0]['dhoma_lloji'] ?>" class="form-control" required="">
                    </div>
                    <input type="hidden" name="id" value="<?= $kategori[0]['id'] ?>">
                    <button type="submit" class="btn btn-danger" name="update_category_btn">Update</button>
                </form>
                <?php else: ?>
                    <p>Category doesn't exist!</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>