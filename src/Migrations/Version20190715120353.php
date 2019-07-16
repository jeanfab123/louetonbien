<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190715120353 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE item ADD code VARCHAR(10) NOT NULL, ADD views_number INT DEFAULT NULL, ADD enabled TINYINT(1) DEFAULT NULL, ADD enabled_at DATETIME DEFAULT NULL, ADD disabled_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD code VARCHAR(10) NOT NULL, ADD state VARCHAR(30) NOT NULL, ADD validated_at DATETIME DEFAULT NULL, ADD suspended_at DATETIME DEFAULT NULL, ADD banned_at DATETIME DEFAULT NULL, ADD closed_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE item DROP code, DROP views_number, DROP enabled, DROP enabled_at, DROP disabled_at');
        $this->addSql('ALTER TABLE user DROP code, DROP state, DROP validated_at, DROP suspended_at, DROP banned_at, DROP closed_at');
    }
}
