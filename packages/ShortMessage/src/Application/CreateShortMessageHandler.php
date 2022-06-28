<?php declare(strict_types=1);

namespace Messagehub\ShortMessage\Application;
use Messagehub\Common\Application\HandlerResponse\Error\Error;

final class CreateShortMessageHandler
{

    public function __construct(
        private CreateShortMessageValidator $shortMessageValidator,
    ) {}

    public function handle(CreateShortMessage $command)
    {
        if ($this->shortMessageValidator->hasValidationErrors()) {
            foreach ($this->shortMessageValidator->getValidationErrors() as $errorMessage) {
                return Error::fromValidator($errorMessage);
            }
        }

        // TODO Replace ORM Entity with Dbal Writer
    }
}