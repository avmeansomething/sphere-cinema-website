<?php
require("include/db.php");
?>

<?php
if (isset($_POST['index'])) {
    header("Location: index.php");
}
if (isset($_POST['submit'])) {
    $errors = array();
    $user = R::findOne('users', 'login = ?', array($_POST['login']));
    if ($user) {
        if (password_verify($_POST['pass'], $user->password)) {
            $_SESSION['logged_user'] = $user;
            header("Location: index.php");
        } else {
            $errors[] = 'Вы ввели не верный пароль!';
        }
    } else {
        $errors[] = 'Пользователь с таким логином не найден!';
    }
}



if (!empty($errors)) {
    echo '<script> alert("' . array_shift($errors) . '");</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вход в личный кабинет - TraceShop</title>
    <link rel="stylesheet" href="style.css">
</head>

<body style="background: url(images/60254-svet-krasnyj_cvet-kinoteatr-kino-film-1920x1080.jpg)">
    <div>
        <div class="authorize">
            <form id="contact" action="" method="post">
                <h3>Авторизация</h3>
                <h4>Пройдите этап авторизации и комментируйте фильмы с другими пользователями</h4>
                <fieldset>
                    <input placeholder="Логин" name="login" type="text" tabindex="1" required>
                </fieldset>
                <fieldset>
                    <input placeholder="Пароль" name="pass" type="password" tabindex="2" required>
                </fieldset>

                <fieldset style="margin-top: 15px;">
                    <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Войти</button>
                </fieldset>
            </form>
        </div>
    </div>
</body>

</html>