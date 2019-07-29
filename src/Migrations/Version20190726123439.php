<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190726123439 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE item_request_answer DROP FOREIGN KEY FK_80692E2A97984484');
        $this->addSql('ALTER TABLE item_request_answer DROP FOREIGN KEY FK_80692E2AED442CF4');
        $this->addSql('DROP INDEX IDX_80692E2AED442CF4 ON item_request_answer');
        $this->addSql('DROP INDEX IDX_80692E2A97984484 ON item_request_answer');
        $this->addSql('ALTER TABLE item_request_answer DROP potential_renter_id, DROP requester_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE item_request_answer ADD potential_renter_id INT NOT NULL, ADD requester_id INT NOT NULL');
        $this->addSql('ALTER TABLE item_request_answer ADD CONSTRAINT FK_80692E2A97984484 FOREIGN KEY (potential_renter_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE item_request_answer ADD CONSTRAINT FK_80692E2AED442CF4 FOREIGN KEY (requester_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_80692E2AED442CF4 ON item_request_answer (requester_id)');
        $this->addSql('CREATE INDEX IDX_80692E2A97984484 ON item_request_answer (potential_renter_id)');
    }
}
