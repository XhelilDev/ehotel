<?php

include('includes/header.php');
$database = Database::getInstance()->getConnection();



$user_id = $_SESSION['user_id'];


$database = Database::getInstance()->getConnection();

$sql = "SELECT * FROM rezervimi WHERE userid = $user_id";
  $result = $database->query($sql);
  if (!$result) {
      die("Gabim në kërkimin e dhomës.");
  }

// Kontrollojmë nëse është bërë kërkesa POST nga forma e fshirjes
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_reservation'])) {

    // Merr ID-në e rezervimit nga forma e fshirjes
    $reservation_id = $_POST['rezervimi_id'];

    // Krijoni një lidhje me databazën


    // Krijoni kërkesën për të fshirë rezervimin me ID e caktuar nga tabela 'rezervimi'
    $sql = "DELETE FROM rezervimi WHERE rezervimi_id = $reservation_id";

    // Ekzekuto kërkesën dhe kontrollo nëse ka ndonjë gabim
    if ($database->query($sql) === TRUE) {
        // Tregojmë mesazhin e suksesit nëse fshirja është kryer me sukses
        echo "Rezervimi anuluar me sukses.";
    } else {
        // Tregojmë mesazhin e gabimit nëse ka ndodhur ndonjë gabim gjatë fshirjes
        echo "Gabim në fshirjen e rezervimit: " . $database->error;
    }
}

 
?>

<?php if (mysqli_num_rows($result) > 0) : ?>
    <div class="container py-4">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Emri i klientit</th>
          <th>Email</th>
          <th>Data e fillimit</th>
          <th>Data e mbarimit</th>
          <th>Totali i pageses</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
          <tr>
            <td><?php echo $row['rezervimi_id']; ?></td>
            <td><?php echo $row['emri']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['datafillimi']; ?></td>
            <td><?php echo $row['datambarimi']; ?></td>
            <td><?php echo $row['totalipagesa']; ?></td>
            <td>
           
            <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                <input type="hidden" name="rezervimi_id" value="<?php echo $row['rezervimi_id']; ?>">
                <button type="submit" class="btn btn-danger" name="delete_reservation">Anulo</button>
              </form>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else : ?>
    <p class="alert alert-info">Nuk ka rezervime të kryera nga ky përdorues.</p>
  <?php endif; ?>
  </div>


