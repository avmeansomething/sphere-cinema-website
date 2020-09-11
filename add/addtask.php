<?php
    include("../include/db_connect.php");

    if(isset($_POST['task_id']) && isset($_POST['task_duration']) && isset($_POST['task_name']) && isset($_POST['employee_code']) && isset($_POST['task_completeMark']))
    {

        $task_id = $_POST['task_id'];
        $project_name = $_POST['projecttask_code'];
        $task_name = $_POST['task_name'];
        $taskemployee_code = $_POST['employee_code'];
        $task_startDate = $_POST['task_startDate'];
        $task_duration = $_POST['task_duration'];
        $task_completeMark = $_POST['task_completeMark'];
        
        $result = mysqli_query($link, "SELECT project_id FROM projects where project_name = '$project_name'");

        if (mysqli_num_rows($result) > 0) {
         $row = mysqli_fetch_array($result);
          do {
              $taskprojectcode = $row['project_id'];
          } while ($row = mysqli_fetch_array($result));
        }

        $result = mysqli_query($link, "SELECT employee_id FROM employees where employee_name = '$taskemployee_code'");

        if (mysqli_num_rows($result) > 0) {
         $row = mysqli_fetch_array($result);
          do {
              $taskemployeecode = $row['employee_id'];
          } while ($row = mysqli_fetch_array($result));
        }

        $query ="INSERT INTO `task` (`task_id`, `project_code`, `task_name`, `employee_code`, `task_startDate`, `task_duration`, `task_completeMark`) 
        VALUES ('$task_id', '$taskprojectcode', '$task_name', '$taskemployeecode', '$task_startDate', '$task_duration', '$task_completeMark')";
        
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
