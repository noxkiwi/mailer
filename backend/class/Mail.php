<?php declare(strict_types = 1);
namespace noxkiwi\mailer;

use noxkiwi\core\Datacontainer\DatacontainerInterface;
use noxkiwi\core\Helper\FrontendHelper;

/**
 * I am an arbitrary mail.
 *
 * @package      noxkiwi\mailer
 * @author       Jan Nox <jan@nox.kiwi>
 * @license      https://nox.kiwi/license
 * @copyright    2020 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
class Mail
{
    /** @var string */
    protected string $template;
    /** @var \noxkiwi\mailer\Mailer I am the mailer. */
    private Mailer $mailer;
    /** @var \noxkiwi\core\Datacontainer\DatacontainerInterface I am the data container for the email. */
    private DatacontainerInterface $dataContainer;

    /**
     * @param \noxkiwi\core\Datacontainer\DatacontainerInterface $dataContainer
     */
    public function __construct(DatacontainerInterface $dataContainer)
    {
        $this->dataContainer = $dataContainer;
    }

    /**
     * I will send the mail.
     * @return bool
     */
    public function send(): bool
    {
        $this->mailer->setBody(FrontendHelper::parseFile($this->template, $this->dataContainer));

        return $this->mailer->send();
    }
}
