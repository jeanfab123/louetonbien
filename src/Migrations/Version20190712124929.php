<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190712124929 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE item_withdrawal_point (item_id INT NOT NULL, withdrawal_point_id INT NOT NULL, INDEX IDX_9ECC217F126F525E (item_id), INDEX IDX_9ECC217FB84AC679 (withdrawal_point_id), PRIMARY KEY(item_id, withdrawal_point_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE withdrawal_point_day_hour (id INT AUTO_INCREMENT NOT NULL, withdrawal_point_id INT NOT NULL, day SMALLINT NOT NULL, begin VARCHAR(5) NOT NULL, end VARCHAR(5) NOT NULL, INDEX IDX_CA570717B84AC679 (withdrawal_point_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item_withdrawal_point ADD CONSTRAINT FK_9ECC217F126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_withdrawal_point ADD CONSTRAINT FK_9ECC217FB84AC679 FOREIGN KEY (withdrawal_point_id) REFERENCES withdrawal_point (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE withdrawal_point_day_hour ADD CONSTRAINT FK_CA570717B84AC679 FOREIGN KEY (withdrawal_point_id) REFERENCES withdrawal_point (id)');
        $this->addSql('ALTER TABLE item ADD subtitle VARCHAR(255) DEFAULT NULL, ADD similar_items_number INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE item_withdrawal_point');
        $this->addSql('DROP TABLE withdrawal_point_day_hour');
        $this->addSql('ALTER TABLE item DROP subtitle, DROP similar_items_number');
    }
}
