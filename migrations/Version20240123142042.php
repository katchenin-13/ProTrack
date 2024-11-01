<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240123142042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE _admin_employe (id INT AUTO_INCREMENT NOT NULL, fonction_id INT NOT NULL, entreprise_id INT DEFAULT NULL, nom VARCHAR(25) NOT NULL, prenom VARCHAR(100) NOT NULL, contact VARCHAR(50) NOT NULL, adresse_mail VARCHAR(255) NOT NULL, contacts VARCHAR(255) DEFAULT NULL, genre TINYINT(1) NOT NULL, INDEX IDX_9368111E57889920 (fonction_id), INDEX IDX_9368111EA4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE _admin_param_civilite (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(15) NOT NULL, code VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE _admin_param_config_app (id INT AUTO_INCREMENT NOT NULL, logo_id INT DEFAULT NULL, favicon_id INT DEFAULT NULL, image_login_id INT DEFAULT NULL, logo_login_id INT DEFAULT NULL, entreprise_id INT DEFAULT NULL, main_color_admin VARCHAR(255) NOT NULL, default_color_admin VARCHAR(255) NOT NULL, main_color_login VARCHAR(255) NOT NULL, default_color_login VARCHAR(255) NOT NULL, INDEX IDX_EE0159A1F98F144A (logo_id), INDEX IDX_EE0159A1D78119FD (favicon_id), INDEX IDX_EE0159A1D3426EF5 (image_login_id), INDEX IDX_EE0159A1C83BB8B (logo_login_id), INDEX IDX_EE0159A1A4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE _admin_param_entreprise (id INT AUTO_INCREMENT NOT NULL, logo_id INT DEFAULT NULL, denomination VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, sigle VARCHAR(255) NOT NULL, agrements VARCHAR(255) NOT NULL, situation_geo LONGTEXT NOT NULL, contacts VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, mobile VARCHAR(255) NOT NULL, fax VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, site_web VARCHAR(255) NOT NULL, directeur VARCHAR(255) DEFAULT NULL, date_creation DATETIME DEFAULT NULL, INDEX IDX_3537B201F98F144A (logo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE _admin_param_fichier (id INT AUTO_INCREMENT NOT NULL, size INT NOT NULL, path VARCHAR(255) NOT NULL, alt VARCHAR(255) NOT NULL, date DATETIME NOT NULL, url VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE _admin_param_fonction (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(150) NOT NULL, code VARCHAR(10) NOT NULL, UNIQUE INDEX UNIQ_3A832C6877153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE _admin_param_groupe_module (id INT AUTO_INCREMENT NOT NULL, icon_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, ordre INT NOT NULL, lien VARCHAR(255) NOT NULL, INDEX IDX_CA79B3FF54B9D732 (icon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE _admin_param_icon (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE _admin_param_module (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, ordre INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE _admin_param_module_groupe_permition (id INT AUTO_INCREMENT NOT NULL, permition_id INT DEFAULT NULL, module_id INT DEFAULT NULL, groupe_module_id INT DEFAULT NULL, groupe_user_id INT DEFAULT NULL, ordre INT NOT NULL, ordre_groupe INT NOT NULL, menu_principal TINYINT(1) NOT NULL, INDEX IDX_29EAEA2B806F2303 (permition_id), INDEX IDX_29EAEA2BAFC2B591 (module_id), INDEX IDX_29EAEA2BFF5666A6 (groupe_module_id), INDEX IDX_29EAEA2B610934DB (groupe_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE _admin_param_permition (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE _admin_param_test (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE _admin_user_front_prestataire (id INT NOT NULL, denomination_sociale VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, contact_principal VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE _admin_user_front_utilisateur (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, discr VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1D40D72FF85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE _admin_user_front_utilisateur_simple (id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenoms VARCHAR(255) NOT NULL, contact VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE _admin_user_groupe (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, roles JSON NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE _admin_user_utilisateur (id INT AUTO_INCREMENT NOT NULL, employe_id INT NOT NULL, groupe_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_2264DC41F85E0677 (username), UNIQUE INDEX UNIQ_2264DC411B65292 (employe_id), INDEX IDX_2264DC417A45358C (groupe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE audience (id INT AUTO_INCREMENT NOT NULL, communaute_id INT DEFAULT NULL, utilisateur_id INT DEFAULT NULL, motif LONGTEXT NOT NULL, daterencontre DATETIME NOT NULL, nomchef VARCHAR(255) NOT NULL, numero VARCHAR(255) NOT NULL, email VARCHAR(60) DEFAULT NULL, nombreparticipant INT NOT NULL, justification LONGTEXT DEFAULT NULL, observation TEXT DEFAULT NULL, etat VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_FDCD9418C903E5B8 (communaute_id), INDEX IDX_FDCD9418FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE beneficiaire (id INT AUTO_INCREMENT NOT NULL, communaute_id INT DEFAULT NULL, utilisateur_id INT DEFAULT NULL, don_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, numero VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_B140D802C903E5B8 (communaute_id), INDEX IDX_B140D802FB88E14F (utilisateur_id), INDEX IDX_B140D8027B3C9061 (don_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE calendrier (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, startdate DATETIME NOT NULL, enddate DATETIME NOT NULL, starthour TIME DEFAULT NULL, endhour TIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, libelle VARCHAR(100) NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_497DD634FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE communaute (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, localite_id INT DEFAULT NULL, utilisateur_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, nbestmember INT NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_21C94799BCF5E72D (categorie_id), INDEX IDX_21C94799924DD2B5 (localite_id), INDEX IDX_21C94799FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, communaute_id INT DEFAULT NULL, utilisateur_id INT DEFAULT NULL, nom VARCHAR(60) NOT NULL, fonction VARCHAR(100) NOT NULL, email VARCHAR(60) DEFAULT NULL, numero VARCHAR(255) NOT NULL, observation TEXT DEFAULT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_4C62E638C903E5B8 (communaute_id), INDEX IDX_4C62E638FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demande (id INT AUTO_INCREMENT NOT NULL, communaute_id INT DEFAULT NULL, utilisateur_id INT DEFAULT NULL, motif TEXT NOT NULL, daterencontre DATETIME NOT NULL, nom VARCHAR(255) NOT NULL, lieu_habitation VARCHAR(100) NOT NULL, numero VARCHAR(16) NOT NULL, justification LONGTEXT DEFAULT NULL, etat VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_2694D7A5C903E5B8 (communaute_id), INDEX IDX_2694D7A5FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE don (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, communaute_id INT NOT NULL, dateremise DATETIME NOT NULL, remispar VARCHAR(60) NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, nom VARCHAR(255) NOT NULL, numero VARCHAR(16) NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_F8F081D9FB88E14F (utilisateur_id), INDEX IDX_F8F081D9C903E5B8 (communaute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emailpf (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, communaute_id INT DEFAULT NULL, libelle VARCHAR(100) NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_D8D7C913FB88E14F (utilisateur_id), INDEX IDX_D8D7C913C903E5B8 (communaute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, startdate DATETIME NOT NULL, enddate DATETIME NOT NULL, starthour TIME DEFAULT NULL, endhour TIME DEFAULT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_3BAE0AA7FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fieldon (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, don_id INT DEFAULT NULL, qte INT DEFAULT NULL, naturedon VARCHAR(255) DEFAULT NULL, motifdon VARCHAR(255) NOT NULL, montantdon DOUBLE PRECISION NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, typedonsfiel VARCHAR(255) NOT NULL, INDEX IDX_7D62107EFB88E14F (utilisateur_id), INDEX IDX_7D62107E7B3C9061 (don_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fielpromesse (id INT AUTO_INCREMENT NOT NULL, promesse_id INT NOT NULL, utilisateur_id INT DEFAULT NULL, qte INT DEFAULT NULL, nature VARCHAR(255) DEFAULT NULL, motif VARCHAR(255) NOT NULL, montant DOUBLE PRECISION NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, etat VARCHAR(255) NOT NULL, typepromesse VARCHAR(255) NOT NULL, INDEX IDX_36982A85D09FD084 (promesse_id), INDEX IDX_36982A85FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE localite (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_F5D7E4A9FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE missionrapport (id INT AUTO_INCREMENT NOT NULL, communaute_id INT DEFAULT NULL, utilisateur_id INT NOT NULL, employe_id INT DEFAULT NULL, titre_mission VARCHAR(255) NOT NULL, nombrepersonne INT NOT NULL, objectifs LONGTEXT NOT NULL, action LONGTEXT DEFAULT NULL, opportunite LONGTEXT DEFAULT NULL, prochaineetat VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, difficulte LONGTEXT DEFAULT NULL, etat VARCHAR(255) NOT NULL, justification LONGTEXT DEFAULT NULL, INDEX IDX_1FFF9D51C903E5B8 (communaute_id), INDEX IDX_1FFF9D51FB88E14F (utilisateur_id), INDEX IDX_1FFF9D511B65292 (employe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nompf (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, communaute_id INT DEFAULT NULL, libelle VARCHAR(60) NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_48843C8CFB88E14F (utilisateur_id), INDEX IDX_48843C8CC903E5B8 (communaute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE numeropf (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, communaute_id INT DEFAULT NULL, libelle VARCHAR(14) NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_F2F82F44FB88E14F (utilisateur_id), INDEX IDX_F2F82F44C903E5B8 (communaute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promesse (id INT AUTO_INCREMENT NOT NULL, communaute_id INT NOT NULL, utilisateur_id INT NOT NULL, nom VARCHAR(255) NOT NULL, numero VARCHAR(16) NOT NULL, email VARCHAR(60) DEFAULT NULL, dateremise DATETIME NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_4900EF52C903E5B8 (communaute_id), INDEX IDX_4900EF52FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE _admin_employe ADD CONSTRAINT FK_9368111E57889920 FOREIGN KEY (fonction_id) REFERENCES _admin_param_fonction (id)');
        $this->addSql('ALTER TABLE _admin_employe ADD CONSTRAINT FK_9368111EA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES _admin_param_entreprise (id)');
        $this->addSql('ALTER TABLE _admin_param_config_app ADD CONSTRAINT FK_EE0159A1F98F144A FOREIGN KEY (logo_id) REFERENCES _admin_param_fichier (id)');
        $this->addSql('ALTER TABLE _admin_param_config_app ADD CONSTRAINT FK_EE0159A1D78119FD FOREIGN KEY (favicon_id) REFERENCES _admin_param_fichier (id)');
        $this->addSql('ALTER TABLE _admin_param_config_app ADD CONSTRAINT FK_EE0159A1D3426EF5 FOREIGN KEY (image_login_id) REFERENCES _admin_param_fichier (id)');
        $this->addSql('ALTER TABLE _admin_param_config_app ADD CONSTRAINT FK_EE0159A1C83BB8B FOREIGN KEY (logo_login_id) REFERENCES _admin_param_fichier (id)');
        $this->addSql('ALTER TABLE _admin_param_config_app ADD CONSTRAINT FK_EE0159A1A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES _admin_param_entreprise (id)');
        $this->addSql('ALTER TABLE _admin_param_entreprise ADD CONSTRAINT FK_3537B201F98F144A FOREIGN KEY (logo_id) REFERENCES _admin_param_fichier (id)');
        $this->addSql('ALTER TABLE _admin_param_groupe_module ADD CONSTRAINT FK_CA79B3FF54B9D732 FOREIGN KEY (icon_id) REFERENCES _admin_param_icon (id)');
        $this->addSql('ALTER TABLE _admin_param_module_groupe_permition ADD CONSTRAINT FK_29EAEA2B806F2303 FOREIGN KEY (permition_id) REFERENCES _admin_param_permition (id)');
        $this->addSql('ALTER TABLE _admin_param_module_groupe_permition ADD CONSTRAINT FK_29EAEA2BAFC2B591 FOREIGN KEY (module_id) REFERENCES _admin_param_module (id)');
        $this->addSql('ALTER TABLE _admin_param_module_groupe_permition ADD CONSTRAINT FK_29EAEA2BFF5666A6 FOREIGN KEY (groupe_module_id) REFERENCES _admin_param_groupe_module (id)');
        $this->addSql('ALTER TABLE _admin_param_module_groupe_permition ADD CONSTRAINT FK_29EAEA2B610934DB FOREIGN KEY (groupe_user_id) REFERENCES _admin_user_groupe (id)');
        $this->addSql('ALTER TABLE _admin_user_front_prestataire ADD CONSTRAINT FK_60FED01CBF396750 FOREIGN KEY (id) REFERENCES _admin_user_front_utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE _admin_user_front_utilisateur_simple ADD CONSTRAINT FK_F4066868BF396750 FOREIGN KEY (id) REFERENCES _admin_user_front_utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE _admin_user_utilisateur ADD CONSTRAINT FK_2264DC411B65292 FOREIGN KEY (employe_id) REFERENCES _admin_employe (id)');
        $this->addSql('ALTER TABLE _admin_user_utilisateur ADD CONSTRAINT FK_2264DC417A45358C FOREIGN KEY (groupe_id) REFERENCES _admin_user_groupe (id)');
        $this->addSql('ALTER TABLE audience ADD CONSTRAINT FK_FDCD9418C903E5B8 FOREIGN KEY (communaute_id) REFERENCES communaute (id)');
        $this->addSql('ALTER TABLE audience ADD CONSTRAINT FK_FDCD9418FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES _admin_user_utilisateur (id)');
        $this->addSql('ALTER TABLE beneficiaire ADD CONSTRAINT FK_B140D802C903E5B8 FOREIGN KEY (communaute_id) REFERENCES communaute (id)');
        $this->addSql('ALTER TABLE beneficiaire ADD CONSTRAINT FK_B140D802FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES _admin_user_utilisateur (id)');
        $this->addSql('ALTER TABLE beneficiaire ADD CONSTRAINT FK_B140D8027B3C9061 FOREIGN KEY (don_id) REFERENCES don (id)');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES _admin_user_utilisateur (id)');
        $this->addSql('ALTER TABLE communaute ADD CONSTRAINT FK_21C94799BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE communaute ADD CONSTRAINT FK_21C94799924DD2B5 FOREIGN KEY (localite_id) REFERENCES localite (id)');
        $this->addSql('ALTER TABLE communaute ADD CONSTRAINT FK_21C94799FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES _admin_user_utilisateur (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638C903E5B8 FOREIGN KEY (communaute_id) REFERENCES communaute (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES _admin_user_utilisateur (id)');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A5C903E5B8 FOREIGN KEY (communaute_id) REFERENCES communaute (id)');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A5FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES _admin_user_utilisateur (id)');
        $this->addSql('ALTER TABLE don ADD CONSTRAINT FK_F8F081D9FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES _admin_user_utilisateur (id)');
        $this->addSql('ALTER TABLE don ADD CONSTRAINT FK_F8F081D9C903E5B8 FOREIGN KEY (communaute_id) REFERENCES communaute (id)');
        $this->addSql('ALTER TABLE emailpf ADD CONSTRAINT FK_D8D7C913FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES _admin_user_utilisateur (id)');
        $this->addSql('ALTER TABLE emailpf ADD CONSTRAINT FK_D8D7C913C903E5B8 FOREIGN KEY (communaute_id) REFERENCES communaute (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES _admin_user_utilisateur (id)');
        $this->addSql('ALTER TABLE fieldon ADD CONSTRAINT FK_7D62107EFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES _admin_user_utilisateur (id)');
        $this->addSql('ALTER TABLE fieldon ADD CONSTRAINT FK_7D62107E7B3C9061 FOREIGN KEY (don_id) REFERENCES don (id)');
        $this->addSql('ALTER TABLE fielpromesse ADD CONSTRAINT FK_36982A85D09FD084 FOREIGN KEY (promesse_id) REFERENCES promesse (id)');
        $this->addSql('ALTER TABLE fielpromesse ADD CONSTRAINT FK_36982A85FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES _admin_user_utilisateur (id)');
        $this->addSql('ALTER TABLE localite ADD CONSTRAINT FK_F5D7E4A9FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES _admin_user_utilisateur (id)');
        $this->addSql('ALTER TABLE missionrapport ADD CONSTRAINT FK_1FFF9D51C903E5B8 FOREIGN KEY (communaute_id) REFERENCES communaute (id)');
        $this->addSql('ALTER TABLE missionrapport ADD CONSTRAINT FK_1FFF9D51FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES _admin_user_utilisateur (id)');
        $this->addSql('ALTER TABLE missionrapport ADD CONSTRAINT FK_1FFF9D511B65292 FOREIGN KEY (employe_id) REFERENCES _admin_employe (id)');
        $this->addSql('ALTER TABLE nompf ADD CONSTRAINT FK_48843C8CFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES _admin_user_utilisateur (id)');
        $this->addSql('ALTER TABLE nompf ADD CONSTRAINT FK_48843C8CC903E5B8 FOREIGN KEY (communaute_id) REFERENCES communaute (id)');
        $this->addSql('ALTER TABLE numeropf ADD CONSTRAINT FK_F2F82F44FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES _admin_user_utilisateur (id)');
        $this->addSql('ALTER TABLE numeropf ADD CONSTRAINT FK_F2F82F44C903E5B8 FOREIGN KEY (communaute_id) REFERENCES communaute (id)');
        $this->addSql('ALTER TABLE promesse ADD CONSTRAINT FK_4900EF52C903E5B8 FOREIGN KEY (communaute_id) REFERENCES communaute (id)');
        $this->addSql('ALTER TABLE promesse ADD CONSTRAINT FK_4900EF52FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES _admin_user_utilisateur (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES _admin_user_utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE _admin_employe DROP FOREIGN KEY FK_9368111E57889920');
        $this->addSql('ALTER TABLE _admin_employe DROP FOREIGN KEY FK_9368111EA4AEAFEA');
        $this->addSql('ALTER TABLE _admin_param_config_app DROP FOREIGN KEY FK_EE0159A1F98F144A');
        $this->addSql('ALTER TABLE _admin_param_config_app DROP FOREIGN KEY FK_EE0159A1D78119FD');
        $this->addSql('ALTER TABLE _admin_param_config_app DROP FOREIGN KEY FK_EE0159A1D3426EF5');
        $this->addSql('ALTER TABLE _admin_param_config_app DROP FOREIGN KEY FK_EE0159A1C83BB8B');
        $this->addSql('ALTER TABLE _admin_param_config_app DROP FOREIGN KEY FK_EE0159A1A4AEAFEA');
        $this->addSql('ALTER TABLE _admin_param_entreprise DROP FOREIGN KEY FK_3537B201F98F144A');
        $this->addSql('ALTER TABLE _admin_param_groupe_module DROP FOREIGN KEY FK_CA79B3FF54B9D732');
        $this->addSql('ALTER TABLE _admin_param_module_groupe_permition DROP FOREIGN KEY FK_29EAEA2B806F2303');
        $this->addSql('ALTER TABLE _admin_param_module_groupe_permition DROP FOREIGN KEY FK_29EAEA2BAFC2B591');
        $this->addSql('ALTER TABLE _admin_param_module_groupe_permition DROP FOREIGN KEY FK_29EAEA2BFF5666A6');
        $this->addSql('ALTER TABLE _admin_param_module_groupe_permition DROP FOREIGN KEY FK_29EAEA2B610934DB');
        $this->addSql('ALTER TABLE _admin_user_front_prestataire DROP FOREIGN KEY FK_60FED01CBF396750');
        $this->addSql('ALTER TABLE _admin_user_front_utilisateur_simple DROP FOREIGN KEY FK_F4066868BF396750');
        $this->addSql('ALTER TABLE _admin_user_utilisateur DROP FOREIGN KEY FK_2264DC411B65292');
        $this->addSql('ALTER TABLE _admin_user_utilisateur DROP FOREIGN KEY FK_2264DC417A45358C');
        $this->addSql('ALTER TABLE audience DROP FOREIGN KEY FK_FDCD9418C903E5B8');
        $this->addSql('ALTER TABLE audience DROP FOREIGN KEY FK_FDCD9418FB88E14F');
        $this->addSql('ALTER TABLE beneficiaire DROP FOREIGN KEY FK_B140D802C903E5B8');
        $this->addSql('ALTER TABLE beneficiaire DROP FOREIGN KEY FK_B140D802FB88E14F');
        $this->addSql('ALTER TABLE beneficiaire DROP FOREIGN KEY FK_B140D8027B3C9061');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634FB88E14F');
        $this->addSql('ALTER TABLE communaute DROP FOREIGN KEY FK_21C94799BCF5E72D');
        $this->addSql('ALTER TABLE communaute DROP FOREIGN KEY FK_21C94799924DD2B5');
        $this->addSql('ALTER TABLE communaute DROP FOREIGN KEY FK_21C94799FB88E14F');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638C903E5B8');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638FB88E14F');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A5C903E5B8');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A5FB88E14F');
        $this->addSql('ALTER TABLE don DROP FOREIGN KEY FK_F8F081D9FB88E14F');
        $this->addSql('ALTER TABLE don DROP FOREIGN KEY FK_F8F081D9C903E5B8');
        $this->addSql('ALTER TABLE emailpf DROP FOREIGN KEY FK_D8D7C913FB88E14F');
        $this->addSql('ALTER TABLE emailpf DROP FOREIGN KEY FK_D8D7C913C903E5B8');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7FB88E14F');
        $this->addSql('ALTER TABLE fieldon DROP FOREIGN KEY FK_7D62107EFB88E14F');
        $this->addSql('ALTER TABLE fieldon DROP FOREIGN KEY FK_7D62107E7B3C9061');
        $this->addSql('ALTER TABLE fielpromesse DROP FOREIGN KEY FK_36982A85D09FD084');
        $this->addSql('ALTER TABLE fielpromesse DROP FOREIGN KEY FK_36982A85FB88E14F');
        $this->addSql('ALTER TABLE localite DROP FOREIGN KEY FK_F5D7E4A9FB88E14F');
        $this->addSql('ALTER TABLE missionrapport DROP FOREIGN KEY FK_1FFF9D51C903E5B8');
        $this->addSql('ALTER TABLE missionrapport DROP FOREIGN KEY FK_1FFF9D51FB88E14F');
        $this->addSql('ALTER TABLE missionrapport DROP FOREIGN KEY FK_1FFF9D511B65292');
        $this->addSql('ALTER TABLE nompf DROP FOREIGN KEY FK_48843C8CFB88E14F');
        $this->addSql('ALTER TABLE nompf DROP FOREIGN KEY FK_48843C8CC903E5B8');
        $this->addSql('ALTER TABLE numeropf DROP FOREIGN KEY FK_F2F82F44FB88E14F');
        $this->addSql('ALTER TABLE numeropf DROP FOREIGN KEY FK_F2F82F44C903E5B8');
        $this->addSql('ALTER TABLE promesse DROP FOREIGN KEY FK_4900EF52C903E5B8');
        $this->addSql('ALTER TABLE promesse DROP FOREIGN KEY FK_4900EF52FB88E14F');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE _admin_employe');
        $this->addSql('DROP TABLE _admin_param_civilite');
        $this->addSql('DROP TABLE _admin_param_config_app');
        $this->addSql('DROP TABLE _admin_param_entreprise');
        $this->addSql('DROP TABLE _admin_param_fichier');
        $this->addSql('DROP TABLE _admin_param_fonction');
        $this->addSql('DROP TABLE _admin_param_groupe_module');
        $this->addSql('DROP TABLE _admin_param_icon');
        $this->addSql('DROP TABLE _admin_param_module');
        $this->addSql('DROP TABLE _admin_param_module_groupe_permition');
        $this->addSql('DROP TABLE _admin_param_permition');
        $this->addSql('DROP TABLE _admin_param_test');
        $this->addSql('DROP TABLE _admin_user_front_prestataire');
        $this->addSql('DROP TABLE _admin_user_front_utilisateur');
        $this->addSql('DROP TABLE _admin_user_front_utilisateur_simple');
        $this->addSql('DROP TABLE _admin_user_groupe');
        $this->addSql('DROP TABLE _admin_user_utilisateur');
        $this->addSql('DROP TABLE audience');
        $this->addSql('DROP TABLE beneficiaire');
        $this->addSql('DROP TABLE calendrier');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE communaute');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE demande');
        $this->addSql('DROP TABLE don');
        $this->addSql('DROP TABLE emailpf');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE fieldon');
        $this->addSql('DROP TABLE fielpromesse');
        $this->addSql('DROP TABLE localite');
        $this->addSql('DROP TABLE missionrapport');
        $this->addSql('DROP TABLE nompf');
        $this->addSql('DROP TABLE numeropf');
        $this->addSql('DROP TABLE promesse');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
