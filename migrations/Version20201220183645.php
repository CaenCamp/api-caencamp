<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201220183645 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE edition ADD description_html TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE edition ADD description_markdown TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE edition ADD published BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE organization ADD description_html TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE organization ADD description_markdown TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE place ADD description_html TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE place ADD description_markdown TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE speaker ADD biography_html TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE speaker ADD biography_markdown TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE talk ADD description_html TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE talk ADD description_markdown TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE talk_type ADD duration_in_minutes INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE talk_type DROP duration_in_minutes');
        $this->addSql('ALTER TABLE edition DROP description_html');
        $this->addSql('ALTER TABLE edition DROP description_markdown');
        $this->addSql('ALTER TABLE edition DROP published');
        $this->addSql('ALTER TABLE organization DROP description_html');
        $this->addSql('ALTER TABLE organization DROP description_markdown');
        $this->addSql('ALTER TABLE place DROP description_html');
        $this->addSql('ALTER TABLE place DROP description_markdown');
        $this->addSql('ALTER TABLE speaker DROP biography_html');
        $this->addSql('ALTER TABLE speaker DROP biography_markdown');
        $this->addSql('ALTER TABLE talk DROP description_html');
        $this->addSql('ALTER TABLE talk DROP description_markdown');
    }
}
