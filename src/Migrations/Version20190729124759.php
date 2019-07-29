<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190729124759 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rating CHANGE enabled enabled TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE message CHANGE deleted deleted TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE item_request CHANGE enabled enabled TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE item_request_answer CHANGE enabled enabled TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE user_unavailable_date CHANGE deleted deleted TINYINT(1) DEFAULT \'0\' NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE item_request CHANGE enabled enabled TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE item_request_answer CHANGE enabled enabled TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE message CHANGE deleted deleted TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE rating CHANGE enabled enabled TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE user_unavailable_date CHANGE deleted deleted TINYINT(1) DEFAULT NULL');
    }
}
