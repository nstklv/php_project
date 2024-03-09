<?php
session_start();
include 'db.php';

$errorContainer = array();

// полученные
$login = $_POST['name_user'];
$email_user = $_POST['email_user'];
$password_user = $_POST['password_user'];
$password_2_user = $_POST['password_2_user'];

//генерация
$salt = mt_rand(100, 999);

$password = md5(md5($password_user) . $salt);

$query = "INSERT INTO users (login, email, password, salt)
          VALUES ('$login','$email_user','$password', '$salt')";

$result = mysqli_query($conn, $query) or die("Ошибка " . mysqli_error($conn));

if ($result) {
    // выборка данных нового пользователя
    $query = "SELECT * FROM users WHERE login='$login'";
    $rez = mysqli_query($conn, $query);

    if ($rez) {
        $row = mysqli_fetch_assoc($rez);

        if (isset($row['user_id'])) {
            $_SESSION['user_id'] = $row['user_id'];
        }

      

        mysqli_close($conn);

        
        echo "<script language='Javascript' type='text/javascript'>
              alert('Вы успешно зарегистрировались! Спасибо!');
              function reload(){top.location = 'kab.php'};
              reload();
              </script>";
    }
}

session_commit();
?>