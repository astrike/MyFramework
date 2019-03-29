<?php

namespace Controllers\Mail;

class Mail
{
    /**
     * Отправка письма для активации аккаунта.
     * @param string $to
     * @param string $message
     * @return mail
     */
    public static function registerSendMail($to, $message) {
        //Метод в стадии разработки!!!
        $subject = "Activate your mail on the site Framework Blog";
        $message = "To activate your account follow the link \r\n" . $message;
        $message = wordwrap($message, 70, "\r\n");
        $headers = "From: <FrameworkBlog>\r\n";
        $headers .= "The letter was created automatically, do not reply to it.\r\n";

        return mail($to, $subject, $message, $headers);
    }
}