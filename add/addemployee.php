<?php
include("../include/db_connect.php");

if (isset($_POST['em_id']) && isset($_POST['em_name']) && isset($_POST['em_salary']) && isset($_POST['em_department']) && isset($_POST['em_photo'])) {

    $em_id = $_POST['em_id'];
    $em_name = $_POST['em_name'];
    $em_salary = $_POST['em_salary'];
    $em_department = $_POST['em_department'];
    $em_photo = $_POST['em_photo'];

    $result = mysqli_query($link, "SELECT department_id FROM departments where department_name = '$em_department'");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        do {
            $dep_id = $row['department_id'];
        } while ($row = mysqli_fetch_array($result));
    }

    $query = "INSERT INTO `employees` (`employee_id`, `employee_name`, `employee_salary`, `department_num`, `employee_photo`)
        VALUES ('$em_id', '$em_name', '$em_salary', '$dep_id', '$em_photo')";

    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    if ($result) {
        echo '
            Добавлено
    ';
    } else {
        echo '
            Не добавлено
    ';
    }
}
