<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220308100740 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE killers (id INT AUTO_INCREMENT NOT NULL, killer_map_id INT DEFAULT NULL, killer_weapon_id INT DEFAULT NULL, killer_power_id INT DEFAULT NULL, killer_image VARCHAR(255) NOT NULL, killer_name VARCHAR(255) NOT NULL, killer_nickname VARCHAR(255) NOT NULL, killer_speed VARCHAR(255) NOT NULL, killer_summary LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_8C0D793DDBBA078 (killer_map_id), UNIQUE INDEX UNIQ_8C0D793DA41DD970 (killer_weapon_id), UNIQUE INDEX UNIQ_8C0D793D603A2F2A (killer_power_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE killers ADD CONSTRAINT FK_8C0D793DDBBA078 FOREIGN KEY (killer_map_id) REFERENCES maps (id)');
        $this->addSql('ALTER TABLE killers ADD CONSTRAINT FK_8C0D793DA41DD970 FOREIGN KEY (killer_weapon_id) REFERENCES weapons (id)');
        $this->addSql('ALTER TABLE killers ADD CONSTRAINT FK_8C0D793D603A2F2A FOREIGN KEY (killer_power_id) REFERENCES powers (id)');
        $this->addSql('ALTER TABLE perks_killers ADD perk_killer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE perks_killers ADD CONSTRAINT FK_DE718D92F0C5B14C FOREIGN KEY (perk_killer_id) REFERENCES killers (id)');
        $this->addSql('CREATE INDEX IDX_DE718D92F0C5B14C ON perks_killers (perk_killer_id)');
        $this->addSql('ALTER TABLE powers ADD power_explanation LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE perks_killers DROP FOREIGN KEY FK_DE718D92F0C5B14C');
        $this->addSql('DROP TABLE killers');
        $this->addSql('DROP INDEX IDX_DE718D92F0C5B14C ON perks_killers');
        $this->addSql('ALTER TABLE perks_killers DROP perk_killer_id');
        $this->addSql('ALTER TABLE powers DROP power_explanation');
    }
}
