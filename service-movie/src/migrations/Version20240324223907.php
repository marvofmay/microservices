<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240324223907 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE movie_category (movie_uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', category_uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_DABA824C221971AB (movie_uuid), INDEX IDX_DABA824C5AE42AE1 (category_uuid), PRIMARY KEY(movie_uuid, category_uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movie_category ADD CONSTRAINT FK_DABA824C221971AB FOREIGN KEY (movie_uuid) REFERENCES movie (uuid)');
        $this->addSql('ALTER TABLE movie_category ADD CONSTRAINT FK_DABA824C5AE42AE1 FOREIGN KEY (category_uuid) REFERENCES category (uuid)');
        $this->addSql('ALTER TABLE movie_categorie DROP FOREIGN KEY FK_DAA8DF32221971AB');
        $this->addSql('ALTER TABLE movie_categorie DROP FOREIGN KEY FK_DAA8DF325AE42AE1');
        $this->addSql('DROP TABLE movie_categorie');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE movie_categorie (movie_uuid CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:uuid)\', category_uuid CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:uuid)\', INDEX IDX_DAA8DF32221971AB (movie_uuid), INDEX IDX_DAA8DF325AE42AE1 (category_uuid), PRIMARY KEY(movie_uuid, category_uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE movie_categorie ADD CONSTRAINT FK_DAA8DF32221971AB FOREIGN KEY (movie_uuid) REFERENCES movie (uuid) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE movie_categorie ADD CONSTRAINT FK_DAA8DF325AE42AE1 FOREIGN KEY (category_uuid) REFERENCES category (uuid) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE movie_category DROP FOREIGN KEY FK_DABA824C221971AB');
        $this->addSql('ALTER TABLE movie_category DROP FOREIGN KEY FK_DABA824C5AE42AE1');
        $this->addSql('DROP TABLE movie_category');
    }
}
