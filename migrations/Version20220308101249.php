<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220308101249 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE powers ADD power_killer_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE powers ADD CONSTRAINT FK_CD73E6E2C95E5036 FOREIGN KEY (power_killer_id_id) REFERENCES killers (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CD73E6E2C95E5036 ON powers (power_killer_id_id)');
        $this->addSql('ALTER TABLE weapons ADD weapons_killer_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE weapons ADD CONSTRAINT FK_520EBBE11CFD48D3 FOREIGN KEY (weapons_killer_id_id) REFERENCES killers (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_520EBBE11CFD48D3 ON weapons (weapons_killer_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE powers DROP FOREIGN KEY FK_CD73E6E2C95E5036');
        $this->addSql('DROP INDEX UNIQ_CD73E6E2C95E5036 ON powers');
        $this->addSql('ALTER TABLE powers DROP power_killer_id_id');
        $this->addSql('ALTER TABLE weapons DROP FOREIGN KEY FK_520EBBE11CFD48D3');
        $this->addSql('DROP INDEX UNIQ_520EBBE11CFD48D3 ON weapons');
        $this->addSql('ALTER TABLE weapons DROP weapons_killer_id_id');
    }
}
