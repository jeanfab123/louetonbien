<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190712144435 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE attribute (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attribute_category (attribute_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_9ACE8331B6E62EFA (attribute_id), INDEX IDX_9ACE833112469DE2 (category_id), PRIMARY KEY(attribute_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attribute_rubric (attribute_id INT NOT NULL, rubric_id INT NOT NULL, INDEX IDX_42252F36B6E62EFA (attribute_id), INDEX IDX_42252F36A29EC0FC (rubric_id), PRIMARY KEY(attribute_id, rubric_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attribute_area (attribute_id INT NOT NULL, area_id INT NOT NULL, INDEX IDX_8C7C99E0B6E62EFA (attribute_id), INDEX IDX_8C7C99E0BD0F409C (area_id), PRIMARY KEY(attribute_id, area_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attribute_value (id INT AUTO_INCREMENT NOT NULL, attribute_id INT NOT NULL, value VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_FE4FBB82B6E62EFA (attribute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attribute_category ADD CONSTRAINT FK_9ACE8331B6E62EFA FOREIGN KEY (attribute_id) REFERENCES attribute (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE attribute_category ADD CONSTRAINT FK_9ACE833112469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE attribute_rubric ADD CONSTRAINT FK_42252F36B6E62EFA FOREIGN KEY (attribute_id) REFERENCES attribute (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE attribute_rubric ADD CONSTRAINT FK_42252F36A29EC0FC FOREIGN KEY (rubric_id) REFERENCES rubric (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE attribute_area ADD CONSTRAINT FK_8C7C99E0B6E62EFA FOREIGN KEY (attribute_id) REFERENCES attribute (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE attribute_area ADD CONSTRAINT FK_8C7C99E0BD0F409C FOREIGN KEY (area_id) REFERENCES area (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE attribute_value ADD CONSTRAINT FK_FE4FBB82B6E62EFA FOREIGN KEY (attribute_id) REFERENCES attribute (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE attribute_category DROP FOREIGN KEY FK_9ACE8331B6E62EFA');
        $this->addSql('ALTER TABLE attribute_rubric DROP FOREIGN KEY FK_42252F36B6E62EFA');
        $this->addSql('ALTER TABLE attribute_area DROP FOREIGN KEY FK_8C7C99E0B6E62EFA');
        $this->addSql('ALTER TABLE attribute_value DROP FOREIGN KEY FK_FE4FBB82B6E62EFA');
        $this->addSql('DROP TABLE attribute');
        $this->addSql('DROP TABLE attribute_category');
        $this->addSql('DROP TABLE attribute_rubric');
        $this->addSql('DROP TABLE attribute_area');
        $this->addSql('DROP TABLE attribute_value');
    }
}
