<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190729121623 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE UNIQUE INDEX UNIQ_D889262277153098 ON rating (code)');
        $this->addSql('ALTER TABLE item CHANGE enabled enabled TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1F1B251E989D9B62 ON item (slug)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1F1B251E518597B1 ON item (subtitle)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1F1B251E77153098 ON item (code)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_389B7835E237E06 ON tag (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_389B783989D9B62 ON tag (slug)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1619C27D77153098 ON rental (code)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_30CAA9CB5E237E06 ON item_request (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_30CAA9CB77153098 ON item_request (code)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_30CAA9CB989D9B62 ON item_request (slug)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1467BEE877153098 ON pickup_point (code)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649989D9B62 ON user (slug)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64977153098 ON user (code)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_80692E2A77153098 ON item_request_answer (code)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FA7AEFFB5E237E06 ON attribute (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_60C4016C5E237E06 ON rubric (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_60C4016C989D9B62 ON rubric (slug)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_865F80C05E237E06 ON duration (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_865F80C04D3E69FD ON duration (shortcode)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FE4FBB821D775834 ON attribute_value (value)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FE4FBB82989D9B62 ON attribute_value (slug)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D7943D68989D9B62 ON area (slug)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_64C19C15E237E06 ON category (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_64C19C1989D9B62 ON category (slug)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_D7943D68989D9B62 ON area');
        $this->addSql('DROP INDEX UNIQ_FA7AEFFB5E237E06 ON attribute');
        $this->addSql('DROP INDEX UNIQ_FE4FBB821D775834 ON attribute_value');
        $this->addSql('DROP INDEX UNIQ_FE4FBB82989D9B62 ON attribute_value');
        $this->addSql('DROP INDEX UNIQ_64C19C15E237E06 ON category');
        $this->addSql('DROP INDEX UNIQ_64C19C1989D9B62 ON category');
        $this->addSql('DROP INDEX UNIQ_865F80C05E237E06 ON duration');
        $this->addSql('DROP INDEX UNIQ_865F80C04D3E69FD ON duration');
        $this->addSql('DROP INDEX UNIQ_1F1B251E989D9B62 ON item');
        $this->addSql('DROP INDEX UNIQ_1F1B251E518597B1 ON item');
        $this->addSql('DROP INDEX UNIQ_1F1B251E77153098 ON item');
        $this->addSql('ALTER TABLE item CHANGE enabled enabled TINYINT(1) DEFAULT NULL');
        $this->addSql('DROP INDEX UNIQ_30CAA9CB5E237E06 ON item_request');
        $this->addSql('DROP INDEX UNIQ_30CAA9CB77153098 ON item_request');
        $this->addSql('DROP INDEX UNIQ_30CAA9CB989D9B62 ON item_request');
        $this->addSql('DROP INDEX UNIQ_80692E2A77153098 ON item_request_answer');
        $this->addSql('DROP INDEX UNIQ_1467BEE877153098 ON pickup_point');
        $this->addSql('DROP INDEX UNIQ_D889262277153098 ON rating');
        $this->addSql('DROP INDEX UNIQ_1619C27D77153098 ON rental');
        $this->addSql('DROP INDEX UNIQ_60C4016C5E237E06 ON rubric');
        $this->addSql('DROP INDEX UNIQ_60C4016C989D9B62 ON rubric');
        $this->addSql('DROP INDEX UNIQ_389B7835E237E06 ON tag');
        $this->addSql('DROP INDEX UNIQ_389B783989D9B62 ON tag');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649989D9B62 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D64977153098 ON user');
    }
}
