<?php 
    include('../includes/header.php'); 
    include('../../classes/CRUD.php');
    
    $crud = new CRUD;
    $kategori = $crud->read('kategori');

    if(isset($_GET['action']) && ($_GET['action'] === 'delete')) {
        if($crud->delete('kategori', ['column' => 'id', 'value' => $_GET['id']])) {
            header('Location: index.php');
        }
    }
?>

<div class="dashboard my-5">
    <div class="container">

        <h3 class="mb-4">Kategoritë</h3>
        <a href="create.php" class="btn btn-outline-danger mb-4">Create category</a>

        <?php if($kategori && count($kategori)): ?>
        <div class="card">
            <div class="card-body">
                <?php if(isset($_GET['action']) && isset($_GET['status'])): ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <?php if(($_GET['action'] === 'create') && ($_GET['status'] === 'success')): ?>
                            Category was created successfully.
                        <?php endif; ?>
                        <?php if(($_GET['action'] === 'update') && ($_GET['status'] === 'success')): ?>
                            Category was updated successfully.
                        <?php endif; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <div class="table-responsive">
                    <table class="table table-borderd">
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th></th>
                            </tr>
                            <?php foreach($kategori as $kategoria): ?>
                            <tr>
                                <td><?= $kategoria['id'] ?></td>
                                <td><?= $kategoria['dhoma_lloji'] ?></td>
                                <td>
                                    <a href="edit.php?id=<?= $kategoria['id'] ?>">Edit</a>
                                    <a href="?action=delete&id=<?=$kategoria['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php include('../includes/footer.php'); ?>