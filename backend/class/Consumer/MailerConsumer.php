<?php declare(strict_types = 1);
namespace noxkiwi\mailer\Consumer;

use noxkiwi\core\Exception\InvalidArgumentException;
use noxkiwi\mailer\Mailer;
use noxkiwi\mailer\Message\MailerMessage;
use noxkiwi\queue\Consumer\RabbitmqConsumer;
use noxkiwi\queue\Message;
use function microtime;
use const E_USER_NOTICE;

/**
 * I am the Consumer for sending email messages.
 *
 * @package      noxkiwi\mailer\Consumer
 * @author       Jan Nox <jan@nox.kiwi>
 * @license      https://nox.kiwi/license
 * @copyright    2020 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
final class MailerConsumer extends RabbitmqConsumer
{
    protected const MESSAGE_TYPES = [
        MailerMessage::class
    ];

    /**
     * @inheritDoc
     *
     * @param \noxkiwi\queue\Message $message
     *
     * @throws \noxkiwi\core\Exception\InvalidArgumentException
     * @throws \noxkiwi\singleton\Exception\SingletonException
     * @return bool
     */
    public function process(Message $message): bool
    {
        if (! $message instanceof MailerMessage) {
            throw new InvalidArgumentException('The given message is not compatible', E_USER_NOTICE);
        }
        $mailer = Mailer::getInstance('smtp');
        foreach ($message->to ?? [] as $to) {
            $mailer->addTo($to['email'], $to['name']);
            $this->logDebug(" [*] Added receiver {$to['email']} ({$to['name']})");
        }
        foreach ($message->cc ?? [] as $cc) {
            $mailer->addCc($cc['email'], $cc['name']);
            $this->logDebug(" [*] Added CarbonCopy receiver {$cc['email']} ({$cc['name']})");
        }
        foreach ($message->bcc ?? [] as $bcc) {
            $mailer->addCc($bcc['email'], $bcc['name']);
            $this->logDebug(" [*] Added Blind CarbonCopy receiver {$bcc['email']} ({$bcc['name']})");
        }
        $mailer->setFrom('no-reply@nox.kiwi', 'Default sender');
        $this->logDebug(" [*] Added the sender as Blind CarbonCopy receiver no-reply@nox.kiwi (Default sender)");
        $mailer->addTo('no-reply@nox.kiwi', 'copy to me');
        $mailer->setSubject($message->subject);
        $mailer->setHtml($message->isHtml);
        $this->logDebug(" [*] Set subject to {$message->subject}");
        $mailer->setBody($message->body);
        $this->logDebug(" [*] Set body to {$message->body}");
        if (! empty($message->attachments)) {
            foreach ($message->attachments as $attachment) {
                $this->logDebug(" [*] Added attachment {$attachment}");
            }
        }
        $this->logNotice(" [*] Now sending email utilizing " . get_class($mailer));
        $start   = microtime(true);
        $ret     = $mailer->send();
        $elapsed = (microtime(true) - $start) * 1000;
        $this->logNotice(" [*] Finished sending with result" . print_r($ret, true));
        $this->logDebug(" [*] - Sending email elapsed {$elapsed}ms.");

        return $ret;
    }
}

