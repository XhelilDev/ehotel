<?php 
    include('../includes/header.php'); 
    include('../../classes/CRUD.php');

    $errors = [];
    $crud = new CRUD;
    $kategori = $crud->read('kategori');

    function imageIsValid($image) { 
        $ext = end(explode('.', $image)); 
        $allowed_extensions = ['png', 'jpg', 'jpeg', 'webp'];
        return in_array($ext, $allowed_extensions);
    }

    if(isset($_POST['ngarko'])) {
        $dhomanr = $_POST['dhomanr'];
        $dhoma_id = $_POST['kategori'];
        $dhomacmimi = $_POST['dhomacmimi'];
        $dhomastatusi = (isset($_POST['dhomastatusi']) && ($_POST['dhomastatusi'] === 1)) ? 1 : 0;
        $image = $_FILES['image'];

        if(empty($dhomanr)) {
            $errors[] = '!';
        }
        
        if(empty($dhomacmimi)) {
            $errors[] = 'Vendo cmimin!';
        }


        $data = ['dhomanr' => $dhomanr,'dhoma_id' => $dhoma_id, 'dhomacmimi' => $dhomacmimi, 'dhomastatusi' => $dhomastatusi];

        if(empty($image['name']) || !imageIsValid($image['name'])) {
            $errors[] = 'Image is empty or type is not supported!';
        } else {
            $data['image'] = time().$image['name'];
        }
        

        if($crud->create('dhoma', $data) === true) {
            if(isset($image['name']) && imageIsValid($image['name'])) {
                move_uploaded_file($image['tmp_name'], 'images/'.time().$image['name']);
            }
            header('Location: index.php?action=create&status=success');
        } else {
            $errors = 'Something want wrong!';
        }
    }
?>

<div class="dashboard my-5">
    <div class="container">
        <h3 class="mb-4">Regjistro dhome</h3>
        <div class="card">
            <div class="card-body">
                <?php if($errors): ?>
                    <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-4">
                        <label for="dhomanr">Numri i dhomes</label>
                        <input type="text" name="dhomanr" id="dhomanr" class="form-control" required="">
                    </div>
                    <div class="form-group mb-4">
                        <label for="category">Category</label>
                        <select name="kategori" id="kategori" class="form-control">
                            <option value="">Select category</option>
                            <?php foreach($kategori as $kategoria): ?>
                            <option value="<?= $kategoria['id'] ?>"><?= $kategoria['dhoma_lloji'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="dhomacmimi">Cmimi</label>
                        <input type="text" name="dhomacmimi" id="dhomacmimi" class="form-control" required="">
                    </div>
                    <div class="form-group mb-4">
                        <label for="dhomastatusi">E rezervuar/E lire</label>
                        <input type="checkbox" name="dhomastatusi" value="1" />
                    </div>
                    <div class="form-group mb-4">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control" required="" accept="image/png, image/jpg, image/jpeg, image/webp">
                    </div>
                    <button type="submit" class="btn btn-danger" name="ngarko">Ngarko</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>

  




