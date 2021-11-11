<?php declare(strict_types = 1);
namespace noxkiwi\mailer\Message;

use noxkiwi\queue\Message;

/**
 * I am an email Message object.
 *
 * @package      noxkiwi\mailer\Message
 * @author       Jan Nox <jan@nox.kiwi>
 * @license      https://nox.kiwi/license
 * @copyright    2020 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
final class MailerMessage extends Message
{
    /** @var string[] */
    public array  $to;
    /** @var string[] */
    public array  $cc;
    /** @var string[] */
    public array  $bcc;
    /** @var string */
    public string $subject;
    /** @var string */
    public string $body;
    /** @var array[] */
    public array  $attachments;
    /** @var array */
    public array $from;
    /** @var bool */
    public bool $isHtml;
}

