<?php
session_start();
include_once('db.php');

$filters = isset($_POST['filters']) ? $_POST['filters'] : [];
$categoryFilters = isset($_POST['categoryFilters']) ? $_POST['categoryFilters'] : [];
$search = isset($_POST['search_query']) ? $_POST['search_query'] : [];
$minPrice = isset($_POST['min_price']) ? $_POST['min_price'] : null;
$maxPrice = isset($_POST['max_price']) ? $_POST['max_price'] : null;

$where = "";
if (!empty($filters) || !empty($categoryFilters) || !empty($minPrice) || !empty($maxPrice)) {
    $where = " WHERE ";

    $conditions = [];

    if (!empty($filters)) {
        $conditions[] = "material IN ('" . implode("','", $filters) . "')";
    }

    if (!empty($categoryFilters)) {
        $categoryConditions = [];
        foreach ($categoryFilters as $categoryFilter) {
            $categoryConditions[] = "category_id = " . intval($categoryFilter);
        }
        $conditions[] = "(" . implode(" OR ", $categoryConditions) . ")";
    }

    if (!empty($minPrice) && !empty($maxPrice)) {
        $conditions[] = "price BETWEEN " . intval($minPrice) . " AND " . intval($maxPrice);
    } elseif (!empty($minPrice)) {
        $conditions[] = "price >= " . intval($minPrice);
    } elseif (!empty($maxPrice)) {
        $conditions[] = "price <= " . intval($maxPrice);
    }

    $where .= implode(" AND ", $conditions);

    if (!empty($search)) {
        $where .= " AND model LIKE '%{$search}%'";
    }
} elseif (!empty($search)) {
    $where = " WHERE model LIKE '%{$search}%'";
}

$sql = "SELECT * FROM bags" . $where;

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo '<div class="cards" data-search="' . $_POST['search_query'] . '">';
    while ($row = $result->fetch_assoc()) {
        echo '<a href="bag.php?bag_id=' . $row["bag_id"] . '" class="product-link">';
        echo '<div class="product-card">';
        echo '<div class="product-card__image">';
        echo '<img src="' . $row["img"] . '" alt="' . $row["model"] . '">';
        echo '</div>';
        echo '<div class="product-card__info">';
        echo '<h3 class="product-card__title">' . $row["model"] . '</h3>';
        echo '<p class="product-card__price">' . $row["price"] . '<button class="add-to-cart"><i class="fas fa-shopping-cart"></i></button>' . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</a>';
    }
    echo '</div>';
} else {
    echo 'Нет товаров, удовлетворяющих выбранным критериям.';
}
?>
