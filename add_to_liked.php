<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bag_id = $_POST['bag_id'];

    // Проверяем, авторизован ли пользователь
    if (isset($_SESSION['user_id'])) {
        $id_user = $_SESSION['user_id'];

        // Вставляем запись в таблицу "liked"
        $insert_query = "INSERT INTO liked (bag_id, id_user) VALUES ($bag_id, $id_user)";
        if ($conn->query($insert_query) === TRUE) {
            echo "success"; // Операция успешно выполнена
        } else {
            echo "Ошибка: " . $conn->error;
        }
    } else {
        echo "Пользователь не авторизован!";
    }

    // Закрываем соединение с базой данных
    $conn->close();
}
?>
