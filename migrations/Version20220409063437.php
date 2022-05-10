<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220409063437 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restau DROP FOREIGN KEY FK_D001E5FF6F4B6641');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE reservation_r');
        $this->addSql('DROP TABLE reservation_rr');
        $this->addSql('DROP INDEX IDX_D001E5FF6F4B6641 ON restau');
        $this->addSql('ALTER TABLE restau DROP reservation_r_id, DROP image');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, id_r_id INT DEFAULT NULL, nbrpersonne_r INT NOT NULL, time_r VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_r VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_42C84955F252B72B (id_r_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reservation_r (id INT AUTO_INCREMENT NOT NULL, nbrpersonne_r INT NOT NULL, time_r VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_r VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reservation_rr (id INT AUTO_INCREMENT NOT NULL, id_r INT NOT NULL, nbrpersonne_r VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, time_r VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_r VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955F252B72B FOREIGN KEY (id_r_id) REFERENCES restau (id)');
        $this->addSql('ALTER TABLE restau ADD reservation_r_id INT DEFAULT NULL, ADD image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE restau ADD CONSTRAINT FK_D001E5FF6F4B6641 FOREIGN KEY (reservation_r_id) REFERENCES reservation_r (id)');
        $this->addSql('CREATE INDEX IDX_D001E5FF6F4B6641 ON restau (reservation_r_id)');
    }
}
