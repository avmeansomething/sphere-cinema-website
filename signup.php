<?php
require("include/db.php");
?>

<?php
if (isset($_POST['index']))
    header("Location: index.php");


if (isset($_POST['submit'])) {
    $errors = array();
    if (trim($_POST['login']) == '')
        $errors[] = 'Введите логин!';

    if (($_POST['pass']) == '')
        $errors[] = 'Введите пароль!';

    if (($_POST['cpass']) != $_POST['pass'])
        $errors[] = 'Введённый повторный пароль не соответствует введённому!';

    if (($_POST['fname']) == '')
        $errors[] = 'Введите ваше Имя!';

    if (R::count('users', "login = ?", array($_POST['login'])) > 0) {
        $errors[] = 'Пользователь с таким логином уже существует!';
    }

    if (R::count('users', "email = ?", array($_POST['email'])) > 0) {
        $errors[] = 'Пользователь с такой почтой уже существует!';
    }

    if (empty($errors)) {

        $role = $_POST['admin'];
        if ($role == "sunflower") {

            $users = R::dispense('users');
            $users->login = $_POST['login'];
            $users->password = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $users->first_name = $_POST['fname'];
            $users->email = $_POST['email'];
            $users->role = 'администратор';
            R::store($users);
            echo '<script> alert("Admin Registered!");</script>';

            header("Location: index.php");
        } else {
            $users = R::dispense('users');
            $users->login = $_POST['login'];
            $users->password = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $users->first_name = $_POST['fname'];
            $users->email = $_POST['email'];
            $users->role = 'пользователь';
            R::store($users);
            echo '<script> alert("User Registered!");</script>';
            header("Location: index.php");
        }
    } else {
        echo '<script> alert("' . array_shift($errors) . '");</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация нового пользователя - TraceShop</title>
    <link rel="stylesheet" href="style.css">


</head>

<body>
    <!-- <img src="images/logo.png" alt="" width="200" style="position: absolute; top:2%; left:2%"> -->
    <div>
        <div class="authorize">
            <form id="contact" action="signup.php" method="POST">
                <h3>Регистрация</h3>
                <h4>Приветствуем в нашем кинотеатре!</h4>
                <fieldset>
                    <input placeholder="Логин" name="login" type="text" tabindex="1" required>
                </fieldset>
                <fieldset>
                    <input placeholder="Пароль" name="pass" type="password" tabindex="2" required>
                </fieldset>
                <fieldset>
                    <input placeholder="Подтвердите пароль" name="cpass" type="password" tabindex="2" required >
                </fieldset>
                <fieldset>
                    <input placeholder="Имя" name="fname" type="text" tabindex="2" required value="<?php echo @$_POST['fname']; ?>">
                </fieldset>
                <fieldset>
                    <input placeholder="Почта" name="email" type="email" tabindex="2" required value="<?php echo @$_POST['email']; ?>">
                </fieldset>
                <fieldset>
                    <input placeholder="Привилегии" name="admin" type="password" tabindex="2" required>
                </fieldset>
                <fieldset style="margin-top: 15px;">
                    <button name="submit" type="submit" id="contact-submit">Зарегистрироваться</button>
                </fieldset>
            </form>
        </div>
    </div>
</body>
</html>