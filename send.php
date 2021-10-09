<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Переменные, которые отправляет пользователь
$name = $_POST['name'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$email = $_POST['email'];
$subscribe = $_POST['subscribe'];
$form = $_POST['form'];
$booking = $_POST['booking'];
$thankyou = $_POST['thankyou'];


// Формирование самого письма
if($form == 'booking'){
    // если есть что-то в $_POST['email']
   $title = "New appeal Best Tour Plan";
   $body = "
   <h2>New appeal</h2>
   <b>Name:</b> $name<br>
   <b>Phone:</b> $phone<br>
   <b>Email:</b> $email<br><br>
   <b>Messege:</b><br>$message
   ";
} elseif ($form == 'subscription') {
    // если нет, отправлена форма с телефоном и пр.
    $title = "New subscription to the Best Tour Plan";
    $body ="
    <h2>New subscription</h2>
    <b>Email:</b> $subscribe<br><br>
";
} elseif ($form == 'thankyou') {
    // если нет, отправлена форма с телефоном и пр.
    $title = "New appeal Best Tour Plan";
    $body ="
    <h2>New appeal</h2>
    <b>Name:</b> $name<br>
    <b>Phone:</b> $phone<br>
    <b>Messege:</b><br>$message
    ";
}

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    // $mail->SMTPDebug = 2; 
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'smtp.mail.ru'; // SMTP сервера вашей почты
    $mail->Username   = 'fkevdin@mail.ru'; // Логин на почте
    $mail->Password   = 'R8VcrU6wU8hLKPRufVFt'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('fkevdin@mail.ru', 'Федор Кевдин'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('kevdina@yandex.ru');  

// Отправка сообщения
$mail->isHTML(true);
$mail->Subject = $title;
$mail->Body = $body;    

// Проверяем отравленность сообщения
if ($mail->send()) {$result = "success";} 
else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

// Отображение результата
if ($form == 'booking') {
    header('Location: thankyou.html');
}elseif ($form == 'subscription') {
    header('Location: subscribe.html');
}elseif ($form == 'thankyou') {
    header('Location: thankyou.html');
}