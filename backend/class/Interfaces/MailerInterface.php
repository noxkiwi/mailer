<?php declare(strict_types = 1);
namespace noxkiwi\mailer\Interfaces;

use noxkiwi\mailer\Mailer;

/**
 * I am
 *
 * @package      noxkiwi\mailer\Interfaces
 * @author       Jan Nox <jan.nox@pm.me>
 * @license      https://nox.kiwi/license
 * @copyright    2020 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
interface MailerInterface
{
    /**
     * Set the sender of the mail
     *
     * @param string $email
     * @param string $name
     *
     * @return       Mailer
     */
    public function setFrom(string $email, string $name = null): Mailer;

    /**
     * I will set the given $emails as Recipients.
     *
     * @param array $emails
     *
     * @return \noxkiwi\mailer\Mailer
     */
    public function setTo(array $emails): Mailer;

    /**
     * I will set the given $emails as Carbon Copy Recipients.
     *
     * @param array $emails
     *
     * @return \noxkiwi\mailer\Mailer
     */
    public function setCc(array $emails): Mailer;

    /**
     * I will set the given $emails as Blind Carbon Copy Recipients.
     *
     * @param array $emails
     *
     * @return \noxkiwi\mailer\Mailer
     */
    public function setBcc(array $emails): Mailer;

    /**
     * I will set the given $emails as Attachments.
     *
     * @param array $attachments
     *
     * @return \noxkiwi\mailer\Mailer
     */
    public function setAttachments(array $attachments): Mailer;

    /**
     * Add a recipient for the mail
     *
     * @param string $email
     * @param string $name
     *
     * @return       Mailer
     */
    public function addTo(string $email, string $name = null): Mailer;

    /**
     * Add a Carbon Copy recipient to the mail
     *
     * @param string $email
     * @param string $name
     *
     * @return       Mailer
     */
    public function addCc(string $email, string $name = null): Mailer;

    /**
     * Add a Blind Carbon Copy to the mail
     *
     * @param string $email
     * @param string $name
     *
     * @return       Mailer
     */
    public function addBcc(string $email, string $name = null): Mailer;

    /**
     * Attach a file to the App
     *
     * @param string $file
     * @param string $newname
     *
     * @return       Mailer
     */
    public function addAttachment(string $file, string $newname = null): Mailer;

    /**
     * Set HTML true or false
     *
     * @param bool $status
     *
     * @return       \noxkiwi\mailer\Mailer
     */
    public function setHtml(bool $status = true): Mailer;

    /**
     * Set the subject of the mail
     *
     * @param string $subject
     *
     * @return       Mailer
     */
    public function setSubject(string $subject): Mailer;

    /**
     * Set the (html-) Body of the mail
     *
     * @param string $body
     *
     * @return       Mailer
     */
    public function setBody(string $body): Mailer;

    /**
     * Content displayed if the mail Client does not support HTML mails
     *
     * @param string $altbody
     *
     * @return       Mailer
     */
    public function setAltbody(string $altbody): Mailer;

    /**
     * Send the mail
     *
     * @return       bool
     */
    public function send(): bool;

    /**
     * Return an error message
     *
     * @return       Mailer
     */
    public function getError(): Mailer;
}
