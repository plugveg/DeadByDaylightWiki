<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220223163138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE survivors ADD survivor_perk2_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE survivors ADD CONSTRAINT FK_20E306072717E099 FOREIGN KEY (survivor_perk2_id) REFERENCES perks (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_20E306072717E099 ON survivors (survivor_perk2_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE survivors DROP FOREIGN KEY FK_20E306072717E099');
        $this->addSql('DROP INDEX UNIQ_20E306072717E099 ON survivors');
        $this->addSql('ALTER TABLE survivors DROP survivor_perk2_id');
    }
}
