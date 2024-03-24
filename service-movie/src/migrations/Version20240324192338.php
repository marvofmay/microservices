<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240324192338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE movies_categories (movie_uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', category_uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_6B05AC9E221971AB (movie_uuid), INDEX IDX_6B05AC9E5AE42AE1 (category_uuid), PRIMARY KEY(movie_uuid, category_uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movies_categories ADD CONSTRAINT FK_6B05AC9E221971AB FOREIGN KEY (movie_uuid) REFERENCES movies (uuid)');
        $this->addSql('ALTER TABLE movies_categories ADD CONSTRAINT FK_6B05AC9E5AE42AE1 FOREIGN KEY (category_uuid) REFERENCES category (uuid)');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1221971AB');
        $this->addSql('DROP INDEX IDX_64C19C1221971AB ON category');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movies_categories DROP FOREIGN KEY FK_6B05AC9E221971AB');
        $this->addSql('ALTER TABLE movies_categories DROP FOREIGN KEY FK_6B05AC9E5AE42AE1');
        $this->addSql('DROP TABLE movies_categories');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1221971AB FOREIGN KEY (movie_uuid) REFERENCES movies (uuid) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_64C19C1221971AB ON category (movie_uuid)');
    }
}
