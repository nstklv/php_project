<?php
session_start();
if($_SESSION['user']){
    header('kab.php');
}
include_once('db.php');
include('header.php');
?>


<link rel="stylesheet" type="text/css" href="./assets/css/reg.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<section class="main-section">
    <section class="form-wrapper">
        <h2>Авторизация</h2>
        <div class="form-wrapper">
            <form action="" method="post" id="form_test" class="form">
                <label class="label_desc">Имя:</label>
                <input type="text" id="name_user" class="input" name="name_user" required />
                <label class="label_desc">Пароль:</label>
                <input type="password" id="password_user" class="input" name="password_user" />
                <input type="submit" value="Вход" class="btn_form" />
                <label id="auth">
                    <?php  isset($error) ? $error : ''; ?></label>
                <label class="reg_login">У вас ещё нет аккаунта? <a href="form_reg.php" class="btn_login">Зарегистрироваться</a></label>
            </form>
        </div>
    </section>
</section>

<?php 
if(isset($_SESSION['login_user'])){
    header("location: kab.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name_user = $_POST['name_user'];
    $password_user = $_POST['password_user'];

    $sql = "SELECT * FROM users WHERE login = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $name_user, $password_user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) == 1) {
        $_SESSION['login_user'] = $name_user;
        header("location: kab.php");
        exit();
    } else {
        $error = "Неверное имя пользователя или пароль";
    }
}
?>

<?php include('footer.php'); ?>