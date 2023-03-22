<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230322155933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD siret VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD firstname VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD address VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD postal_code VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE commande DROP siret');
        $this->addSql('ALTER TABLE commande DROP name');
        $this->addSql('ALTER TABLE commande DROP firstname');
        $this->addSql('ALTER TABLE commande DROP address');
        $this->addSql('ALTER TABLE commande DROP postal_code');
    }
}
