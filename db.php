<?php

function dbConnect() {
    $mysqlConnection = mysql_connect("localhost", "host1409556", "0f7cd928");

    if ($mysqlConnection) {
        mysql_query("SET NAMES 'cp1251'", $mysqlConnection);
    } else {
        die("Ошибка соединения с БД");
    }

    return $mysqlConnection;
}

dbConnect();