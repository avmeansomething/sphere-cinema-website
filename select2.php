<?php
include("include/db_connect.php")
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Дополнительная информация</title>
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
        <img src="images/info.jpg" alt="">
    </div>
    <div class="main_goods">
        <div class="selected_info">
            <h1 style="text-align: center;">#1. Название проектов, срок которых меньше заданного</h1>

            <div class="inputs" style="margin-bottom: 1.3vw; display: flex; justify-content: center; ">
                <form action="select1.php" method="POST">
                    <input type="text" placeholder="Количество дней" name="dayss" style="margin: 1vw 1vw;">
                    <button type="submit" class="send_request_button">Результат</button>
                </form>
            </div>
            <div class="projects">
                <?php
                if (isset($_POST['dayss'])) {

                    $day = $_POST['dayss'];

                    $result = mysqli_query($link, "SELECT * FROM projects where project_duration < '$day'");

                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '                                               
                            <div class="items" style="background: white;">
                            <p class="category" style="font-size: 1.42vw;">' . $row["project_name"] . '</p>
                            <img src="' . $row["project_photo"] . '" alt="" width="200" height="190">
                            <br>Ответственный за проект<br>
                            <p style="margin-top: 1px;"><b>' . $row["project_bossname"] . '</b></p>
                            <a>Cроки выполнения проекта:  ' . $row["project_duration"] . ' дней(день)</a>
                            </div>';
                        } while ($row = mysqli_fetch_array($result));
                    }
                }
                ?>
            </div>
        </div>
        <div class="selected_info">
        <h1 style="text-align: center;">#2. Информация о проектах, где участвовал введённый сотрудник</h1>

            <div class="inputs" style="margin-bottom: 1.3vw; display: flex; justify-content: center; ">
                <form action="select2.php" method="POST">
                    <input type="text" placeholder="ФИО Сотрудника" name="FIOName" style="margin: 1vw 1vw;">
                    <button type="submit" class="send_request_button">Результат</button>
                </form>
            </div>
            <div class="selected">
                <?php
                if (isset($_POST['FIOName'])) {
                    $fio = $_POST['FIOName'];

                    $result = mysqli_query($link, "SELECT project_bossname, project_name, project_cost, project_duration, 
            project_photo from employees inner join task on task.employee_code = employees.employee_id inner join 
            projects on projects.project_id = task.project_code where employee_name = '$fio'") or die(mysqli_error($link));

                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '                                               
                            <div class="items" style="background: white;">
                            <p class="category" style="font-size: 1.42vw;">' . $row["project_name"] . '</p>
                            <img src="' . $row["project_photo"] . '" alt="" width="200" height="290">
                            <br>Ответственный за проект<br>
                            <p style="margin-top: 1px;"><b>' . $row["project_bossname"] . '</b></p>
                               <a>Cроки выполнения проекта:  ' . $row["project_duration"] . ' дней(день)</a>
                            </div>';
                        } while ($row = mysqli_fetch_array($result));
                    }
                }
                ?>
            </div>
        </div>
        <h1 style="text-align: center;">#3. Общая стоимость всех проектов</h1>
        <?php

        $result = mysqli_query($link, "SELECT sum(project_cost) as allSum from projects");

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            do {
                echo '                                               
                        <div class="result" style="background: white;">
                        <p class="category" style="font-size: 1.2vw; text-align: center;">Общая стоимость всех проектов: <br></p>
                        <h3 style="text-align: center;">' . $row["allSum"] . '$</h3>
                        </b></p>
                        </div>';
            } while ($row = mysqli_fetch_array($result));
        }
        ?>
        <h1 style="text-align: center;">#4. Информация о заданиях с отметкой "не выполнено"</h1>
        <div class="projects">
            <?php
            $result = mysqli_query($link, "SELECT project_name, task_name, employee_name, task_startDate, task_duration, task_completeMark, employee_photo FROM task inner join employees on task.employee_code = employees.employee_id inner join projects on task.project_code = projects.project_id where task_completeMark = 'не выполнено'");

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
        <h1 style="text-align: center;">#5. Средний оклад сотрудников по отделениям</h1>
        <div class="projects">
            <?php

            $result = mysqli_query($link, "SELECT round(avg(employee_salary)) as Salary, department_name, department_logo FROM employees inner join departments on employees.department_num = departments.department_id GROUP BY departments.department_name");

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                do {
                    echo '                                               
                    <div class="items" style="background: white;">
                        <p class="category" style="font-size: 1.2vw; text-align: center;">Отделение: <br>' . $row["department_name"] . '</p>
                        <img src="images/' . $row["department_logo"] . '" alt="" width="190" height="190">
                        <p style="margin-top: 2px;"><b>Средний оклад сотрудников: ' . $row["Salary"] . '$</b></p>
                    </div>';
                } while ($row = mysqli_fetch_array($result));
            }
            ?>
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
        <link rel="stylesheet" href="style.css">

</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {
        $("a[href^=' #menu']").click(function() {
            var _href = $(this).attr("href");
            $("html").animate({
                scrollTop: $(_href).offset().top + "px"
            });
            return false;
        });
    });
</script>

</html>