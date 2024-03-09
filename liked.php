<?php
session_start();
include_once('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Избранные товары</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,700,700italic|Playfair+Display:400,700&subset=latin,cyrillic">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/header.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/kathalog.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/footer.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <?php include('header.php'); ?>

    <div class="cards">
        <?php
        $user_id = $_SESSION['user_id'];

        $sql = "SELECT bags.*, liked.liked_id FROM bags INNER JOIN liked ON bags.bag_id = liked.bag_id AND liked.id_user = $user_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product-card">';
                echo '<div class="product-card__image">';
                echo '<i class="fas fa-heart add-to-favorite liked" data-bag-id="' . $row['bag_id'] . '"></i>';
                echo '<img src="' . $row["img"] . '" alt="' . $row["model"] . '">';
                echo '</div>';
                echo '<div class="product-card__info">';
                echo '<h3 class="product-card__title">' . $row["model"] . '</h3>';
                echo '<p class="product-card__price">' . $row["price"] . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No favorite items found.</p>';
        }

        $conn->close();
        ?>
    </div>

    <?php include('footer.php'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./assets/js/remove_from_liked.js"></script>
</body>

</html>
