<?php 



try {
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=todo_list', 'segun', '123456');
 // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
