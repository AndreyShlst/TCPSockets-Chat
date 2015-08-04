<?php
                                                    /*Сервер*/
set_time_limit(0);
$address = "127.0.0.1";
$port = 1000;

try {
    echo 'Create socket ... ';
    $socket_desc = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);//Создаем сокет.Получаем дескриптор для соединения.
    if (!$socket_desc) {
        throw new Exception('Ошибка создания сокета'.socket_strerror(socket_last_error()));
    }else{
        echo "Ok<br>";
    }
    echo "Bind socket....";
    if(!socket_bind($socket_desc,$address,$port)){//Привязываем полученный дескриптор к ip ресурса.
        throw new Exception('Ошибка привязки сокета'.socket_last_error());
    }else{
        echo "Ok<br>";
    }
    echo "Listen socket....";
    if(!socket_listen($socket_desc)){//Прослущиваем соединение на сокете
        throw new Exception('Ошибка послушки сокета'.socket_strerror(socket_last_error()));
    }else{
        echo "Ok<br>";
    }
    echo "Accept socket....";
    do{
        $accept_socket = socket_accept($socket_desc);//Принимаем соединение на сокете.Если нету ожидающих соединений, то функция socket_accept() будет блокировать выполнение скрипта до тех пор, пока не появится соединение.
        if(!$accept_socket){
            throw new Exception('Невозможно принять соединение'.socket_strerror(socket_last_error()));
        }else{
            echo "Wait<br>";
        }
        $id = uniqid('user_');
        $msg = "Привет $id\n";
        socket_write($accept_socket, $msg);
    }while(true);
    //socket_close($socket_desc);//Закрываем сокет
}catch(Exception $e){
    echo $e->getMessage();
}
