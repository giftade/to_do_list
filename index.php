<?php include '/my-php-code/to_do_list/config/database.php' ?>

<?php
$sql = 'SELECT * FROM tasks';
$result = mysqli_query($conn, $sql);
$todos = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<?php
$task = '';
if (isset($_POST['submit'])) {
  $task = filter_input(INPUT_POST, 'task', FILTER_SANITIZE_SPECIAL_CHARS);
}
echo $task;
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

  <title>Document</title>
</head>

<body>
  <div class="container d-flex flex-column align-items-center mt-5">
    <h1><?php echo "Whoop it's " . date('l') . '!'; ?></h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])  ?>" class="mt-4 d-flex flex-row w-75 justify-content-center" method="POST">
      <!-- Name input  -->
      <div class="mb-3 w-100">
        <input type="text" class="form-control px-5  w-100" id="task" name="task" placeholder="What do you want to do today ?...">
      </div>

      <div class="mb-3 form-group">
        <input type="submit" name="submit" value="Add" class="btn btn-dark w-100">
      </div>

    </form>
    <?php if (empty($todos)) : ?>
      <p class="lead mt-3">Add to your to do list</p>
    <?php endif; ?>

    <?php foreach($todos as $item): ?>
        <div class='card mb-3  w-75  bg-primary'>
          <div class='px-5 pt-3 text-left  bg-light'>
            <p class='font-italic font-weight-bolder'><?php echo $item['Title'] ?></p>
          </div>
        </div>
    <?php endforeach; ?>


  </div>
</body>


</html>