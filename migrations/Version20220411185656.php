<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220411185656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE userrr (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD iduserr_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC75DA9B55 FOREIGN KEY (iduserr_id) REFERENCES userr (id)');
        $this->addSql('CREATE INDEX IDX_67F068BC75DA9B55 ON commentaire (iduserr_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE userrr');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC75DA9B55');
        $this->addSql('DROP INDEX IDX_67F068BC75DA9B55 ON commentaire');
        $this->addSql('ALTER TABLE commentaire DROP iduserr_id');
    }
}
