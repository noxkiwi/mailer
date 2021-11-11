<?php declare(strict_types = 1);
namespace noxkiwi\mailer;

use noxkiwi\mailer\Interfaces\MailerInterface;
use noxkiwi\singleton\Singleton;

/**
 * I am the basic mailer class.
 *
 * @package      noxkiwi\mailer
 * @author       Jan Nox <jan@nox.kiwi>
 * @license      https://nox.kiwi/license
 * @copyright    2016 - 2018 noxkiwi
 * @version      1.0.1
 * @link         https://nox.kiwi/
 */
abstract class Mailer extends Singleton implements MailerInterface
{
    protected const USE_DRIVER = true;

    /** @var \noxkiwi\mailer\Mailer Contains the class that represents the Client library's main class. */
    protected $client;
}
