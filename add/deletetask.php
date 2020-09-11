<?php
    include("../include/db_connect.php");

    if(isset($_POST['delete_task']))
    {
        $task_id = $_POST['delete_task'];
        $query ="DELETE FROM task WHERE task_id = '$task_id'";
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
