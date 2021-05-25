<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210525160926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE speaker ADD shortbiography VARCHAR(400) DEFAULT NULL');
        $this->addSql('ALTER TABLE speaker ADD biographyhtml TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE speaker ADD biographymarkdown TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE speaker DROP short_biography');
        $this->addSql('ALTER TABLE speaker DROP biography_html');
        $this->addSql('ALTER TABLE speaker DROP biography_markdown');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE speaker ADD short_biography TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE speaker ADD biography_html TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE speaker ADD biography_markdown TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE speaker DROP shortbiography');
        $this->addSql('ALTER TABLE speaker DROP biographyhtml');
        $this->addSql('ALTER TABLE speaker DROP biographymarkdown');
    }
}
