<?php declare(strict_types = 1);
namespace noxkiwi\mailer;

require_once dirname(__FILE__, 5) . '/bootstrap.php';

use noxkiwi\mailer\Consumer\MailerConsumer;
$consumer = new MailerConsumer("Mailer");
$consumer->run();
