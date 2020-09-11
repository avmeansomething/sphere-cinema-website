<?php
    include("../include/db_connect.php");

    if(isset($_POST['emp_delete']))
    {
        $task_id = $_POST['emp_delete'];
        $query ="DELETE FROM employees WHERE employee_id = '$task_id'";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
        if ($result) {
            echo '
                Удалено
        ';
        } else {
            echo '
                Не удалено
        ';
        }
    }
?>
