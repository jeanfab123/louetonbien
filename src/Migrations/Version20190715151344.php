<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190715151344 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE item_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, code VARCHAR(10) NOT NULL, slug VARCHAR(255) NOT NULL, enabled TINYINT(1) DEFAULT NULL, enabled_at DATETIME DEFAULT NULL, disabled_at DATETIME DEFAULT NULL, INDEX IDX_30CAA9CBA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_request_category (item_request_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_CB0BFAFBFFCF90AF (item_request_id), INDEX IDX_CB0BFAFB12469DE2 (category_id), PRIMARY KEY(item_request_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_request_rubric (item_request_id INT NOT NULL, rubric_id INT NOT NULL, INDEX IDX_3A706563FFCF90AF (item_request_id), INDEX IDX_3A706563A29EC0FC (rubric_id), PRIMARY KEY(item_request_id, rubric_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_request_area (item_request_id INT NOT NULL, area_id INT NOT NULL, INDEX IDX_6769E753FFCF90AF (item_request_id), INDEX IDX_6769E753BD0F409C (area_id), PRIMARY KEY(item_request_id, area_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item_request ADD CONSTRAINT FK_30CAA9CBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE item_request_category ADD CONSTRAINT FK_CB0BFAFBFFCF90AF FOREIGN KEY (item_request_id) REFERENCES item_request (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_request_category ADD CONSTRAINT FK_CB0BFAFB12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_request_rubric ADD CONSTRAINT FK_3A706563FFCF90AF FOREIGN KEY (item_request_id) REFERENCES item_request (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_request_rubric ADD CONSTRAINT FK_3A706563A29EC0FC FOREIGN KEY (rubric_id) REFERENCES rubric (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_request_area ADD CONSTRAINT FK_6769E753FFCF90AF FOREIGN KEY (item_request_id) REFERENCES item_request (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_request_area ADD CONSTRAINT FK_6769E753BD0F409C FOREIGN KEY (area_id) REFERENCES area (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE item_request_category DROP FOREIGN KEY FK_CB0BFAFBFFCF90AF');
        $this->addSql('ALTER TABLE item_request_rubric DROP FOREIGN KEY FK_3A706563FFCF90AF');
        $this->addSql('ALTER TABLE item_request_area DROP FOREIGN KEY FK_6769E753FFCF90AF');
        $this->addSql('DROP TABLE item_request');
        $this->addSql('DROP TABLE item_request_category');
        $this->addSql('DROP TABLE item_request_rubric');
        $this->addSql('DROP TABLE item_request_area');
    }
}
