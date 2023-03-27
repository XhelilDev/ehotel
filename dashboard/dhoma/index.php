<?php
   include('../includes/header.php'); 
   include('../../classes/CRUD.php');
    
    $crud = new CRUD;
    $dhomat = $crud->read('dhoma');

    if(isset($_GET['action']) && ($_GET['action'] === 'delete')) {
        $dhoma = $crud->read('dhoma', ['column' => 'id', 'value' => $_GET['id']])[0];
        unlink('images/'.$dhoma['image']);
        if($crud->delete('dhoma', ['column' => 'id', 'value' => $_GET['id']])) {
            header('Location: index.php');
        }
    }
?>

<div class="dashboard my-5">
    <div class="container">
        

        <a href="dhoma.php" class="btn btn-outline-danger mb-4">Regjistro dhome</a>

        <?php if($dhomat && count($dhomat)): ?>
        <div class="card">
            <div class="card-body">
                <?php if(isset($_GET['action']) && isset($_GET['status'])): ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <?php if(($_GET['action'] === 'create') && ($_GET['status'] === 'success')): ?>
                            Dhoma u regjistrua me sukses.
                        <?php endif; ?>
                        <?php if(($_GET['action'] === 'update') && ($_GET['status'] === 'success')): ?>
                            Dhoma u ndryshua me sukses.
                        <?php endif; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <div class="table-responsive">
                    <table class="table table-borderd">
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Nr</th>
                                <th>Çmimi</th>
                                <th>Is active?</th>
                                <th></th>
                            </tr>
                            <?php foreach($dhomat as $dhoma): ?>
                            <tr>
                                <td><?= $dhoma['id'] ?></td>
                                <td >
                                    <img src="images/<?= $dhoma['image'] ?>" style="width:150px">
                                </td>
                                <td><?= $dhoma['dhomanr'] ?></td>
                                <td><?= $dhoma['dhomacmimi'] ?></td>
                                <td><?= ($dhoma['dhomastatusi'] === 1) ? 'Yes' : 'No' ?></td>
                                <td>
                                    <a href="edit.php?id=<?= $dhoma['id'] ?>">Edit</a>
                                    <a href="?action=delete&id=<?= $dhoma['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
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