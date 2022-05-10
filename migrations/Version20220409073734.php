<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220409073734 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation_r (id INT AUTO_INCREMENT NOT NULL, id_r_id INT DEFAULT NULL, nbrpersonne_r INT NOT NULL, time_r VARCHAR(255) NOT NULL, date_r VARCHAR(255) NOT NULL, INDEX IDX_A3D5199F252B72B (id_r_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation_r ADD CONSTRAINT FK_A3D5199F252B72B FOREIGN KEY (id_r_id) REFERENCES restau (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reservation_r');
    }
}
