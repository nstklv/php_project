<?php
include('db.php');


// для получения категорий
$sql = "SELECT * FROM categories WHERE parent_id = 1";
$result = $conn->query($sql);
?>

<footer class="footer">
    <div class="footer__logo">
        <img src="logo.png" alt="Логотип">
    </div>
    <div class="footer__menu">
        <h3>Каталог</h3>
         
    </div>
    <div class="footer__about-us">
        <h3>О нас</h3>
        <p>Стиль и уверенность в образе через каждое изделие.</p>
    </div>
    <div class="footer__contacts">
        <h3>Контакты</h3>
        <ul>
            <li>Email: nastyaklueva@gmai.com</li>
            <li>Телефон: +1234567890</li>
        </ul>
    </div>
</footer>