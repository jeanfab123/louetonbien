<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190715094728 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE item_withdrawal_point DROP FOREIGN KEY FK_9ECC217FB84AC679');
        $this->addSql('ALTER TABLE withdrawal_point_day_hour DROP FOREIGN KEY FK_CA570717B84AC679');
        $this->addSql('CREATE TABLE item_pickup_point (item_id INT NOT NULL, pickup_point_id INT NOT NULL, INDEX IDX_DB3D4329126F525E (item_id), INDEX IDX_DB3D4329682033F1 (pickup_point_id), PRIMARY KEY(item_id, pickup_point_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pickup_point_day_hour (id INT AUTO_INCREMENT NOT NULL, pickup_point_id INT NOT NULL, day SMALLINT NOT NULL, begin VARCHAR(5) NOT NULL, end VARCHAR(5) NOT NULL, INDEX IDX_61726CD8682033F1 (pickup_point_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pickup_point (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(70) NOT NULL, address LONGTEXT NOT NULL, zipcode VARCHAR(10) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, further_information LONGTEXT DEFAULT NULL, INDEX IDX_1467BEE8A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item_pickup_point ADD CONSTRAINT FK_DB3D4329126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_pickup_point ADD CONSTRAINT FK_DB3D4329682033F1 FOREIGN KEY (pickup_point_id) REFERENCES pickup_point (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pickup_point_day_hour ADD CONSTRAINT FK_61726CD8682033F1 FOREIGN KEY (pickup_point_id) REFERENCES pickup_point (id)');
        $this->addSql('ALTER TABLE pickup_point ADD CONSTRAINT FK_1467BEE8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE item_withdrawal_point');
        $this->addSql('DROP TABLE withdrawal_point');
        $this->addSql('DROP TABLE withdrawal_point_day_hour');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE item_pickup_point DROP FOREIGN KEY FK_DB3D4329682033F1');
        $this->addSql('ALTER TABLE pickup_point_day_hour DROP FOREIGN KEY FK_61726CD8682033F1');
        $this->addSql('CREATE TABLE item_withdrawal_point (item_id INT NOT NULL, withdrawal_point_id INT NOT NULL, INDEX IDX_9ECC217FB84AC679 (withdrawal_point_id), INDEX IDX_9ECC217F126F525E (item_id), PRIMARY KEY(item_id, withdrawal_point_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE withdrawal_point (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(70) NOT NULL COLLATE utf8mb4_unicode_ci, address LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, zipcode VARCHAR(10) NOT NULL COLLATE utf8mb4_unicode_ci, city VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, country VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, further_information LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_A6AE2260A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE withdrawal_point_day_hour (id INT AUTO_INCREMENT NOT NULL, withdrawal_point_id INT NOT NULL, day SMALLINT NOT NULL, begin VARCHAR(5) NOT NULL COLLATE utf8mb4_unicode_ci, end VARCHAR(5) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_CA570717B84AC679 (withdrawal_point_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE item_withdrawal_point ADD CONSTRAINT FK_9ECC217F126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_withdrawal_point ADD CONSTRAINT FK_9ECC217FB84AC679 FOREIGN KEY (withdrawal_point_id) REFERENCES withdrawal_point (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE withdrawal_point ADD CONSTRAINT FK_A6AE2260A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE withdrawal_point_day_hour ADD CONSTRAINT FK_CA570717B84AC679 FOREIGN KEY (withdrawal_point_id) REFERENCES withdrawal_point (id)');
        $this->addSql('DROP TABLE item_pickup_point');
        $this->addSql('DROP TABLE pickup_point_day_hour');
        $this->addSql('DROP TABLE pickup_point');
    }
}
