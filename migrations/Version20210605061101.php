<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210605061101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE place ADD country VARCHAR(5) NOT NULL DEFAULT \'FR\'');
        $this->addSql('ALTER TABLE place DROP coutry');
        $this->addSql('ALTER TABLE place ALTER postal_code TYPE VARCHAR(255)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE place ADD coutry VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE place DROP country');
        $this->addSql('ALTER TABLE place ALTER postal_code TYPE VARCHAR(10)');
    }
}
