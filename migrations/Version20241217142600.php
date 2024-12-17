<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241217142600 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chambre (id INT AUTO_INCREMENT NOT NULL, foyer_id INT NOT NULL, numero VARCHAR(55) NOT NULL, capacite INT NOT NULL, etat VARCHAR(10) NOT NULL, type_lit VARCHAR(20) NOT NULL, INDEX IDX_C509E4FF2B919A58 (foyer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, discr VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE foyer (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(70) NOT NULL, adresse VARCHAR(250) NOT NULL, genre VARCHAR(10) NOT NULL, gouvernorat VARCHAR(50) NOT NULL, capacite INT NOT NULL, status VARCHAR(20) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resident (id INT NOT NULL, foyer_id INT NOT NULL, date_entree DATE NOT NULL, date_sortie DATE DEFAULT NULL, INDEX IDX_1D03DA062B919A58 (foyer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FF2B919A58 FOREIGN KEY (foyer_id) REFERENCES foyer (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE resident ADD CONSTRAINT FK_1D03DA062B919A58 FOREIGN KEY (foyer_id) REFERENCES foyer (id)');
        $this->addSql('ALTER TABLE resident ADD CONSTRAINT FK_1D03DA06BF396750 FOREIGN KEY (id) REFERENCES etudiant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE demande_selection ADD CONSTRAINT FK_E389F6029B177F54 FOREIGN KEY (chambre_id) REFERENCES chambre (id)');
        $this->addSql('ALTER TABLE demande_selection ADD CONSTRAINT FK_E389F6022B919A58 FOREIGN KEY (foyer_id) REFERENCES foyer (id)');
        $this->addSql('ALTER TABLE personnelle ADD CONSTRAINT FK_8E464E08ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trajet ADD CONSTRAINT FK_2B5BA98C4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_selection DROP FOREIGN KEY FK_E389F6029B177F54');
        $this->addSql('ALTER TABLE demande_selection DROP FOREIGN KEY FK_E389F6022B919A58');
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FF2B919A58');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE resident DROP FOREIGN KEY FK_1D03DA062B919A58');
        $this->addSql('ALTER TABLE resident DROP FOREIGN KEY FK_1D03DA06BF396750');
        $this->addSql('DROP TABLE chambre');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE foyer');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE resident');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE personnelle DROP FOREIGN KEY FK_8E464E08ED5CA9E6');
        $this->addSql('ALTER TABLE trajet DROP FOREIGN KEY FK_2B5BA98C4A4A3511');
    }
}
