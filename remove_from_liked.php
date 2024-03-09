<?php
session_start();
include_once('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bag_id = $_POST['bag_id'];
    $user_id = $_SESSION['user_id'];

    // Удаляем запись из таблицы liked
    $delete_query = "DELETE FROM liked WHERE bag_id = $bag_id AND id_user = $user_id";
    if ($conn->query($delete_query) === TRUE) {
        echo "success"; // Операция успешно выполнена
    } else {
        echo "Ошибка: " . $conn->error;
    }

    $conn->close();
}
?>
