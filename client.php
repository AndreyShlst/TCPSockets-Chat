<?php
                                    /*Клиент*/
$address = "127.0.0.1";
$port = 7000;
try{
    echo 'Create socket for client ... ';
    $client_socket_desc = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);//Создаем сокет.Получаем дескриптор для соединения.
    if (!$client_socket_desc) {
        throw new Exception('Ошибка создания сокета'.socket_strerror(socket_last_error()));
    }else{
        echo "Ok<br>";
    }
    echo 'Connect with server ... ';
    if (!socket_connect($client_socket_desc,$address,$port)) {
        throw new Exception('Ошибка соединения с сервером'.socket_last_error());
    }else{
        echo "Ok<br>";
    }

    $txt = socket_read($client_socket_desc,2096,PHP_NORMAL_READ);
    echo $txt;
}catch(Exception $e){
    echo $e->getMessage();
}