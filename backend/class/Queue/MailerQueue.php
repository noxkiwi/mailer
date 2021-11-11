<?php declare(strict_types = 1);
namespace noxkiwi\mailer\Queue;

use noxkiwi\queue\Queue\RabbitmqQueue;

/**
 * I am the Queue for sending emails.
 *
 * @package      noxkiwi\mailer\Queue
 * @author       Jan Nox <jan@nox.kiwi>
 * @license      https://nox.kiwi/license
 * @copyright    2020 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
final class MailerQueue extends RabbitmqQueue
{
}
