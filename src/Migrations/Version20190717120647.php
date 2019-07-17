<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190717120647 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE rental (id INT AUTO_INCREMENT NOT NULL, item_id INT NOT NULL, tenant_id INT NOT NULL, pickup_point_id INT NOT NULL, renter_id INT NOT NULL, code VARCHAR(10) NOT NULL, state VARCHAR(30) NOT NULL, validated_at DATETIME DEFAULT NULL, cancelled_at DATETIME DEFAULT NULL, begin_date DATETIME NOT NULL, end_date DATETIME NOT NULL, real_item_name VARCHAR(255) NOT NULL, real_item_description LONGTEXT NOT NULL, real_item_deposit_amount INT NOT NULL, real_item_price DOUBLE PRECISION NOT NULL, real_item_all_prices LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', real_pickup_point LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', created_at DATETIME NOT NULL, modified_at DATETIME DEFAULT NULL, tenant_comment LONGTEXT DEFAULT NULL, INDEX IDX_1619C27D126F525E (item_id), INDEX IDX_1619C27D9033212A (tenant_id), INDEX IDX_1619C27D682033F1 (pickup_point_id), INDEX IDX_1619C27DE289A545 (renter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rental ADD CONSTRAINT FK_1619C27D126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE rental ADD CONSTRAINT FK_1619C27D9033212A FOREIGN KEY (tenant_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rental ADD CONSTRAINT FK_1619C27D682033F1 FOREIGN KEY (pickup_point_id) REFERENCES pickup_point (id)');
        $this->addSql('ALTER TABLE rental ADD CONSTRAINT FK_1619C27DE289A545 FOREIGN KEY (renter_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user CHANGE house_phone fixed_phone VARCHAR(20) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE rental');
        $this->addSql('ALTER TABLE user CHANGE fixed_phone house_phone VARCHAR(20) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
