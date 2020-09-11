<?php
require("include/db_connect.php");
require("include/db.php");


if (isset($_POST['addfilm'])) {
    $filmname = $_POST['filmname'];
    $filmgenre = $_POST['filmgenre'];
    $filmduration = $_POST['filmduration'];
    $filmpic = $_POST['filmpic'];
    $filmdesc = $_POST['filmdesc'];
    $filmcountry = $_POST['filmcountry'];
    $filmyear = $_POST['filmyear'];
    $filmnew = $_POST['filmnew'];
    $sql = "INSERT INTO `films` (`film_id`, `film_name`, `film_genre`, `film_duration`, `film_preview`, `film_description`, `film_country`, `film_year`, `film_new`)
     VALUES (NULL, '$filmname', '$filmgenre', '$filmduration', '$filmpic', '$filmdesc', '$filmcountry', '$filmyear', '$filmnew')";

    $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
    if($result)
    {
        echo'<div style="color:green;";">Фильм добавлен</div>';
    }else{
        echo'<div style="color:red;";">Фильм не добавлен</div>';
    }
}
if (isset($_POST['addrate'])) {
    $id = $_POST['filmid'];
    $assesmt = $_POST['filmrate'];
    $sql = "INSERT INTO `rating` (`rating_id`, `film_id`, `rating_assessment`) VALUES (NULL, '$id', '$assesmt')";
    $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
    if($result)
    {
        echo'<div style="color:green;";">Рейтинг добавлен</div>';
    }else{
        echo'<div style="color:red;";">Рейтинг не добавлен</div>';
    }
}
if (isset($_POST['addcomment'])) {
    $id = $_POST['filmid'];
    $cmttxt = $_POST['comment'];
    $name = $_POST['usname'];
    $assesmt = $_POST['filmrate'];
    $sql = "INSERT INTO `comments` (`comment_id`, `comment_text`, `film_id`, `user_name`, `user_assessment`) VALUES (NULL, '$cmttxt', '$id', '$name', '$assesmt')";
    $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
    if($result)
    {
        echo'<div style="color:green;";">Комментарий добавлен</div>';
    }else{
        echo'<div style="color:red;";">Комментарий не добавлен</div>';
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Админ очка</title>
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
        <img src="images/admin.jpg">
    </div>

    <div class="addinforms"  style="display: flex; flex-direction: row; justify-content: center; align-items:center;">

        <div>
            <div class="authorize" >
                <form id="contact" action="adminpanel.php" method="post" style="margin:5vw; width: 17vw" >
                    <h3>Фильм</h3>
                    <fieldset>
                        <input placeholder="Название фильма" name="filmname" type="text" tabindex="1" required>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Жанр" name="filmgenre" type="text" tabindex="2" required>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Продолжительность" name="filmduration" type="text" tabindex="2" required>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Картинка" name="filmpic" type="text" tabindex="2" required>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Описание" name="filmdesc" type="text" tabindex="2" required>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Страна" name="filmcountry" type="text" tabindex="2" required>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Год" name="filmyear" type="text" tabindex="2" required>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Новый?" name="filmnew" type="text" tabindex="2" required>
                    </fieldset>
                    <fieldset style="margin-top: 15px;">
                        <button name="addfilm" type="submit" id="contact-submit" data-submit="...Sending">Добавить</button>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="authorize">
            <form id="contact" action="adminpanel.php" method="post" style="margin:5vw; width: 17vw">
                <h3>Рейтинг</h3>
                <fieldset>
                    <input placeholder="ID Фильма" name="filmid" type="text" tabindex="1" required>
                </fieldset>
                <fieldset>
                    <input placeholder="Рейтинг" name="filmrate" type="text" tabindex="2" required>
                </fieldset>

                <fieldset style="margin-top: 15px;">
                    <button name="addrate" type="submit" id="contact-submit" data-submit="...Sending">Добавить</button>
                </fieldset>
            </form>
        </div>
        <div class="authorize">
            <form id="contact" action="adminpanel.php" method="post" style="margin:5vw; width: 17vw">
                <h3>Комментарий</h3>
                <fieldset>
                    <input placeholder="ID Фильма" name="filmid" type="text" tabindex="1" required>
                </fieldset>
                <fieldset>
                    <input placeholder="Комментарий" name="comment" type="text" tabindex="1" required>
                </fieldset>
                <fieldset>
                    <input placeholder="Имя кто оставил" name="usname" type="text" tabindex="1" required>
                </fieldset>
                <fieldset>
                    <input placeholder="Рейтинг" name="filmrate" type="text" tabindex="2" required>
                </fieldset>

                <fieldset style="margin-top: 15px;">
                    <button name="addcomment" type="submit" id="contact-submit" data-submit="...Sending">Добавить</button>
                </fieldset>
            </form>
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