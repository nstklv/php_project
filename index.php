<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Адаптивная вёрстка сайта</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,700,700italic|Playfair+Display:400,700&subset=latin,cyrillic">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/header.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>


</head>

<body>
    <?php include('header.php'); ?>
    <?php include('db.php'); ?>
    <main>
        <section class="main-one">

            <div class="main-one__container">
                <div class="main-one-cart"><img src="./img/main-1.jpg" alt="" class="main-one-cart__img"></div>
            </div>


            <div class="main-one__container main-one-cart__text">
                <h1 class="main-one-cart__title">NK. Nastya Klueva</h1>
                <h2 class="main-one-cart__subtitle">Стиль, качество и удобство в каждой сумке</h2>
                <a class="main-btn-link">
                    <a href="kathalog.php" class="main-btn-link__container">
                        <span>Перейти в каталог</span><i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </a>

            </div>

            <div class="main-one__container">
                <div class="main-one-cart"><img src="./img/main-2.jpg" alt="" class="main-one-cart__img"></div>
            </div>

            <div class="main-one__container">
                <div class="main-one-cart"><img src="./img/main-3.jpg" alt="" class="main-one-cart__img"></div>
            </div>
        </section>
        <h2 class="title_hits">Хиты продаж</h2>
        <section class="slider-container container">
            <div class="cards">
                <?php
                $sql = "SELECT * FROM bags WHERE hit = 'ye'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="product-card">';
                        echo '<div class="product-card__image">';
                        echo '<img src="' . $row["img"] . '" alt="' . $row["model"] . '">';
                        echo '</div>';
                        echo '<div class="product-card__info">';
                        echo '<h3 class="product-card__title">' . $row["model"] . '</h3>';
                        echo '<p class="product-card__price">' . $row["price"] . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
            </div>
        </section>
    </main>
    <?php include('footer.php'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./assets/js/slider_hits.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>

</body>

</html>