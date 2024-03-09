<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bag_id = $_POST['bag_id'];
    $id_user = $_SESSION['user_id']; // Предполагается, что пользователь уже авторизован

    $delete_query = "DELETE FROM liked WHERE bag_id = $bag_id AND id_user = $id_user";
    if ($conn->query($delete_query) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }

    $conn->close();
}
?>
