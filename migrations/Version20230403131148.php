<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230403131148 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD unit_price DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD total_price DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD tvaprice DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD ttcprice DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD total_tvaprice DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE commande DROP unit_price');
        $this->addSql('ALTER TABLE commande DROP total_price');
        $this->addSql('ALTER TABLE commande DROP tvaprice');
        $this->addSql('ALTER TABLE commande DROP ttcprice');
        $this->addSql('ALTER TABLE commande DROP total_tvaprice');
    }
}
