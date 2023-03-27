<?php

include('includes/header.php');
$database = Database::getInstance()->getConnection();

//Kontrollo nëse përdoruesi është i loguar dhe ka rolin e duhur
if (!isset($_SESSION['roli']) || $_SESSION['roli'] !== 'customer') {
    header("Location: login.php");
    exit();
}

if (isset($_POST['submit_reservation'])) {
    // Kontrollo nese jane plotesuar te gjitha variablat POST
    if (!isset( $_POST['emri'], $_POST['email'], $_POST['telefoni'], $_POST['datafillimi'], $_POST['datambarimi'],$_POST['dhomacmimi'],$_POST['userid'],$_POST['totalipagesa'])) {
        // die('Të gjitha fushat duhet të plotesohen!');
    }

    // Merrni id-në e dhomës nga variabla POST
    $room_id = $_POST['id'];
    // $dhoma_id=$_GET['id'];
    $user_id=$_SESSION['user_id'];
   
   print_r($_SESSION['user_id']);
    
    $database = Database::getInstance()->getConnection();
   
     $sql = "SELECT dhomacmimi FROM dhoma WHERE id = $room_id";
     $result = $database->query($sql);
     if (!$result) {
         die("Gabim në kërkimin e dhomës.");
     }
     $row = mysqli_fetch_assoc($result);
     $dhoma_cmimi = $row['dhomacmimi'];

  
    // Merrni datën e fillimit dhe datën e mbarimit nga variablat POST

    $datafillimi = strtotime($_POST['datafillimi']);
    $datambarimi = strtotime($_POST['datambarimi']);
    $sql_check_availability = "SELECT *
    FROM dhoma
    LEFT JOIN rezervimi ON dhoma.id = rezervimi.dhoma_id
    WHERE rezervimi.datafillimi >= 'datambarimi' AND rezervimi.datambarimi <= 'datafillimi'";
    

    $result_check_availability = $database->query($sql_check_availability);
    if ($result_check_availability->num_rows > 0) {
        //Dhoma është e rezervuar në këto datat, mos lejo rezervimin
        header("Location: error.php?msg=Dhoma e kërkuar është e rezervuar në këto datat. Ju lutem zgjidhni një datë të ndryshme.");
        exit();
    }

    
   
  

    //Insertimi i te dhenave ne tabelen e rezervimeve
    $emri =  $_POST['emri'];
    $email = $_POST['email'];
    $telefoni =  $_POST['telefoni'];
    $datafillimi =  $_POST['datafillimi'];
    $datambarimi =  $_POST['datambarimi'];
    $user_id = $_POST['userid'];
    $totalipagesa = $_POST['totalipagesa'];
   

    $sql = "INSERT INTO rezervimi (emri, email, telefoni, datafillimi, datambarimi,userid,totalipagesa) 
    VALUES ('$emri', '$email', '$telefoni', '$datafillimi', '$datambarimi','$user_id','$totalipagesa')";
      $result = $database->query($sql);
    $rezervmimi_id = mysqli_insert_id($database);
    
    if (!$result) {
      die("Gabim në kërkimin e dhomës.");
    }
        
    // Vendosni vlerën e id-së së rezervimit në URL-në e faqes së re
    header("Location: rezervimet.php?id=$rezervmimi_id");
    exit();
    
   
  
  }
?>

<div class="dashboard my-5">
<div class="container">
<h3 class="mb-4">Regjistro dhome</h3>
 <div class="card">
 <div class="card-body">
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
    <div class="form-group mb-4">
        <input type="text" name="id" value="<?php echo $_GET['id']; ?>">
        <?php
            $user_id = $_SESSION['user_id'];
        ?>
        </div>
          <div class="form-group mb-4">
        <label for="userid">User ID:</label>
        <input type="text" id="userid" name="userid" class="form-control" required value="<?php echo $user_id; ?>">
    </div>
    <div class="form-group mb-4">
        <label for="datafillimi">Data e fillimit:</label>
        <input type="date" id="datafillimi" name="datafillimi" class="form-control" required>
    </div>
    <div class="form-group mb-4">
        <label for="datambarimi">Data e mbarimit:</label>
        <input type="date" id="datambarimi" name="datambarimi" class="form-control" required>
    </div>
    <?php
        $database = Database::getInstance()->getConnection();
        $room_id = $_GET['id'];
        $sql = "SELECT dhomacmimi FROM dhoma WHERE id = $room_id";
        $result = $database->query($sql);
        if (!$result) {
            die("Gabim në kërkimin e dhomës.");
        }
        $row = mysqli_fetch_assoc($result);
        $dhoma_cmimi = $row['dhomacmimi'];
    ?>
    <div class="form-group mb-4">
        <label for="dhomacmimi">Çmimi i dhomës:</label>
        <input type="text" id="dhomacmimi" name="dhomacmimi" class="form-control" value="<?php echo $dhoma_cmimi; ?>" readonly>
    </div>
    <div class="form-group mb-4">
        <label for="emri">Emri</label>
        <input type="text" id="emri" name="emri" class="form-control" required>
    </div>
    <div class="form-group mb-4">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" class="form-control" required>
    </div>
    <div class="form-group mb-4">
        <label for="telefoni">Tel</label>
        <input type="text" id="telefoni" name="telefoni" class="form-control" required>
    </div>
    <div class="form-group mb-4">
        <label for="totalipagesa">Çmimi total:</label>
        <input type="text" id="totalipagesa" name="totalipagesa" class="form-control" value="<?php echo $totalipagesa ; ?>" readonly>
    </div>
    <button type="submit" name="submit_reservation" class="btn btn-primary">Rezervo</button>
</form>
    </div>
    </div>
    </div>
    </div>
    </div>

<script>

function calculatePrice() {
  var startDate = new Date(document.getElementById("datafillimi").value);
  var endDate = new Date(document.getElementById("datambarimi").value);
  var roomPrice = parseFloat("<?php echo $dhoma_cmimi; ?>");
  var totalipagesa = roomPrice * ((endDate - startDate) / (1000 * 60 * 60 * 24));
  
  var displayPrice = document.getElementById("totalipagesa");
  if (displayPrice) { // Kontrolli i disponueshmerise se elementit
    displayPrice.value = totalPrice.toFixed(2);
  }
}

//Merr datat nga inputet
const checkinDate = document.getElementById('datafillimi');
const checkoutDate = document.getElementById('datambarimi');
const totalPrice = document.getElementById('totalipagesa');

// Shto dëgjuesit e ngjarjeve për ndryshimin e vlerave të inputeve
checkinDate.addEventListener('change', calculatePrice);
checkoutDate.addEventListener('change', calculatePrice);

// Funksioni për llogaritjen e totalit të pagesës
function calculatePrice() {
  // Merr datat e zgjedhura nga inputet dhe konverto në objekte të datave
  const checkin = new Date(checkinDate.value);
  const checkout = new Date(checkoutDate.value);

  // Llogarit numrin e ditëve të qëndrimit
  const nights = Math.floor((checkout - checkin) / (1000 * 60 * 60 * 24));

  // Merr vlerën e cmimit të dhomës nga PHP
  const roomPrice = <?php echo $dhoma_cmimi; ?>;

  // Llogarit totalin e pagesës
  const totalPriceValue = nights * roomPrice;

  // Vendos vlerën e totalit të pagesës në inputin e duhur
  totalPrice.value = totalPriceValue;
}
 </script>