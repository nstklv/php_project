<?php
session_start();

include_once('db.php');
include('header.php');
?>
<link rel="stylesheet" type="text/css" href=".assets/css/header.css">

<link rel="stylesheet" type="text/css" href="./css/footer.css">
<link rel="stylesheet" type="text/css" href="./css/kab.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<title>Профиль пользователя</title>

<main>
  <?php
  $user_id = $_SESSION['user_id'];

  // Запрос на извлечение данных о пользователе
  $user_query = "SELECT * FROM users WHERE user_id = $user_id";

  $user_result = $conn->query($user_query);
  if ($user_result->num_rows > 0) {
    // Извлечение данных о пользователе
    $user_data = $user_result->fetch_assoc();
    $user_name = $user_data["name"];
    $user_email = $user_data["email"];

    // Вывод данных о пользователе
    echo "Name: " . $user_name . "<br>";
    echo "Email: " . $user_email . "<br>";
  } else {
    echo "User not found.";
  }

  // Закрытие соединения с базой данных
  $conn->close();
  ?>
</main>
<?php include('footer.php'); ?>