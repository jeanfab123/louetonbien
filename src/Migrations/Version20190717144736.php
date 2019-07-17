<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190717144736 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_unavailable_date (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, item_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, message LONGTEXT DEFAULT NULL, begin_date DATETIME NOT NULL, end_date DATETIME NOT NULL, created_at DATETIME NOT NULL, modified_at DATETIME DEFAULT NULL, deleted TINYINT(1) DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_3FCAA116A76ED395 (user_id), INDEX IDX_3FCAA116126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_unavailable_date ADD CONSTRAINT FK_3FCAA116A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_unavailable_date ADD CONSTRAINT FK_3FCAA116126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user_unavailable_date');
    }
}
