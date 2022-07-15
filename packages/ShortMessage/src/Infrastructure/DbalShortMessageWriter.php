<?php

declare(strict_types=1);

namespace Messagehub\ShortMessage\Infrastructure;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Types\Types;
use Messagehub\ShortMessage\Application\ShortMessage;
use Messagehub\ShortMessage\Application\ShortMessageWriter;
use Ramsey\Uuid\Uuid as RamseyUuid;

final class DbalShortMessageWriter implements ShortMessageWriter
{
    public function __construct(
        private Connection $connection
    ) {}

    public function add(ShortMessage $shortMessage): void
    {
        $qb = $this->connection->createQueryBuilder();
        $qb->insert('short_message');
        $qb->setValue('uuid', ':uuid');
        $qb->setValue('message_text', ':message_text');
        $qb->setValue('message_author', ':message_author');
        $qb->setValue('message_date', ':message_date');
        $qb->setParameter('uuid', RamseyUuid::fromString($shortMessage->getId()->toString())->getBytes(), Types::BINARY);
        $qb->setParameter('message_text', $shortMessage->getText()->value(), Types::TEXT);
        $qb->setParameter('message_author', $shortMessage->getAuthor()->value(), Types::INTEGER);
        $qb->setParameter('message_date', $shortMessage->getDate()->toString(), Types::STRING);
        $qb->executeQuery();

    }
}
