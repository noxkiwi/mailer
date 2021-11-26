<?php declare(strict_types = 1);
namespace noxkiwi\mailer\Mailer;

use noxkiwi\mailer\Mailer;
use noxkiwi\mailer\Message\MailerMessage;
use noxkiwi\mailer\Queue\MailerQueue;

/**
 * I am the Mailer that sends a mail directly into a Queue.
 *
 * @package      noxkiwi\mailer\Mailer
 * @author       Jan Nox <jan.nox@pm.me>
 * @license      https://nox.kiwi/license
 * @copyright    2020 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
final class QueueMailer extends Mailer
{
    private MailerMessage $message;

    /**
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct();
        $this->message = new MailerMessage();
    }

    /**
     * @inheritDoc
     */
    public function setFrom(string $email, string $name = null): Mailer
    {
        $this->message->from = ['mail' => $email, 'name' => $name];

        return $this;
    }

    public function setTo(array $emails): Mailer
    {
        $this->message->to = $emails;

        return $this;
    }

    public function setCc(array $emails): Mailer
    {
        $this->message->cc = $emails;

        return $this;
    }

    public function setBcc(array $emails): Mailer
    {
        $this->message->bcc = $emails;

        return $this;
    }

    public function setAttachments(array $attachments): Mailer
    {
        $this->message->attachments = $attachments;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addTo(string $email, string $name = null): Mailer
    {
        $this->message->to[] = compact('email', 'name');

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addCc(string $email, string $name = null): Mailer
    {
        $this->message->cc[] = compact('email', 'name');

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addBcc(string $email, string $name = null): Mailer
    {
        $this->message->bcc[] = compact('email', 'name');

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addAttachment(string $file, string $newname = null): Mailer
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setHtml(bool $status = true): Mailer
    {
        $this->message->isHtml = $status;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setSubject(string $subject): Mailer
    {
        $this->message->subject = $subject;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setBody(string $body): Mailer
    {
        $this->message->body = $body;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function send(): bool
    {
        $queue = new MailerQueue('Mailer');
        $queue->add($this->message);

        return true;
    }

    /**
     * @inheritDoc
     */
    public function getError(): Mailer
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setAltbody(string $altbody): Mailer
    {
        return $this;
    }
}
