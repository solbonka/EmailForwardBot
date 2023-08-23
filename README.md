## TELEGRAM_BOT

Приложение для проверки и получения новых сообщений из Email и отправки этих сообщений в Telegram. Реализовано
на [Symfony/Scheduler](https://symfony.com/blog/new-in-symfony-6-3-scheduler-component).

### Структура проекта:

**"Config"** - класс, для хранения данных пользователя:

* $emailLogin - Email пользователя.
* $emailPassword - Пароль от Email.
* $telegramChatId - id чата Telegram.
* $imapHost - Имя почтового ящика: состоит из сервера и пути к почтовому ящику на нем. 
Специальное имя INBOX используется для почтового ящика текущего пользователя. 
Пример: {imap.gmail.com:993/imap/ssl}INBOX. Подробнее в документации [PHP: imap_open - Manual](https://www.php.net/manual/ru/function.imap-open.php).

**"StartEmailSchedulerCommand"** - файл команды для запуска задачи.

**"EmailForwardMessageHandler"** - это обработчик сообщений, который передает полученное сообщение из Email в
"MessageTextConverter", где текст сообщения преобразуется таким образом, чтобы его можно было отправить в Telegram.
Затем сформированный текст передается в `Longman\TelegramBot\Request` для отправки сообщения.

**"EmailForwardScheduleProvider"** - класс для установки расписания задачи. В методе getSchedule() создается новый 
объект расписания (Schedule) и добавляется регулярное сообщение (RecurringMessage). Регулярное сообщение означает, 
что оно будет выполняться периодически с указанным интервалом. В данном случае, сообщение будет отправляться каждые 
30 секунд.

**"MessageTextConverter"** - конвертирует сообщение из Email в такой, что можно его отправить в Telegram.
#### Для сборки "Docker-compose":

* Установить [Docker](https://docs.docker.com/get-started/)

* Откройте терминал (bash) и введите следующие команды:

Собрать контейнеры:

```bash
docker-compose build
```

или

```bash
make build
```

Запустить контейнеры:

```bash
docker-compose up -d
```

или

```bash
make up
```

Проверить запущенные контейнеры

```bash
docker-compose ps -a
```

или

```bash
make ps
```

#### Для установки необходимых библиотек и запуска Consumer:

Зайти в контейнер php-fpm

```bash
docker-compose exec php-fpm bash
```

или

```bash
make in
```

Убедитесь, что вы находитесь в директории /var/www, либо перейдите туда.

Установить необходимые библиотеки

```bash
composer install
```

Получить информацию о зарегистрированных задачах


```bash
php bin/console debug:schedule
```

или

```bash
make info
```

Запустить задачу

```bash
php bin/console run:command
```

или

```bash
make run
```
