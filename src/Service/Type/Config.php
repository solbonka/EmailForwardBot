<?php

namespace App\Service\Type;

class Config
{
    private string $emailLogin;
    private string $emailPassword;
    private int $telegramChatId; // Id чата.
    private string $imapHost;

    public function __construct(string $emailLogin, string $emailPassword, int $telegramChatId, string $imapHost)
    {
        $this->emailLogin = $emailLogin;
        $this->emailPassword = $emailPassword;
        $this->telegramChatId = $telegramChatId;
        $this->imapHost = $imapHost;
    }

    public function getTelegramChatId(): int
    {
        return $this->telegramChatId;
    }

    public function getImapHost(): string
    {
        return $this->imapHost;
    }

    public function getEmailLogin(): string
    {
        return $this->emailLogin;
    }

    public function getEmailPassword(): string
    {
        return $this->emailPassword;
    }
}
