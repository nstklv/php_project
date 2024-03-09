<!--сюда отправляется с логина-->
<?php
session_start(); // Начинаем сеанс
include_once('db.php');

$login = $_POST['login'];//ключи у пост
$password = md5($_POST['password']);

$check_user = mysqli_query($connect, "SELECT * FROM 'users' WHERE 'login' = '$login' AND 'password' = '$password'");
if(mysqli_num_rows($check_user) > 0) {
$user = mysqli_fetch_assoc($check_user);

$_SESSION['user'] = [
    "id" => $user['id'],
    "full_name"
]
}





// Уничтожаем сеанс
session_unset();
session_destroy();

// Перенаправляем пользователя на страницу авторизации
header("location: login.php");
exit;
?>