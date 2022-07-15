<?php declare(strict_types=1);

namespace Messagehub\ShortMessage\Infrastructure;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Types\Types;
use Messagehub\ShortMessage\Application\ShortMessage;
use Messagehub\ShortMessage\Application\ShortMessageReader;
use Messagehub\ShortMessage\Types\ShortMessageAuthor;
use Messagehub\ShortMessage\Types\ShortMessageDate;
use Messagehub\ShortMessage\Types\ShortMessageId;
use Messagehub\ShortMessage\Types\ShortMessageText;

final class DbalShortMessageReader implements ShortMessageReader
{
    public function __construct(
        private Connection $connection
    ) {}

    public function findAll(): ?array
    {
        $qb = $this->connection->createQueryBuilder();
        $qb->select('*');
        $qb->from('short_message');
        $rows = $qb->executeQuery()->fetchAllAssociative();
        if (!$rows) {
            return null;
        }
        return $rows;
    }
    public function findById(ShortMessageId $uuid): ?ShortMessage
    {
        $qb = $this->connection->createQueryBuilder();
        $qb->select('*');
        $qb->from('short_message');
        $qb->where('uuid', ':uuid');
        $qb->setParameter('uuid', $uuid, Types::STRING);
        $row = $qb->executeQuery()->fetchAssociative();
        if (!$row) {
            return null;
        }
        return $this->generateShortMessageFromData($row['uuid'], $row['message_text'], $row['message_author'], $row['message_date']);
    }

    private function generateShortMessageFromData($id, $message_text, $message_author, $message_date): ShortMessage
    {
        return new ShortMessage(
            ShortMessageId::fromString($id),
            ShortMessageText::fromString($message_text),
            ShortMessageAuthor::fromString($message_author),
            ShortMessageDate::fromDateTimeImmutable(new \DateTimeImmutable($message_date))
        );
    }
}