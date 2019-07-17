<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190717134239 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE rating (id INT AUTO_INCREMENT NOT NULL, rental_id INT NOT NULL, editor_id INT NOT NULL, renter_id INT NOT NULL, tenant_id INT NOT NULL, code VARCHAR(30) NOT NULL, title VARCHAR(255) DEFAULT NULL, comment LONGTEXT DEFAULT NULL, global_rating INT NOT NULL, punctuality_rating INT NOT NULL, item_quality_condition_rating INT NOT NULL, kindness_rating INT NOT NULL, created_at DATETIME NOT NULL, enabled TINYINT(1) DEFAULT NULL, enabled_at DATETIME DEFAULT NULL, disabled_at DATETIME DEFAULT NULL, INDEX IDX_D8892622A7CF2329 (rental_id), INDEX IDX_D88926226995AC4C (editor_id), INDEX IDX_D8892622E289A545 (renter_id), INDEX IDX_D88926229033212A (tenant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622A7CF2329 FOREIGN KEY (rental_id) REFERENCES rental (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D88926226995AC4C FOREIGN KEY (editor_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622E289A545 FOREIGN KEY (renter_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D88926229033212A FOREIGN KEY (tenant_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE item CHANGE code code VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE rental CHANGE code code VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE item_request ADD created_at DATETIME NOT NULL, ADD modified_at DATETIME DEFAULT NULL, CHANGE code code VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE pickup_point CHANGE code code VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE code code VARCHAR(30) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE rating');
        $this->addSql('ALTER TABLE item CHANGE code code VARCHAR(10) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE item_request DROP created_at, DROP modified_at, CHANGE code code VARCHAR(10) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE pickup_point CHANGE code code VARCHAR(10) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE rental CHANGE code code VARCHAR(10) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user CHANGE code code VARCHAR(10) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
