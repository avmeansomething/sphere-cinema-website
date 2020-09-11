<?php
include("include/db_connect.php");
include("include/db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Контакты</title>
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
        <img src="images/contacts.jpg" alt="">
    </div>

    <div class="contacts_info">
        <h1 style="text-align: center;">Наши контакты</h1>
        <div class="info">
            <p>Благодарим Вас за проявленный интерес. Мы постараемся ответить на все Ваши вопросы и предоставить более подробную информацию по оказываемым услугам.</p>
        </div>
    </div>
    <div class="allcontacts">
        <div class="adress">
            <h3 style="text-align: center;">Адрес</h3>
            <p><img src="images/marker.jpg" alt="">г. Минск, ул. Максима Танка 24</p>
        </div>
        <div class="adress">
            <h3 style="text-align: center;">Телефоны</h3>
            <p><img src="images/phone.jpg" alt=""> +375 (17) 350-77-44 </p>
            <p><img src="images/a1.jpg" alt=""> +375 (29) 17-929-17 </p>
            <p><img src="images/life.jpg" alt=""> +375 (25) 76-929-17 </p>
        </div>
        <div class="adress">
            <h3 style="text-align: center;">Электронная почта</h3>
            <p>spherecinema@gmail.com</p>
        </div>
    </div>

    
    <iframe style="padding: 0px; margin: 0px;" 
    src="https://yandex.ru/map-widget/v1/?um=constructor%3Aacd6847b78b9b84dcbc7e72af0c399aa789bc156a8a09dda4a7edcaf81f44842&amp;source=constructor" width="100%" height="481" frameborder="0"></iframe>
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
