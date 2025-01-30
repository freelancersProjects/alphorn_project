<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250130212909 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, email VARCHAR(180) NOT NULL, object VARCHAR(100) NOT NULL, content LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE internship (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, main_image VARCHAR(500) NOT NULL, first_image VARCHAR(500) DEFAULT NULL, second_image VARCHAR(500) DEFAULT NULL, third_image VARCHAR(500) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, main_image VARCHAR(500) NOT NULL, first_image VARCHAR(500) DEFAULT NULL, second_image VARCHAR(500) DEFAULT NULL, third_image VARCHAR(500) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testimonial (id INT AUTO_INCREMENT NOT NULL, fk_id_user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, main_image VARCHAR(500) DEFAULT NULL, first_image VARCHAR(500) DEFAULT NULL, second_image VARCHAR(500) DEFAULT NULL, third_image VARCHAR(500) DEFAULT NULL, INDEX IDX_E6BDCDF7899DB076 (fk_id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE testimonial ADD CONSTRAINT FK_E6BDCDF7899DB076 FOREIGN KEY (fk_id_user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE testimonial DROP FOREIGN KEY FK_E6BDCDF7899DB076');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE internship');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE testimonial');
    }
}
