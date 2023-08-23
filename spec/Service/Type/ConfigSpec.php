<?php

namespace spec\App\Service\Type;

use App\Service\Type\Config;
use PhpSpec\ObjectBehavior;

class ConfigSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(
            'your@email.com',
            'yourPassword',
            1234567890,
            '{imap.gmail.com:993/imap/ssl}INBOX'
        );
        $this->shouldHaveType(Config::class);
    }
}
