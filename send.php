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

$title = "New appeal Best Tour Plan";
$body = "
<h2>New appeal</h2>
<b>Name:</b> $name<br>
<b>Phone:</b> $phone<br>
<b>Email:</b> $email<br><br>
<b>Messege:</b><br>$text
";

// Формирование самого письма
if(isset($_POST['email'])){
    // если есть что-то в $_POST['email']
    $title = 'New appeal Best Tour Plan';
    $body = '<h2>New appeal </h2> <b>Email:</b> ' . $_POST['email'];
} else {
    // если нет, отправлена форма с телефоном и пр.
    $title = 'New appeal Best Tour Plan';
    $body ='<h2>New appeal </h2> <b>Name:</b> ' . $_POST['name'] . ' <br />';
    $body.= '<b>Phone:</b> ' . $_POST['phone']. ' <br />';
    $body.= '<b>Messege:</b> ' .$_POST['message']. ' <br />' ;
};

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
    $mail->Username   = 'mmotya.mmotya@mail.ru'; // Логин на почте
    $mail->Password   = 'UcAJgenFFy5pFwACrZb3'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('mmotya.mmotya@mail.ru', 'Мотя Виноградова'); // Адрес самой почты и имя отправителя

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
header('Location: thankyou.html');