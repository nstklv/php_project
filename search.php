<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Результат поиска</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,700,700italic|Playfair+Display:400,700&subset=latin,cyrillic">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/header.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/kathalog.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/search.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick-theme.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>

<body>
    <?php include('header.php'); ?>
    <?php include('db.php'); ?>
    <?php
    $sql = "SELECT * FROM bags";

    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
        if ($sort == 'asc') {
            $sql .= " ORDER BY price ASC";
        } elseif ($sort == 'desc') {
            $sql .= " ORDER BY price DESC";
        }
    }
    ?>
    <div class="catalog-page container">

        <aside class="filter-block">
            <h2>Фильтры</h2>
            <label><input type="checkbox" class="filter" value="Ткань"> Ткань</label>
            <label><input type="checkbox" class="filter" value="Кожа"> Кожа</label>
        </aside>

        <main class="product-list">
            <div class="sort-buttons">
                <h3 class="sort">Сортировать по цене:</h3>
                <a href="?sort=asc" class="sort-button">По возрастанию</a>
                <a href="?sort=desc" class="sort-button">По убыванию </a>
            </div>
            <div class="product-list" id="products-container">
                <div class="cards">
                    <?php
                    if (isset($_GET['search_query'])) {
                        $search_query = $_GET['search_query'];
                        $sql = "SELECT * FROM bags WHERE model LIKE '%$search_query%' OR description LIKE '%$search_query%'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<a href="bag.php?bag_id=' . $row["bag_id"] . '" class="product-link">';
                                echo '<div class="product-card">';
                                echo '<div class="product-card__image">';
                                echo '<img src="' . $row["img"] . '" alt="' . $row["model"] . '">';
                                echo '</div>';
                                echo '<div class="product-card__info">';
                                echo '<h3 class="product-card__title">' . $row["model"] . '</h3>';
                                echo '<p class="product-card__price">' . $row["price"] . '</p>';
                                echo '</div>';
                                echo '</div>';
                                echo '</a>';
                            }
                        } else {
                            echo "Товары не найдены";
                        }
                        $conn->close();
                    }
                    ?>

                </div>
            </div>
        </main>
    </div>
    <?php include('footer.php'); ?>










    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./assets/js/price.js"></script>

</body>