<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220223162626 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE items (id INT AUTO_INCREMENT NOT NULL, item_name VARCHAR(100) NOT NULL, item_image VARCHAR(255) NOT NULL, item_description LONGTEXT DEFAULT NULL, item_rarety VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE perks (id INT AUTO_INCREMENT NOT NULL, perk_survivor_id INT DEFAULT NULL, perk_name VARCHAR(255) NOT NULL, perk_image VARCHAR(255) NOT NULL, perk_explanation LONGTEXT DEFAULT NULL, INDEX IDX_2B783E37AD7BAE65 (perk_survivor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE powers (id INT AUTO_INCREMENT NOT NULL, power_name VARCHAR(100) NOT NULL, power_image VARCHAR(255) NOT NULL, power_description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE survivors (id INT AUTO_INCREMENT NOT NULL, survivor_name VARCHAR(100) NOT NULL, survivor_history LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE perks ADD CONSTRAINT FK_2B783E37AD7BAE65 FOREIGN KEY (perk_survivor_id) REFERENCES survivors (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE perks DROP FOREIGN KEY FK_2B783E37AD7BAE65');
        $this->addSql('DROP TABLE items');
        $this->addSql('DROP TABLE perks');
        $this->addSql('DROP TABLE powers');
        $this->addSql('DROP TABLE survivors');
    }
}
