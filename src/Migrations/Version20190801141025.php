<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190801141025 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_file (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, item_id INT DEFAULT NULL, item_request_id INT DEFAULT NULL, code VARCHAR(30) NOT NULL, created_for VARCHAR(30) NOT NULL, main TINYINT(1) NOT NULL, name VARCHAR(255) NOT NULL, extension VARCHAR(8) NOT NULL, title VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, type VARCHAR(20) NOT NULL, created_at DATETIME NOT NULL, modified_at DATETIME DEFAULT NULL, enabled TINYINT(1) NOT NULL, enabled_at DATETIME DEFAULT NULL, disabled_at DATETIME DEFAULT NULL, INDEX IDX_F61E7AD9A76ED395 (user_id), INDEX IDX_F61E7AD9126F525E (item_id), INDEX IDX_F61E7AD9FFCF90AF (item_request_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_file ADD CONSTRAINT FK_F61E7AD9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_file ADD CONSTRAINT FK_F61E7AD9126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE user_file ADD CONSTRAINT FK_F61E7AD9FFCF90AF FOREIGN KEY (item_request_id) REFERENCES item_request (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user_file');
    }
}
