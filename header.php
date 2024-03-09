  <?php

  // Подключение к базе данных
  $db_host = 'localhost';
  $db_user = 'root';
  $db_pass = '';
  $db_name = 'handbags_store';

  $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

  if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM categories";
  $result = $conn->query($sql);

  ?>
  <link rel="stylesheet" type="text/css" href="./assets/css/header.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/footer.css">
  <div class="wrapper">
    <header class="header">
      <div class="header-container container">

        <div class="header-logo"><a class="header-logo__img" href="index.php" alt="">NK</a></div>

        <div class="header-nav">
          <nav class="header-nav__navigation">
            <ul class="header-nav__ul">
              <li class="header-nav__li">
                <a href="kathalog.php" class="header-nav__link">Каталог</a>
                <ul class="sub-menu">
                  <?php
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      if ($row["parent_id"] == 1) {
                        echo "<li><a href='kathalog.php?category_id=" . $row["category_id"] . "'>" . $row["name"] . "</a>";
                        $sub_sql = "SELECT * FROM categories WHERE parent_id = " . $row["category_id"];
                        $sub_result = $conn->query($sub_sql);
                        if ($sub_result->num_rows > 0) {
                          echo "<ul>";
                          while ($sub_row = $sub_result->fetch_assoc()) {
                            echo "<li><a href='kathalog.php?category_id=" . $sub_row["category_id"] . "'>" . $sub_row["name"] . "</a>";
                            $sub_sub_sql = "SELECT * FROM categories WHERE parent_id = " . $sub_row["category_id"];
                            $sub_sub_result = $conn->query($sub_sub_sql);
                            if ($sub_sub_result->num_rows > 0) {
                              echo "<ul>";
                              while ($sub_sub_row = $sub_sub_result->fetch_assoc()) {
                                echo "<li><a href='kathalog.php?category_id=" . $sub_sub_row["category_id"] . "'>" . $sub_sub_row["name"] . "</a></li>";
                              }
                              echo "</ul>";
                            }
                            echo "</li>";
                          }
                          echo "</ul>";
                        }
                        echo "</li>";
                      }
                    }
                  }
                  ?>

                </ul>

              </li>
              <li class="header-nav__li"><a href="" class="header-nav__link">О нас</a></li>
              <li class="header-nav__li"><a href="" class="header-nav__link">Контакты</a></li>
            </ul>
          </nav>
        </div>

        <div class="header-btns">
          <div class="header-btns__search">
            <form action="search.php" method="get" id="searchform">
              <input type="text" name="search_query" placeholder="Искать на сайте...">
              <button type="submit"><i class="fa fa-search"></i></button>
            </form>
          </div>
          <div class="header-btns__profile"><a href="form_reg.php" class="fas fa-user"></a></div>
          <div class="header-btns__korzina"><i class="fas fa-shopping-cart"></i></div>
        </div>
      </div>
    </header>
  </div>