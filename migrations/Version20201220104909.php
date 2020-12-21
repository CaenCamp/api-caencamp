<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201220104909 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE edition ADD slug VARCHAR(350) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A891181F989D9B62 ON edition (slug)');
        $this->addSql('ALTER TABLE organization ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C1EE637C989D9B62 ON organization (slug)');
        $this->addSql('ALTER TABLE place ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_741D53CD989D9B62 ON place (slug)');
        $this->addSql('ALTER TABLE speaker ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7B85DB61989D9B62 ON speaker (slug)');
        $this->addSql('ALTER TABLE tag ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_389B783989D9B62 ON tag (slug)');
        $this->addSql('ALTER TABLE talk ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9F24D5BB989D9B62 ON talk (slug)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX UNIQ_A891181F989D9B62');
        $this->addSql('ALTER TABLE edition DROP slug');
        $this->addSql('DROP INDEX UNIQ_741D53CD989D9B62');
        $this->addSql('ALTER TABLE place DROP slug');
        $this->addSql('DROP INDEX UNIQ_C1EE637C989D9B62');
        $this->addSql('ALTER TABLE organization DROP slug');
        $this->addSql('DROP INDEX UNIQ_9F24D5BB989D9B62');
        $this->addSql('ALTER TABLE talk DROP slug');
        $this->addSql('DROP INDEX UNIQ_389B783989D9B62');
        $this->addSql('ALTER TABLE tag DROP slug');
        $this->addSql('DROP INDEX UNIQ_7B85DB61989D9B62');
        $this->addSql('ALTER TABLE speaker DROP slug');
    }
}
