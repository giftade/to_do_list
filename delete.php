<?php 
include "/my-php-code/to_do_list/config/database.php";


$id = $_POST['id'] ?? null;
echo $id;

 if(!$id){
   header('Location: index.php');
   exit;
 }

$statement = $pdo->prepare('DELETE FROM tasks WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();

header('Location: index.php');

?>