<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221114202315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE music_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE music_style_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE music (id INT NOT NULL, public_identifier VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, file VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE music_music_style (music_id INT NOT NULL, music_style_id INT NOT NULL, PRIMARY KEY(music_id, music_style_id))');
        $this->addSql('CREATE INDEX IDX_FA44AAB1399BBB13 ON music_music_style (music_id)');
        $this->addSql('CREATE INDEX IDX_FA44AAB17DDE3C52 ON music_music_style (music_style_id)');
        $this->addSql('CREATE TABLE music_style (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE music_music_style ADD CONSTRAINT FK_FA44AAB1399BBB13 FOREIGN KEY (music_id) REFERENCES music (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE music_music_style ADD CONSTRAINT FK_FA44AAB17DDE3C52 FOREIGN KEY (music_style_id) REFERENCES music_style (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE music_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE music_style_id_seq CASCADE');
        $this->addSql('ALTER TABLE music_music_style DROP CONSTRAINT FK_FA44AAB1399BBB13');
        $this->addSql('ALTER TABLE music_music_style DROP CONSTRAINT FK_FA44AAB17DDE3C52');
        $this->addSql('DROP TABLE music');
        $this->addSql('DROP TABLE music_music_style');
        $this->addSql('DROP TABLE music_style');
    }
}
