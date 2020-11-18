<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201118173125 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__workplace AS SELECT identifier, address, city, state, country FROM workplace');
        $this->addSql('DROP TABLE workplace');
        $this->addSql('CREATE TABLE workplace (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, address VARCHAR(255) NOT NULL COLLATE BINARY, city VARCHAR(255) NOT NULL COLLATE BINARY, state VARCHAR(255) NOT NULL COLLATE BINARY, country VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO workplace (id, address, city, state, country) SELECT identifier, address, city, state, country FROM __temp__workplace');
        $this->addSql('DROP TABLE __temp__workplace');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__workplace AS SELECT id, address, city, state, country FROM workplace');
        $this->addSql('DROP TABLE workplace');
        $this->addSql('CREATE TABLE workplace (identifier INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, state VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO workplace (identifier, address, city, state, country) SELECT id, address, city, state, country FROM __temp__workplace');
        $this->addSql('DROP TABLE __temp__workplace');
    }
}
