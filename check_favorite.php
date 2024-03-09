<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bag_id = $_POST['bag_id'];
    $id_user = $_SESSION['user_id']; // Предполагается, что пользователь уже авторизован

    $check_query = "SELECT * FROM liked WHERE bag_id = $bag_id AND id_user = $id_user";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        // Товар уже добавлен в избранное
        echo 'exists';
    } else {
        // Товар еще не добавлен в избранное
        echo 'not_exists';
    }

    $conn->close();
}
?>
