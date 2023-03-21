<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230321150238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP CONSTRAINT fk_6eeaa67d7294869c');
        $this->addSql('DROP INDEX idx_6eeaa67d7294869c');
        $this->addSql('ALTER TABLE commande ADD articles_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD date_delivery VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD date_start_prod VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD date_end_prod VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD date_start_delivery VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD tracking_number VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD weight VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ALTER created_at DROP NOT NULL');
        $this->addSql('ALTER TABLE commande RENAME COLUMN article_id TO client_id');
        $this->addSql('COMMENT ON COLUMN commande.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D1EBAF6CC FOREIGN KEY (articles_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6EEAA67D19EB6921 ON commande (client_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D1EBAF6CC ON commande (articles_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE commande DROP CONSTRAINT FK_6EEAA67D19EB6921');
        $this->addSql('ALTER TABLE commande DROP CONSTRAINT FK_6EEAA67D1EBAF6CC');
        $this->addSql('DROP INDEX IDX_6EEAA67D19EB6921');
        $this->addSql('DROP INDEX IDX_6EEAA67D1EBAF6CC');
        $this->addSql('ALTER TABLE commande ADD article_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande DROP client_id');
        $this->addSql('ALTER TABLE commande DROP articles_id');
        $this->addSql('ALTER TABLE commande DROP date_delivery');
        $this->addSql('ALTER TABLE commande DROP date_start_prod');
        $this->addSql('ALTER TABLE commande DROP date_end_prod');
        $this->addSql('ALTER TABLE commande DROP date_start_delivery');
        $this->addSql('ALTER TABLE commande DROP tracking_number');
        $this->addSql('ALTER TABLE commande DROP weight');
        $this->addSql('ALTER TABLE commande DROP updated_at');
        $this->addSql('ALTER TABLE commande ALTER created_at SET NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT fk_6eeaa67d7294869c FOREIGN KEY (article_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_6eeaa67d7294869c ON commande (article_id)');
    }
}
