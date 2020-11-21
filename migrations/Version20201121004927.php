<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201121004927 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (username VARCHAR(255) NOT NULL, password VARCHAR(60) NOT NULL, token VARCHAR(64) DEFAULT NULL, PRIMARY KEY(username))');
        $this->addSql('DROP INDEX UNIQ_FBD8E0F8AC25FB46');
        $this->addSql('CREATE TEMPORARY TABLE __temp__job AS SELECT id, workplace_id, title, description, status, salary FROM job');
        $this->addSql('DROP TABLE job');
        $this->addSql('CREATE TABLE job (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, workplace_id INTEGER DEFAULT NULL, title VARCHAR(256) NOT NULL COLLATE BINARY, status BOOLEAN NOT NULL, salary DOUBLE PRECISION DEFAULT NULL, description CLOB NOT NULL, CONSTRAINT FK_FBD8E0F8AC25FB46 FOREIGN KEY (workplace_id) REFERENCES workplace (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO job (id, workplace_id, title, description, status, salary) SELECT id, workplace_id, title, description, status, salary FROM __temp__job');
        $this->addSql('DROP TABLE __temp__job');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FBD8E0F8AC25FB46 ON job (workplace_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX UNIQ_FBD8E0F8AC25FB46');
        $this->addSql('CREATE TEMPORARY TABLE __temp__job AS SELECT id, workplace_id, title, description, status, salary FROM job');
        $this->addSql('DROP TABLE job');
        $this->addSql('CREATE TABLE job (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, workplace_id INTEGER DEFAULT NULL, title VARCHAR(256) NOT NULL, status BOOLEAN NOT NULL, salary DOUBLE PRECISION DEFAULT NULL, description CLOB NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO job (id, workplace_id, title, description, status, salary) SELECT id, workplace_id, title, description, status, salary FROM __temp__job');
        $this->addSql('DROP TABLE __temp__job');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FBD8E0F8AC25FB46 ON job (workplace_id)');
    }
}
