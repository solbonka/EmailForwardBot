<?php

namespace App\MessageHandler;

use App\Service\MessageTextConverter;
use App\Service\Type\Config;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;
use PhpImap\Exception;
use PhpImap\Mailbox;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

class EmailForwardMessageHandler
{
    public function __construct(private Telegram $telegram)
    {
    }

    /**
     * @throws TelegramException
     * @throws Exception
     */
    #[AsMessageHandler]
    public function __invoke(Config $config): void
    {
        try {
            $mailbox = new Mailbox(
                $config->getImapHost(),
                $config->getEmailLogin(),
                $config->getEmailPassword(),
                null,
            );
            $converter = new MessageTextConverter();
            $todayUnseenMailIds = $mailbox->searchMailbox('UNSEEN ON ' . date('Y-m-d'));
            if ($todayUnseenMailIds) {
                foreach($todayUnseenMailIds as $mailId) {
                    $mail = $mailbox->getMail($mailId);
                    $text = $converter->convert($mail);
                    Request::sendMessage(
                        [
                            'chat_id' => $config->getTelegramChatId(),
                            'text' => $text,
                        ]
                    );
                }
            }
        } catch (TelegramException $e) {
            throw new TelegramException($e->getMessage());
        }
    }
}
