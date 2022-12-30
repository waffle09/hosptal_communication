<?php

    $connect = mysqli_connect('localhost', 'root', '1235', 'hospital_users');

    if (!$connect) {
        die('Error connect to DataBase');
    }