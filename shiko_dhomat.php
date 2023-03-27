<?php 
    include('includes/header.php');
  

    $dhomat = $crud->read('dhoma');

    if(isset($_GET['filter'])) {
        $filter = $_GET['filter'];
        $filter_fields = explode("_", $filter);
        $dhomat = $crud->read('dhoma', [], null, ['column' => $filter_fields[0]]);
    }

    if(isset($_GET['search'])) {
        if(strlen($_GET['search']) >= 3) {
            $dhomat = $crud->search('dhoma', 'name', $_GET['search']);
        }
    }
   
?>


<!-- Products -->
<div class="products py-5">
    <div class="container">
        <div class="d-flex justify-content-between">
            <div>
                <h2>Explore products</h2>
                <p><?= count($dhomat) ?> Dhomat e disponueshme</p>
            </div>
      
        </div>
        <div class="row mt-5">
        <?php if($dhomat && count($dhomat)): ?>
            <?php foreach($dhomat as $dhoma): ?>
                <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card" style="width: 18rem;">
                    <img src="dashboard/dhoma/images/<?= $dhoma['image'] ?>" class="product-image" alt="<?= $dhoma['dhomanr'] ?>" style="height:200px">
                    <div class="card-body">
                        <h5 class="card-title"><?= $dhoma['dhomanr'] ?></h5>
                        <p class="card-text card-text-product">
                            <?= $dhoma['dhomacmimi'] ?> &euro;
                            <br />
                            
                        </p>
                        <a href="shiko_dhome.php?id=<?= $dhoma['id'] ?>" class="btn btn-outline-danger">
                            Shiko dhomën
                        </a>
                        
                    </div>
                </div> <!-- ./card -->
            </div> <!-- ./col -->
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-info" role="alert">
                Shop is empty! 0 products
            </div>
        <?php endif; ?>
        </div> <!-- ./row -->
    </div>
</div>


<script>
    document.getElementById('filter').addEventListener('change', () => {
        document.getElementById('filter-form').submit()
    })
</script>
<?php include('includes/footer.php'); ?>

