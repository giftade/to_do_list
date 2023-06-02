<?php include '/my-php-code/to_do_list/config/database.php' ?>


<?php
    //fetch from database
    $statement = $pdo->prepare('SELECT * FROM tasks ORDER BY id DESC');
    $statement->execute();
    $todos = $statement->fetchAll(PDO::FETCH_ASSOC);
 
?>

<?php
$task = '';
$todoErr = '';
if (isset($_POST['submit'])) {
  if (empty($_POST['task'])) {
    $todoErr = 'Todo is required';
  } else {
    $task = filter_input(INPUT_POST, 'task', FILTER_SANITIZE_SPECIAL_CHARS);
  }

  //Adding to database
  if (empty($todoErr)) {
    $statement = $pdo->prepare("INSERT INTO tasks (Title)
               VALUES (:Title ) ");

    $statement->bindValue(':Title', $task);
    $statement->execute();

    header('Location: index.php');
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
  <div class="container d-flex flex-column align-items-center mt-5">
    <h1><?php echo "Whoop it's " . date('l') . '!'; ?></h1>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])  ?>" class="mt-4 d-flex flex-row w-75 justify-content-center" method="POST">
      <!-- Name input  -->
      <div class="mb-3 w-100">
        <input type="text" maxlength="50" class="form-control px-5  w-100 <?php echo $todoErr ? 'is-invalid' : null; ?>" id="task" name="task" placeholder="What do you want to do today ?...">
        <div class="invalid-feedback">
          <?php echo $todoErr ?>
        </div>
      </div>

      <div class="mb-3 form-group">
        <input type="submit" name="submit" value="Add" class="btn btn-dark w-100">
      </div>

    </form>
    <?php if (empty($todos)) : ?>
      <p class="lead mt-3">Add to your to do list</p>
    <?php endif; ?>

    <?php foreach ($todos as $item) : ?>
      <div class='card mb-3  w-75  bg-primary'>
        <div class='px-5 pt-3 text-left  bg-light'>
          <div class="d-flex flex-row justify-content-between">
            <p class='font-italic font-weight-bold'><?php echo ucwords($item['Title'])  ?></p>
            <p class='font-italic'><?php echo ucwords($item['date'])  ?></p>
          </div>
          <div class="mb-3">
            <a href="update.php?id=<?php echo $item['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>

            <form method="post" action="delete.php" class="d-inline-block">
              <input type="hidden" class="hidden" name='id' value="<?php echo $item['id'] ?>">
              <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

</body>


</html>