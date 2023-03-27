<?php 
    include('includes/header.php');
   

    if(isset($_GET['id'])) {
        $dhoma = $crud->read('dhoma', ['column' => 'id', 'value' => $_GET['id']]);
        if(count($dhoma)) $dhoma = $dhoma[0];
    } 

    if(isset($_GET['add_to_cart_btn'])) {
        $qty = $_GET['qty'];
        $id = $_GET['id'];

        if($qty > 0 && $qty <= $product['qty']) {
            if(array_key_exists($id, $_SESSION['cart'])) {
                $cart_product = $_SESSION['cart'][$id];
                $cart_product['qty'] = $cart_product['qty'] + $qty;
                $_SESSION['cart'][$id] = $cart_product;
            } else {
                $cart_product = $product;
                $cart_product['qty'] = $qty;
                $_SESSION['cart'][$id] = $cart_product;
            }
            
            header('Location: cart.php');
        } else {
            header('Location: rezervo.php?id='.$id);
        }
    }

?>


<!-- Product -->
<div class="product py-5">
    <div class="container">
        <div class="row mt-5">
        <?php if($dhoma): ?>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <img src="dashboard/dhoma/images/<?= $dhoma['image'] ?>" class="img-fluid" alt="<?= $dhoma['dhomanr'] ?>" style="width:300px">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Numri i dhomes <?= $dhoma['dhomanr'] ?></h2>
                <p><?= $dhoma['dhomacmimi'] ?> &euro;</p>
           
               
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="GET" class="d-flex align-items-center">
                    
                    <input type="hidden" name="id" value="<?= $dhoma['id'] ?>">
                  
                    
                    

                    <button type="submit" name="add_to_cart_btn" class="btn bnt-sm btn-outline-danger">Rezervo</button>
                </form>
            </div> <!-- ./col -->
        <?php endif; ?>
        </div> <!-- ./row -->
      
    </div>
</div>

<?php include('includes/footer.php'); ?>