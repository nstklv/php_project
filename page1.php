<?php
session_start();

include 'db.php';
$errorContainer = array();

$arrayFields = array(
    'name_user' => $_POST['name_user'],
    'email_user' => $_POST['email_user'],
    'password_user' => $_POST['password_user'],
    'password_2_user' => $_POST['password_2_user']
);
// проверка всех полей на пустоту
foreach ($arrayFields as $fieldName => $oneField) {
    if ($oneField == '' || !isset($oneField)) {
        $errorContainer[$fieldName] = "Поле обязательно для заполнения";
    }
}

if (!preg_match('/^[a-zа-я\d]{3,50}$/ui', $arrayFields['name_user'])) {
    $errorContainer['name_user'] = "Имя не соответствует требованиям";
} else {
    $loginQuery = "SELECT user_id FROM users WHERE login='{$arrayFields["name_user"]}'";
    $loginResult = mysqli_query($conn, $loginQuery) or die("Ошибка выполнения
запроса" . mysqli_error($conn));
    if ($loginResult) {
        $row = mysqli_fetch_row($loginResult);
        if (!empty($row[0])) $errorContainer['name_user'] = "Пользователь с данным
логином существует";
    }
}
if (!preg_match(
    '/^[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}$/i',
    $arrayFields['email_user']
)) {
    $errorContainer['email_user'] = "Почта не соответствует требованиям";
}

if ($arrayFields['password_user'] != $arrayFields['password_2_user']) {
    $errorContainer['password_2_user'] = 'Пароли не совпадают';
}
//ответ для клиента
if (empty($errorContainer)) {
    echo json_encode(array('result' => 'success'));
} else {
    echo json_encode(array('result' => 'error', 'text_error' => $errorContainer));
}
?>