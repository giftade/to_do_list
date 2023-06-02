<?php include '/my-php-code/to_do_list/config/database.php' ?>


<?php
$id = $_GET['id'] ?? null;
if (!$id) {
  header('Location: index.php');
  exit;
}




//fetch from database
$statement = $pdo->prepare('SELECT * FROM tasks WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$todos = $statement->fetch(PDO::FETCH_ASSOC);

// echo '<pre>';
//   var_dump($todos);
//   '</pre>';
// exit;



$task = $todos['Title'];
$itemId = $todos['id'];
$todoErr = '';
if (isset($_POST['submit'])) {
  $task = filter_input(INPUT_POST, 'task', FILTER_SANITIZE_SPECIAL_CHARS);
  $id =filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
  if (!$task) {
    $todoErr = 'Todo is required!!';
  }
  //Adding to database
  if (empty($todoErr)) {
    
    $sql = "UPDATE tasks SET Title = :title WHERE id = :id";
    var_dump($sql);

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':title', $task);
    $stmt->bindParam(':id', $itemId, PDO::PARAM_INT);
    $stmt->execute();

    // Redirect the user back to the todo list page or show a success message
    header("Location: index.php");
    exit();
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="./bootstrap-offline/css/bootstrap.css">
  <script src="./bootstrap-offline/js/jquery-3.6.0.js"></script>
  <script src="./bootstrap-offline/js/bootstrap.js"></script>

  <title>To do list</title>
</head>

<body>
  <p>
    <a href="index.php" class="btn btn-secondary">Go back to List</a>
  </p>

  <div class="container d-flex flex-column align-items-center mt-5">
    <h1><?php echo "Whoop it's " . date('l')  . '!'; ?></h1>

    <form class="mt-4 d-flex flex-row w-75 justify-content-center" method="POST">
      <!-- Name input  -->
      <div class="mb-3 w-100">
        <input value="<?php echo $task ?>" type="text" maxlength="50" class="form-control px-5  w-100 <?php echo $todoErr ? 'is-invalid' : null; ?>" id="task" name="task" placeholder="What do you want to do today ?...">
        <div class="invalid-feedback">
          <?php echo $todoErr ?>
        </div>
      </div>
      <input type="hidden" value="<?php echo $id ?>" name="id" class="form-control">

      <div class="mb-3 form-group">
        <input type="submit" name="submit" value="Update" class="btn btn-dark w-100">
      </div>

    </form>

  </div>

</body>


</html>