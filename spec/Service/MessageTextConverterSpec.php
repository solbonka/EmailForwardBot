<?php

namespace spec\App\Service;

use App\Service\MessageTextConverter;
use PhpImap\IncomingMail;
use PhpSpec\ObjectBehavior;

class MessageTextConverterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(MessageTextConverter::class);
    }

    function it_convert_textPlain_to_telegramText()
    {
        $mail = new IncomingMail();
        $mail->id = 1;
        $mail->toString = 'your@email.com';
        $mail->fromAddress = 'input@email.com';
        $mail->textPlain = 'TestMessage';
        $this->convert($mail)->shouldBe("Новое сообщение на Вашей почте: " . $mail->toString . "\n" .
            "От: " . $mail->fromAddress . "\n" . 'TestMessage');
    }

    function it_convert_textHtml_to_telegramText()
    {
        $mail = new IncomingMail();
        $mail->id = 1;
        $mail->toString = 'your@email.com';
        $mail->fromAddress = 'input@email.com';
        $mail->textHtml = "<!DOCTYPE html>
                            <html lang=\"en\">
                            <head>
                            <title>Page Title</title>
                            </head>
                            <body>
                            
                            <h1>Test message</h1>
                            <p>MyTest</p>
                            
                            </body>
                            </html>";
        $this->convert($mail)->shouldBe("Новое сообщение на Вашей почте: " . "your@email.com" . "\n" .
            "От: " . "input@email.com" . "\n" . " Page Title Test message MyTest ");
    }
}
