<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190726095919 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE item_request_answer (id INT AUTO_INCREMENT NOT NULL, item_request_id INT NOT NULL, item_id INT NOT NULL, potential_renter_id INT NOT NULL, requester_id INT NOT NULL, created_at DATETIME NOT NULL, code VARCHAR(30) NOT NULL, modified_at DATETIME DEFAULT NULL, disabled TINYINT(1) NOT NULL, disabled_at DATETIME DEFAULT NULL, INDEX IDX_80692E2AFFCF90AF (item_request_id), INDEX IDX_80692E2A126F525E (item_id), INDEX IDX_80692E2A97984484 (potential_renter_id), INDEX IDX_80692E2AED442CF4 (requester_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item_request_answer ADD CONSTRAINT FK_80692E2AFFCF90AF FOREIGN KEY (item_request_id) REFERENCES item_request (id)');
        $this->addSql('ALTER TABLE item_request_answer ADD CONSTRAINT FK_80692E2A126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE item_request_answer ADD CONSTRAINT FK_80692E2A97984484 FOREIGN KEY (potential_renter_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE item_request_answer ADD CONSTRAINT FK_80692E2AED442CF4 FOREIGN KEY (requester_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE item_request_answer');
    }
}
