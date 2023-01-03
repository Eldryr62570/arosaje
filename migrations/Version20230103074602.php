<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230103074602 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, plante_id INT DEFAULT NULL, titre_commentaire VARCHAR(255) NOT NULL, description_commentaire VARCHAR(255) NOT NULL, INDEX IDX_67F068BCA76ED395 (user_id), INDEX IDX_67F068BC177B16E8 (plante_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plante (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, resume_plante_id INT DEFAULT NULL, adresse_plante VARCHAR(255) NOT NULL, is_exterieur TINYINT(1) NOT NULL, description_plante LONGTEXT DEFAULT NULL, img_plante VARCHAR(255) NOT NULL, INDEX IDX_517A694767B3B43D (users_id), INDEX IDX_517A6947DA02F751 (resume_plante_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resume_plante (id INT AUTO_INCREMENT NOT NULL, nom_resume_plante VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, username VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, photo_user VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC177B16E8 FOREIGN KEY (plante_id) REFERENCES plante (id)');
        $this->addSql('ALTER TABLE plante ADD CONSTRAINT FK_517A694767B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE plante ADD CONSTRAINT FK_517A6947DA02F751 FOREIGN KEY (resume_plante_id) REFERENCES resume_plante (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCA76ED395');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC177B16E8');
        $this->addSql('ALTER TABLE plante DROP FOREIGN KEY FK_517A694767B3B43D');
        $this->addSql('ALTER TABLE plante DROP FOREIGN KEY FK_517A6947DA02F751');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE plante');
        $this->addSql('DROP TABLE resume_plante');
        $this->addSql('DROP TABLE user');
    }
}
