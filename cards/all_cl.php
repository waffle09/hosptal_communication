<?php
session_start();
            if (isset($_POST['all_cl'])
            {
            //     for($n = 0; $n < count($row); $n++){
            //         print(" " . $row[$n]['ful_clent_name'] . "<br>");
            //     }
            // }
            $_SESSION['message'] = 'Не правильний логін чи пароль';
        // header('Location: /index2.php')
        exit("<meta http-equiv='refresh' content='0; url=index4.php'>");
            }
            // print_r($row);
            ?>