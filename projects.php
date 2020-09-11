<?php
include("include/db_connect.php");
include("include/db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Афиша Кинотеатра</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="main_header">
        <div class="header" style="background: white;">
            <div class="logotype">
                <a href="index.php"><img src="images/logo1.png" alt=""></a>
            </div>
            <div class="workingtime">
                <b>Время работы</b><br>
                <p>Пн - пт: 8:00 - 20:00</p>
                <p>Сб - вс: 10:00 - 16:00</p>
            </div>
            <div class="adress">
                <p><img src="images/marker.jpg" alt="">г. Минск, ул. Максима Танка 24</p>
            </div>
            <div class="contacts">
                <p><img src="images/phone.jpg" alt=""> +375 (17) 350-77-44 </p>
                <p><img src="images/a1.jpg" alt=""> +375 (29) 17-929-17 </p>
                <p><img src="images/life.jpg" alt=""> +375 (25) 76-929-17 </p>
            </div>
            <?php if (isset($_SESSION['logged_user'])) : ?>
                <div class="auth">
                    <a href=""><img src="images/-account-box_90550.png" alt=""> Привет, <?php echo $_SESSION['logged_user']->first_name ?>!</a>
                    <a href="logout.php"><img src="images/exit.png" alt=""> Выйти</a>
                </div>
            <?php else : ?>
                <div class="auth">
                    <a href="login.php"><img src="images/-account-box_90550.png" alt=""> Войти в кабинет</a>
                    <a href="signup.php"><img src="images/signup.png" alt=""> Зарегистрироваться</a>
                </div>
            <?php endif; ?>
        </div>
        <div class="menu">
            <a href="index.php">
                <div class="menu_element">
                    <br>
                    Главная
                </div>
            </a>
            <a href="projects.php">
                <div class="menu_element">
                    <br>
                    Афиша
                </div>
            </a>
            <a href="contacts.php">
                <div class="menu_element">
                    <br>
                    Контакты
                </div>
            </a>
            <a href="appeal.php">
                <div class="menu_element">
                    <br>
                    Отзывы
                </div>
            </a>
            <?php if (isset($_SESSION['logged_user']) && $_SESSION['logged_user']->role == "администратор") : ?>
                <a href="adminpanel.php">
                    <div class="menu_element">
                        <br>
                        Админ.панель
                    </div>
                </a>
            <?php else : ?>

            <?php endif; ?>
        </div>
    </div>
    <div class="inner_info">
        <img src="images/projects.jpg" alt="">
    </div>
    <div class="intro_doctors">
        <h1 style="text-align: center;">Фильмы в прокате сейчас</h1>
    </div>
    <div class="pages">
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else $page = 1;

        $kol = 4;  //количество записей для вывода
        $art = ($page * $kol) - $kol;

        $res = mysqli_query($link, "SELECT count(*) from films");
        $row = mysqli_fetch_row($res);
        $total = $row[0]; // всего записей	

        global $str_pag;
        $str_pag = ceil($total / $kol);
        echo 'Страницы ';
        for ($i = 1; $i <= $str_pag; $i++) {
            echo "<a href=projects.php?page=" . $i . ">" . $i . "</a>";
        }
        ?>
    </div>
    <div class="projects">
        <?php if (isset($_SESSION['logged_user'])) : ?>
            <?php

            $result = mysqli_query($link, "SELECT round(avg(rating_assessment),1) as 'rate', films.film_id, film_preview, film_name, film_genre, film_country, film_year, film_description, film_duration
    FROM films left join rating on rating.film_id = films.film_id group by film_name LIMIT $art, $kol");

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                do {
                    if ($row['rate'] == null) {
                        $rating = "нет рейтинга";
                    } else {
                        $rating = $row['rate'];
                    }
                    echo '                                               
                <div class="project">
                    <div class="inform">
                        <img src="' . $row["film_preview"] . '" alt="" width="150" heigth="300">
                        <h2><b>"' . $row["film_name"] . '"</b></h2>
                        <p><b>Жанр: ' . $row["film_genre"] . '</b></p>
                        <p>Продолжительность:  ' . $row["film_duration"] . '</p>
                        <p>Страна:  ' . $row["film_country"] . '</p>
                        <p>Год:  ' . $row["film_year"] . '</p>
                    </div>
                    <div class="other_inform">
                    <div class="infor">
                    <p><b>Рейтинг фильма: ' . $rating . ' 
                    </b></p>
                    </div>
                        <p><b style="font-size:22px;">Описание</b><br> ' . $row["film_description"] . '</p>
                        <form id="ratingform" action="addrate.php" method="POST">
                            <p><input id="rating" name="rate" type="number" max="10" min="1">  Оставьте оценку фильму<br><br></p>
                            <p><input id="rating" name="film_id" type="text" style="display:none;" value="' . $row['film_id'] . '"></p>
                            <textarea placeholder="Комментарий..." name="comment" id="comment" cols="38" rows="5"></textarea>
                            <br>
                            <input name="rated" type="submit">
                        </form>
                    </div>
            </div>';
                } while ($row = mysqli_fetch_array($result));
            }
            ?>
        <?php else : ?>
            <?php

            $result = mysqli_query($link, "SELECT round(avg(rating_assessment),1) as 'rate', films.film_id, film_preview, film_name, film_genre, film_country, film_year, film_description, film_duration
            FROM films left join rating on rating.film_id = films.film_id group by film_name LIMIT $art, $kol");

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                do {
                    if ($row['rate'] == null) {
                        $rating = "нет рейтинга";
                    } else {
                        $rating = $row['rate'];
                    }
                    echo '                                               
                        <div class="project">
                            <div class="inform">
                                <img src="' . $row["film_preview"] . '" alt="" width="150" heigth="300">
                                <h2><b>"' . $row["film_name"] . '"</b></h2>
                                <p><b>Жанр: ' . $row["film_genre"] . '</b></p>
                                <p>Продолжительность:  ' . $row["film_duration"] . '</p>
                                <p>Страна:  ' . $row["film_country"] . '</p>
                                <p>Год:  ' . $row["film_year"] . '</p>
                            </div>
                            <div class="other_inform">
                            <div class="infor">
                            <p><b>Рейтинг фильма: ' . $rating . ' 
                            </b></p>
                            </div>
                                <p><b style="font-size:22px;">Описание</b><br> ' . $row["film_description"] . '</p>
                            </div>
                    </div>';
                } while ($row = mysqli_fetch_array($result));
            }
            ?>
        <?php endif; ?>

    </div>
    <div class="footer">
        <div class="footinfo">
            <p style="font-size: 14px"><b>ООО «Сфера»</b></p>
            <p style="font-size: 12px">220068, Республика Беларусь,</p>
            <p style="font-size: 12px">г. Минск, ул. Максима Танка 24</p>
            <p style="font-size: 12px">E-mail: spherecinema@gmail.com</p>
        </div>
        <div class="footinfo">
            <p style="font-size: 14px"><b>Время работы:</b></p>
            <p style="font-size: 12px">Понедельник - пятница:</p>
            <p style="font-size: 12px">08:00 - 20:00</p>
            <p style="font-size: 12px">Суббота - Воскресенье:</p>
            <p style="font-size: 12px">08:00 - 16:00:</p>
        </div>
        <div class="footinfo">
            <br>
            <p style="font-size: 14px">@2010-2019</p>
            <p style="font-size: 12px">Все права защищены</p>
        </div>
    </div>
</body>

</html>