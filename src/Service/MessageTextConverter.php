<?php

namespace App\Service;

use PhpImap\IncomingMail;

class MessageTextConverter
{
    public function convert(IncomingMail $mail): string
    {
        if ($mail->textPlain) {
            $text = $mail->textPlain;
        } else {
            $html = preg_replace("'<style[^>]*?>.*?</style>'si","", $mail->textHtml);
            $html = strip_tags($html);
            $html = html_entity_decode($html);
            $html = preg_replace('/\s+/', ' ', $html);
            $text = $html;
        }

        return "Новое сообщение на Вашей почте: " . $mail->toString . "\n" .
               "От: " . $mail->fromAddress . "\n" . $text;
    }
}
