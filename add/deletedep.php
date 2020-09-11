<?php
    include("../include/db_connect.php");

    if(isset($_POST['delete_dep']))
    {
        $dep_id = $_POST['delete_dep'];
        $query ="DELETE FROM departments WHERE department_id = '$dep_id'";
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
