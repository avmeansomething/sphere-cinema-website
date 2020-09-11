<?php
    include("../include/db_connect.php");

    if(isset($_POST['dep_id']) && isset($_POST['dep_name']) && isset($_POST['dep_phone']) && isset($_POST['dep_boss']) && isset($_POST['dep_photo']))
    {

        $dep_id = $_POST['dep_id'];
        $dep_name = $_POST['dep_name'];
        $dep_phone = $_POST['dep_phone'];
        $dep_boss = $_POST['dep_boss'];
        $dep_photo = $_POST['dep_photo'];
        
        $query ="INSERT INTO `departments` (`department_id`, `department_name`, `department_phone`, `department_bossname`, `department_logo`)
         VALUES ('$dep_id', '$dep_name', '$dep_phone', '$dep_boss', '$dep_photo')";
        
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
?>
