<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Адаптивная вёрстка сайта</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,700,700italic|Playfair+Display:400,700&subset=latin,cyrillic">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css">

    <link rel="stylesheet" type="text/css" href="./assets/css/header.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/bag.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick-theme.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>

<body>
    <?php
    include('header.php');
    include('db.php');
    if (isset($_GET['bag_id'])) {
        $bag_id = $_GET['bag_id'];


        $sql = "SELECT * FROM bags WHERE bag_id = $bag_id";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $conn->close();
    ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="<?php echo $row['img']; ?>" alt="<?php echo $row['name']; ?>">
                    <i class="fas fa-heart add-to-favorite"></i>
                </div>
                <div class="product-details">
                    <h3 class="bag-title"><?php echo $row['model']; ?></h3>
                    <p class="description"><?php echo $row['description']; ?></p>
                    <p>Цена: <?php echo $row['price']; ?> руб.</p>
                    <p>Материал: <?php echo $row['material']; ?></p>
                    <p>Цвет: <?php echo $row['color']; ?></p>

                    <label for="quantity">Количество:</label>
                    <input type="number" id="quantity" name="quantity" min="1" max="<?php echo $row['quantity']; ?>" value="1">
                    <button class="add-to-cart-btn btn_blackToOrange">Добавить в корзину</button>
                </div>
            </div>
    <?php
        } else {
            echo "Товар не найден";
        }
    } else {
        echo "Не указан ID товара";
    }
    ?>
    <?php include('footer.php'); ?>
</body>

</html>
<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bag_id = $_POST['bag_id'];

    // Проверяем, авторизован ли пользователь
    if (isset($_SESSION['user_id'])) {
        $id_user = $_SESSION['user_id'];

        // Проверяем, не добавлен ли уже этот товар в избранное этим пользователем
        $check_query = "SELECT * FROM liked WHERE bag_id = $bag_id AND id_user = $id_user";
        $check_result = $conn->query($check_query);
        if ($check_result->num_rows == 0) {
            // Если товар еще не добавлен в избранное этим пользователем, то добавляем
            $insert_query = "INSERT INTO liked (bag_id, id_user) VALUES ($bag_id, $id_user)";
            if ($conn->query($insert_query) === TRUE) {
                echo "Товар добавлен в избранное!";
            } else {
                echo "Ошибка: " . $conn->error;
            }
        } else {
            echo "Этот товар уже добавлен в избранное этим пользователем!";
        }
    } else {
        echo "Пользователь не авторизован!";
    }

    // Закрываем соединение с базой данных
    $conn->close();
}
?>
<script src="./assets/js/liked.js"></script>