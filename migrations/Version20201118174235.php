<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201118174235 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE job (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, workplace_id INTEGER DEFAULT NULL, title VARCHAR(256) NOT NULL, description CLOB NOT NULL, status BOOLEAN NOT NULL, salary DOUBLE PRECISION DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FBD8E0F8AC25FB46 ON job (workplace_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE job');
    }
}
