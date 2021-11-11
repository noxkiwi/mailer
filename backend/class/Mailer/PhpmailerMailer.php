<?php declare(strict_types = 1);
namespace noxkiwi\mailer\Mailer;

use noxkiwi\mailer\Mailer;
use function trait_exists;

/**
 * I am
 *
 * @package      noxkiwi\mailer\Mailer
 * @author       Jan Nox <jan@nox.kiwi>
 * @license      https://nox.kiwi/license
 * @copyright    2020 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
final class PhpmailerMailer extends Mailer
{
    /**
     * Creates the instance using the given $config
     *
     * @param array $config
     *
     */
    protected function __construct(array $config)
    {
        parent::__construct();
        $this->init();
        // Use SMTP Mode
        $this->client->IsSMTP();
        $this->client->Host       = $config['host'];
        $this->client->Port       = $config['port'];
        $this->client->SMTPSecure = $config['secure'];
        $this->client->CharSet    = 'UTF-8';
        $this->client->XMailer    = 'Core Mailer';
        $this->client->SMTPAuth   = $config['secure'];
        //disable ssl verification
        // http://stackoverflow.com/questions/26827192/phpmailer-ssl3-get-server-certificatecertificate-verify-failed
        $this->client->SMTPOptions = ['ssl' => ['verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true]];
        if ($this->client->SMTPAuth) {
            $this->client->Username = $config['user'];
            $this->client->Password = $config['password'];
        }
    }

    /**
     * I will create the PHPMailer client.
     */
    private function init(): void
    {
        $this->client = new \PHPMailer(true);
    }

    /**
     * {@inheritDoc}
     */
    public function setFrom(string $email, string $name = null): Mailer
    {
        $this->client->setFrom($email, $name ?? $email);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function addAttachment(string $file, string $newname = null): Mailer
    {
        $this->client->addAttachment($file, $newname ?? '');

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setHtml(bool $status = true): Mailer
    {
        $this->client->isHTML($status);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setSubject(string $subject): Mailer
    {
        $this->client->Subject = $subject;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setBody(string $body): Mailer
    {
        $this->client->Body = $body;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setAltbody(string $altbody): Mailer
    {
        $this->client->AltBody = $altbody;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function send(): bool
    {
        return (bool)$this->client->send();
    }

    /**
     * {@inheritDoc}
     */
    public function getError(): Mailer
    {
        return $this->client->ErrorInfo;
    }

    /**
     * @inheritDoc
     */
    public function setTo(array $emails): Mailer
    {
        foreach ($emails as $email) {
            $this->addTo($email['email'], $email['name']);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function addTo(string $email, string $name = null): Mailer
    {
        $this->client->addAddress($email, $name ?? $email);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setCc(array $emails): Mailer
    {
        foreach ($emails as $email) {
            $this->addCc($email['email'], $email['name']);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function addCc(string $email, string $name = null): Mailer
    {
        $this->client->addCC($email, $name ?? $email);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setBcc(array $emails): Mailer
    {
        foreach ($emails as $email) {
            $this->addBcc($email['email'], $email['name']);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function addBcc(string $email, string $name = null): Mailer
    {
        $this->client->addBCC($email, $name ?? $email);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setAttachments(array $attachments): Mailer
    {
        #     $this->message->attachments = $attachments;
        return $this;
    }
}
