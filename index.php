<?php
require("include/db_connect.php");
require("include/db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Кинотеатр "Сфера"</title>
    <link rel="stylesheet" href="style.css">
</head>

<body style="background: white">
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
            <?php else:?>
                <div class="auth">
                <a href="login.php"><img src="images/-account-box_90550.png" alt=""> Войти в кабинет</a>
                <a href="signup.php"><img src="images/signup.png" alt=""> Зарегистрироваться</a>
            </div>
            <?php endif;?>
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
            <?php else:?>
            
            <?php endif;?>
        </div>
    </div>
    <div class="inner_info">
        <img src="images/wallpaper.jpg">
    </div>
    <div class="main_info">
        <h1>Добро пожаловать в кинотеатр "Сфера"!</h1>
        <br>
        <div class="info">
            <p>Кинотеатр был основан в 2010г. За это время, он расширился, сменил кучу персонала, но всё же остаётся отличным местом для провождения времени за просмотром великолепных фильмов.
                </p><br>

            <p>Команда нашего персонала сосредоточена только на комфорте наших клиентов. Мы хотим сделать ваш просмотр запоминающимся и атмосферным.</p><br>

            <p>Всю информацию о премьерах, адресе и контактной информации вы всегда можете найти у нас на сайте в разделе "Контакты". </p><br>
        </div>
    </div>
    <div class="logo" style="display: flex; justify-content: center;">
        <img src="images/logo1.png" alt="" style="width: 220px; margin: 20px 0px 0px 20px;">
    </div>
    <div class="advanced_info" style="background: #f1f1f1;">
        <h1 style="text-align: center; padding-top: 13px;">Новинки в прокате</h1>
        <div class="container">
            <?php
            $result = mysqli_query($link, "SELECT round(avg(rating_assessment),1) as 'rate', film_preview, film_name, film_genre, film_country, film_year 
            FROM films inner join rating on rating.film_id = films.film_id where film_new = '1' group by film_name");
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                do {
                    echo '                                               
                    <div class="element_info">
                    <div class="head">
                    <img src="' . $row["film_preview"] . '"/>
                        <div class="ratingg">
                            <p style="font-size: 21px;"><b>' . $row["film_name"] . '<br></b>
                            <br></p>
                            <div class="starrate">
                            <p>Рейтинг: ' . $row["rate"] . '</p>
                            <img class="star" src="images/ic_star_128_28867.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="descript">
                        <p>Жанр :' . $row["film_genre"] . '</p>
                        <p>Страна: ' . $row["film_country"] . '</p>
                        <p>Год: ' . $row["film_year"] . '</p>
                    </div>
                </div>';
                } while ($row = mysqli_fetch_array($result));
            }
            ?>
        </div>
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