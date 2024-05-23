<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230517123456 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create initial schema with Depeche, Article, Illustration, Tag, IAGenerative, IAGenerativeTexte, IAGenerativeImage tables';
    }

    public function up(Schema $schema): void
    {
        // Create Depeche table
        $this->addSql('CREATE TABLE depeche (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, contenu LONGTEXT NOT NULL, date_publication DATETIME NOT NULL, source VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // Create Article table
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, depeche_id INT NOT NULL, titre VARCHAR(255) NOT NULL, contenu LONGTEXT NOT NULL, date_creation DATETIME NOT NULL, url VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, auteur VARCHAR(255) NOT NULL, INDEX IDX_23A0E66CFF1D07B (depeche_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66CFF1D07B FOREIGN KEY (depeche_id) REFERENCES depeche (id)');

        // Create Illustration table
        $this->addSql('CREATE TABLE illustration (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, url VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date_creation DATETIME NOT NULL, INDEX IDX_D9BB9AE87294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE illustration ADD CONSTRAINT FK_D9BB9AE87294869C FOREIGN KEY (article_id) REFERENCES article (id)');

        // Create Tag table
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // Create Article_Tag table
        $this->addSql('CREATE TABLE article_tag (article_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_18A0FB8F7294869C (article_id), INDEX IDX_18A0FB8FBAD26311 (tag_id), PRIMARY KEY(article_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_tag ADD CONSTRAINT FK_18A0FB8F7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_tag ADD CONSTRAINT FK_18A0FB8FBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');

        // Create IAGenerative table
        $this->addSql('CREATE TABLE iagenerative (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, fonction VARCHAR(255) NOT NULL, discr VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // Create IAGenerativeTexte table
        $this->addSql('CREATE TABLE iagenerative_texte (id INT NOT NULL, texte_genere LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE iagenerative_texte ADD CONSTRAINT FK_DAF273EFBF396750 FOREIGN KEY (id) REFERENCES iagenerative (id) ON DELETE CASCADE');

        // Create IAGenerativeImage table
        $this->addSql('CREATE TABLE iagenerative_image (id INT NOT NULL, image_generee VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE iagenerative_image ADD CONSTRAINT FK_4E1A85CEBF396750 FOREIGN KEY (id) REFERENCES iagenerative (id) ON DELETE CASCADE');

        // Create Illustration_IAGenerative table
        $this->addSql('CREATE TABLE illustration_iagenerative (illustration_id INT NOT NULL, iagenerative_id INT NOT NULL, INDEX IDX_46648BBF3F15C272 (illustration_id), INDEX IDX_46648BBFA6E883AC (iagenerative_id), PRIMARY KEY(illustration_id, iagenerative_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE illustration_iagenerative ADD CONSTRAINT FK_46648BBF3F15C272 FOREIGN KEY (illustration_id) REFERENCES illustration (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE illustration_iagenerative ADD CONSTRAINT FK_46648BBFA6E883AC FOREIGN KEY (iagenerative_id) REFERENCES iagenerative (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // Drop tables in the reverse order to avoid foreign key constraint issues
        $this->addSql('ALTER TABLE illustration_iagenerative DROP FOREIGN KEY FK_46648BBF3F15C272');
        $this->addSql('ALTER TABLE illustration_iagenerative DROP FOREIGN KEY FK_46648BBFA6E883AC');
        $this->addSql('DROP TABLE illustration_iagenerative');

        $this->addSql('ALTER TABLE iagenerative_image DROP FOREIGN KEY FK_4E1A85CEBF396750');
        $this->addSql('DROP TABLE iagenerative_image');

        $this->addSql('ALTER TABLE iagenerative_texte DROP FOREIGN KEY FK_DAF273EFBF396750');
        $this->addSql('DROP TABLE iagenerative_texte');

        $this->addSql('DROP TABLE iagenerative');

        $this->addSql('ALTER TABLE article_tag DROP FOREIGN KEY FK_18A0FB8F7294869C');
        $this->addSql('ALTER TABLE article_tag DROP FOREIGN KEY FK_18A0FB8FBAD26311');
        $this->addSql('DROP TABLE article_tag');

        $this->addSql('DROP TABLE tag');

        $this->addSql('ALTER TABLE illustration DROP FOREIGN KEY FK_D9BB9AE87294869C');
        $this->addSql('DROP TABLE illustration');

        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66CFF1D07B');
        $this->addSql('DROP TABLE article');

        $this->addSql('DROP TABLE depeche');
    }
}
