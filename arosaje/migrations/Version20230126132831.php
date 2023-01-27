<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230126132831 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, plante_id INT NOT NULL, texte_commentaire VARCHAR(5096) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_67F068BCA76ED395 (user_id), INDEX IDX_67F068BC177B16E8 (plante_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images_plante (id INT AUTO_INCREMENT NOT NULL, plante_id INT NOT NULL, lien_image VARCHAR(150) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_9380AE01177B16E8 (plante_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plante (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, type_plante_id INT NOT NULL, nom_plante VARCHAR(100) NOT NULL, description_plante VARCHAR(5096) NOT NULL, image_plante VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_517A6947A76ED395 (user_id), INDEX IDX_517A6947A3BD57F8 (type_plante_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_plante (id INT AUTO_INCREMENT NOT NULL, nom_type VARCHAR(150) NOT NULL, descriptif_type VARCHAR(5096) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom_user VARCHAR(100) NOT NULL, prenom_user VARCHAR(100) NOT NULL, mail_user VARCHAR(100) NOT NULL, phone_user VARCHAR(10) DEFAULT NULL, addr_user VARCHAR(150) DEFAULT NULL, cp_user VARCHAR(5) DEFAULT NULL, ville_user VARCHAR(100) DEFAULT NULL, date_naissance DATE NOT NULL, profil_pic VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC177B16E8 FOREIGN KEY (plante_id) REFERENCES plante (id)');
        $this->addSql('ALTER TABLE images_plante ADD CONSTRAINT FK_9380AE01177B16E8 FOREIGN KEY (plante_id) REFERENCES plante (id)');
        $this->addSql('ALTER TABLE plante ADD CONSTRAINT FK_517A6947A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE plante ADD CONSTRAINT FK_517A6947A3BD57F8 FOREIGN KEY (type_plante_id) REFERENCES type_plante (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCA76ED395');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC177B16E8');
        $this->addSql('ALTER TABLE images_plante DROP FOREIGN KEY FK_9380AE01177B16E8');
        $this->addSql('ALTER TABLE plante DROP FOREIGN KEY FK_517A6947A76ED395');
        $this->addSql('ALTER TABLE plante DROP FOREIGN KEY FK_517A6947A3BD57F8');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE images_plante');
        $this->addSql('DROP TABLE plante');
        $this->addSql('DROP TABLE type_plante');
        $this->addSql('DROP TABLE user');
    }
}
