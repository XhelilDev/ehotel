<?php 
    include('../includes/header.php'); 
    include('../../classes/CRUD.php');

    $errors = [];
    $crud = new CRUD;

    $categories = $crud->read('kategori');
    $dhoma = $crud->read('dhoma', ['column' => 'id', 'value' => $_GET['id']] ,1);

    function imageIsValid($image) { 
      $ext = pathinfo($image, PATHINFO_EXTENSION); // përdorimi i funksionit 'pathinfo' për të marrë ekstensionin e skedarit
      $allowed_extensions = ['png', 'jpg', 'jpeg', 'webp'];
      return in_array($ext, $allowed_extensions);
  }

    if(isset($_POST['update_product_btn'])) {
        $id = $_POST['id'];
        $dhoma_id = $_POST['category'];
        $dhomanr = $_POST['dhomanr'];
        $dhomacmimi = $_POST['dhomacmimi'];
        $dhomastatusi = (isset($_POST['dhomastatusi']) && ($_POST['dhomastatusi'] == 1)) ? 1 : 0;
        $image = $_FILES['image'];

       


        $data = ['dhomanr' => $dhomanr, 'dhoma_id' => $dhoma_id,'dhomacmimi' => $dhomacmimi,'dhomastatusi'=>$dhomastatusi ];

        if(isset($image['name']) || imageIsValid($image['name'])) {
            $data['image'] = time().$image['name'];
        }
        
        if($crud->update('dhoma', $data, ['column' => 'id', 'value' => $id]) === true) {
            if(isset($image['name']) && imageIsValid($image['name'])) {
                if(move_uploaded_file($image['tmp_name'], 'images/'.time().$image['name'])) {
                    unlink('images/'.$dhoma[0]['image']);
                }
            }
            header('Location: index.php?action=update&status=success');
        } else {
            $errors = 'Something want wrong!';
        }
    }
?>

<div class="dashboard my-5">
    <div class="container">
        <h3 class="mb-4">Update product</h3>
        <div class="card">
            <div class="card-body">
                <?php if($errors): ?>
                    <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <?php if(isset($dhoma) && is_array($dhoma[0])): ?>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-4">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="form-control">
                            <option value="">Select category</option>
                            <?php foreach($categories as $category): ?>
                            <option value="<?= $category['id'] ?>" <?= ($category['id'] == $dhoma[0]['id']) ? 'selected' : '' ?>><?= $category['dhoma_lloji'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="name">Name</label>
                        <input type="text" name="dhomanr" id="dhomanr" value="<?= $dhoma[0]['dhomanr'] ?>" class="form-control" required="">
                    </div>
                   
                
                    <div class="form-group mb-4">
                        <label for="dhomacmimi">Price</label>
                        <input type="text" name="dhomacmimi" id="dhomacmimi" value="<?= $dhoma[0]['dhomacmimi'] ?>" class="form-control" required="">
                    </div>
                    
                    
                    <div class="form-group mb-4">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/png, image/jpg, image/jpeg, image/webp">
                        <br>
                        <p>Existing image:</p>
                        <img src="images/<?= $dhoma[0]['image'] ?>" height="80">
                    </div>
                    <input type="hidden" name="id" value="<?= $dhoma[0]['id'] ?>">
                    <button type="submit" class="btn btn-primary" name="update_product_btn">Update</button>
                </form>
                <?php else: ?>
                    <p>Product doesn't exist!</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php include('../includes/footer.php'); ?>