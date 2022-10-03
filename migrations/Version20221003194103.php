<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221003194103 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE competence (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, nom VARCHAR(50) NOT NULL, decription LONGTEXT NOT NULL, degat INT DEFAULT NULL, stun TINYINT(1) DEFAULT NULL, INDEX IDX_94D4687FC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnage (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, nom VARCHAR(50) NOT NULL, date_naissance DATE NOT NULL, description LONGTEXT NOT NULL, avatar LONGTEXT NOT NULL, niveau INT NOT NULL, experience INT NOT NULL, endurance INT NOT NULL, intelligence INT NOT NULL, agilite INT NOT NULL, vie INT NOT NULL, INDEX IDX_6AEA486DC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, endurance_defaut INT NOT NULL, agilite_defaut INT NOT NULL, intelligence_defaut INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competence ADD CONSTRAINT FK_94D4687FC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486DC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competence DROP FOREIGN KEY FK_94D4687FC54C8C93');
        $this->addSql('ALTER TABLE personnage DROP FOREIGN KEY FK_6AEA486DC54C8C93');
        $this->addSql('DROP TABLE competence');
        $this->addSql('DROP TABLE personnage');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
