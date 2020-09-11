<?php
include("include/db_connect.php")
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Персонал студии</title>
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
                <p>Сб: 8:00 - 16:00 Вс: выходной</p>
            </div>
            <div class="adress">
                <p><img src="images/marker.jpg" alt="">г. Минск, ул. Максима Танка 24</p>
            </div>
            <div class="contacts">
                <p><img src="images/phone.jpg" alt=""> +375 (17) 350-77-44 </p>
                <p><img src="images/a1.jpg" alt=""> +375 (29) 17-929-17 </p>
                <p><img src="images/life.jpg" alt=""> +375 (25) 76-929-17 </p>
            </div>
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
                    Проекты
                </div>
            </a>
            <a href="services.php">
                <div class="menu_element">
                    <br>
                    Персонал
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
                    Обращение
                </div>
            </a>
            <a href="info.php">
                <div class="menu_element">
                    <br>
                    Информация
                </div>
            </a>
        </div>
    </div>
    <div class="inner_info">
        <img src="images/personal.jpg" alt="">
    </div>
    <div class="services_info">
        <h1 style="text-align: center;">Персонал студии</h1>
        <div class="info">
            <p>Современные технологии и передовые методики разработки дают возможность нам в минимальные сроки предоставлять Вам готовые программные продукты. Это позволит вашему бизнесу быстрее и продуктивнее развиваться на современном рынке.</p><br>
        </div>
        <div class="projects">

            <?php
            $result = mysqli_query($link, "SELECT employee_name, employee_salary, employee_photo, department_name FROM `employees` inner join departments on employees.department_num = departments.department_id");

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                do {
                    echo '                                               
                        <div class="project">
                            <img src="' . $row["employee_photo"] . '" alt="" width="215" height="400">
                            <h3><b>' . $row["employee_name"] . '</b></h3>
                            <p><b>Отдел работы: ' . $row["department_name"] . '</b></p>
                            <p>Оклад сотрудника:  ' . $row["employee_salary"] . '$</p>
                        </div>';
                } while ($row = mysqli_fetch_array($result));
            }
            ?>
        </div>
    </div>
    <div class="services_info">
        <h1 style="text-align: center;">Текущие задания разработчиков</h1>
        <div class="info">
            <p>Сотрудники нашей студии являются специалистами в области веб-разработки, тестирования и поддержки ПО. Благодаря опыту и профессионализму нашего персонала, а также наличию современного оборудования, обеспечивается высокое качество выполняемых проектов.</p><br>
        </div>
        <div class="projects">

            <?php

            $result = mysqli_query($link, "SELECT project_name, task_name, employee_name, task_startDate, task_duration, task_completeMark, employee_photo FROM task inner join employees on task.employee_code = employees.employee_id inner join projects on task.project_code = projects.project_id");

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                do {
                    echo '                                               
                    <div class="project">
                        <img src="' . $row["employee_photo"] . '" alt="" width="215" height="400">
                        <h3><b>' . $row["employee_name"] . '</b></h3>
                        <p>Дата начала выполнения:  ' . $row["task_startDate"] . '</p>
                        <p>Срок выполнения задания:  ' . $row["task_duration"] . ' дней(день)</p>
                        <p>Отметка о выполнении:  <b>' . $row["task_completeMark"] . '</b></p>
                    </div>';
                } while ($row = mysqli_fetch_array($result));
            }
            ?>
        </div>
    </div>
    <div class="footer">
        <div class="footinfo">
            <p style="font-size: 14px"><b>ООО «Оnyx»</b></p>
            <p style="font-size: 12px">220068, Республика Беларусь,</p>
            <p style="font-size: 12px">г. Минск, ул. Максима Танка 24</p>
            <p style="font-size: 12px">E-mail: onyxprojects@gmail.com</p>
        </div>
        <div class="footinfo">
            <p style="font-size: 14px"><b>Время работы студии:</b></p>
            <p style="font-size: 12px">Понедельник - пятница:</p>
            <p style="font-size: 12px">08:00 - 20:00</p>
            <p style="font-size: 12px">Суббота: 08:00 - 16:00</p>
            <p style="font-size: 12px">Воскресенье: выходной</p>
        </div>
        <div class="footinfo">
            <br>
            <p style="font-size: 14px">@2010-2019</p>
            <p style="font-size: 12px">Все права защищены</p>
            <a href="addinfo.php">Добавить редактировать инфо</a>

        </div>
    </div>
</body>

</html>