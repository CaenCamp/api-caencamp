<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201220093734 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE edition_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE edition_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE edition_mode_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE organization_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE place_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE speaker_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tag_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE talk_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE talk_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE web_site_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE web_site_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE edition (id INT NOT NULL, category_id INT NOT NULL, mode_id INT NOT NULL, place_id INT DEFAULT NULL, sponsor_id INT DEFAULT NULL, organizer_id INT NOT NULL, title VARCHAR(350) NOT NULL, number SMALLINT NOT NULL, short_description VARCHAR(400) NOT NULL, description TEXT DEFAULT NULL, start_date_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_date_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A891181F12469DE2 ON edition (category_id)');
        $this->addSql('CREATE INDEX IDX_A891181F77E5854A ON edition (mode_id)');
        $this->addSql('CREATE INDEX IDX_A891181FDA6A219 ON edition (place_id)');
        $this->addSql('CREATE INDEX IDX_A891181F12F7FB51 ON edition (sponsor_id)');
        $this->addSql('CREATE INDEX IDX_A891181F876C4DDA ON edition (organizer_id)');
        $this->addSql('CREATE TABLE edition_category (id INT NOT NULL, label VARCHAR(50) NOT NULL, description VARCHAR(350) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE edition_mode (id INT NOT NULL, label VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE organization (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE place (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, url VARCHAR(500) DEFAULT NULL, address1 VARCHAR(255) NOT NULL, address2 VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(10) NOT NULL, city VARCHAR(255) NOT NULL, coutry VARCHAR(255) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE speaker (id INT NOT NULL, name VARCHAR(255) NOT NULL, short_biography VARCHAR(400) DEFAULT NULL, biography TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tag (id INT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE talk (id INT NOT NULL, type_id INT NOT NULL, edition_id INT NOT NULL, title VARCHAR(255) NOT NULL, description TEXT NOT NULL, short_description VARCHAR(500) NOT NULL, video VARCHAR(500) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9F24D5BBC54C8C93 ON talk (type_id)');
        $this->addSql('CREATE INDEX IDX_9F24D5BB74281A5E ON talk (edition_id)');
        $this->addSql('CREATE TABLE talk_tag (talk_id INT NOT NULL, tag_id INT NOT NULL, PRIMARY KEY(talk_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_9E8BFF4A6F0601D5 ON talk_tag (talk_id)');
        $this->addSql('CREATE INDEX IDX_9E8BFF4ABAD26311 ON talk_tag (tag_id)');
        $this->addSql('CREATE TABLE talk_speaker (talk_id INT NOT NULL, speaker_id INT NOT NULL, PRIMARY KEY(talk_id, speaker_id))');
        $this->addSql('CREATE INDEX IDX_B2C12BEE6F0601D5 ON talk_speaker (talk_id)');
        $this->addSql('CREATE INDEX IDX_B2C12BEED04A0F27 ON talk_speaker (speaker_id)');
        $this->addSql('CREATE TABLE talk_type (id INT NOT NULL, label VARCHAR(50) NOT NULL, description VARCHAR(500) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE web_site (id INT NOT NULL, type_id INT NOT NULL, speaker_id INT DEFAULT NULL, url VARCHAR(500) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AD410411C54C8C93 ON web_site (type_id)');
        $this->addSql('CREATE INDEX IDX_AD410411D04A0F27 ON web_site (speaker_id)');
        $this->addSql('CREATE TABLE web_site_type (id INT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE edition ADD CONSTRAINT FK_A891181F12469DE2 FOREIGN KEY (category_id) REFERENCES edition_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE edition ADD CONSTRAINT FK_A891181F77E5854A FOREIGN KEY (mode_id) REFERENCES edition_mode (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE edition ADD CONSTRAINT FK_A891181FDA6A219 FOREIGN KEY (place_id) REFERENCES place (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE edition ADD CONSTRAINT FK_A891181F12F7FB51 FOREIGN KEY (sponsor_id) REFERENCES organization (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE edition ADD CONSTRAINT FK_A891181F876C4DDA FOREIGN KEY (organizer_id) REFERENCES organization (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE talk ADD CONSTRAINT FK_9F24D5BBC54C8C93 FOREIGN KEY (type_id) REFERENCES talk_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE talk ADD CONSTRAINT FK_9F24D5BB74281A5E FOREIGN KEY (edition_id) REFERENCES edition (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE talk_tag ADD CONSTRAINT FK_9E8BFF4A6F0601D5 FOREIGN KEY (talk_id) REFERENCES talk (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE talk_tag ADD CONSTRAINT FK_9E8BFF4ABAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE talk_speaker ADD CONSTRAINT FK_B2C12BEE6F0601D5 FOREIGN KEY (talk_id) REFERENCES talk (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE talk_speaker ADD CONSTRAINT FK_B2C12BEED04A0F27 FOREIGN KEY (speaker_id) REFERENCES speaker (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE web_site ADD CONSTRAINT FK_AD410411C54C8C93 FOREIGN KEY (type_id) REFERENCES web_site_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE web_site ADD CONSTRAINT FK_AD410411D04A0F27 FOREIGN KEY (speaker_id) REFERENCES speaker (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE talk DROP CONSTRAINT FK_9F24D5BB74281A5E');
        $this->addSql('ALTER TABLE edition DROP CONSTRAINT FK_A891181F12469DE2');
        $this->addSql('ALTER TABLE edition DROP CONSTRAINT FK_A891181F77E5854A');
        $this->addSql('ALTER TABLE edition DROP CONSTRAINT FK_A891181F12F7FB51');
        $this->addSql('ALTER TABLE edition DROP CONSTRAINT FK_A891181F876C4DDA');
        $this->addSql('ALTER TABLE edition DROP CONSTRAINT FK_A891181FDA6A219');
        $this->addSql('ALTER TABLE talk_speaker DROP CONSTRAINT FK_B2C12BEED04A0F27');
        $this->addSql('ALTER TABLE web_site DROP CONSTRAINT FK_AD410411D04A0F27');
        $this->addSql('ALTER TABLE talk_tag DROP CONSTRAINT FK_9E8BFF4ABAD26311');
        $this->addSql('ALTER TABLE talk_tag DROP CONSTRAINT FK_9E8BFF4A6F0601D5');
        $this->addSql('ALTER TABLE talk_speaker DROP CONSTRAINT FK_B2C12BEE6F0601D5');
        $this->addSql('ALTER TABLE talk DROP CONSTRAINT FK_9F24D5BBC54C8C93');
        $this->addSql('ALTER TABLE web_site DROP CONSTRAINT FK_AD410411C54C8C93');
        $this->addSql('DROP SEQUENCE edition_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE edition_category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE edition_mode_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE organization_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE place_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE speaker_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tag_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE talk_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE talk_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE web_site_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE web_site_type_id_seq CASCADE');
        $this->addSql('DROP TABLE edition');
        $this->addSql('DROP TABLE edition_category');
        $this->addSql('DROP TABLE edition_mode');
        $this->addSql('DROP TABLE organization');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE speaker');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE talk');
        $this->addSql('DROP TABLE talk_tag');
        $this->addSql('DROP TABLE talk_speaker');
        $this->addSql('DROP TABLE talk_type');
        $this->addSql('DROP TABLE web_site');
        $this->addSql('DROP TABLE web_site_type');
    }
}
