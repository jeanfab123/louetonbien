<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190725112311 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE item_attribute_value (item_id INT NOT NULL, attribute_value_id INT NOT NULL, INDEX IDX_448E6020126F525E (item_id), INDEX IDX_448E602065A22152 (attribute_value_id), PRIMARY KEY(item_id, attribute_value_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item_attribute_value ADD CONSTRAINT FK_448E6020126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_attribute_value ADD CONSTRAINT FK_448E602065A22152 FOREIGN KEY (attribute_value_id) REFERENCES attribute_value (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE item_attribute_value');
    }
}
