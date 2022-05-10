<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220411192655 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_r ADD idu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation_r ADD CONSTRAINT FK_A3D5199376A6230 FOREIGN KEY (idu_id) REFERENCES userrr (id)');
        $this->addSql('CREATE INDEX IDX_A3D5199376A6230 ON reservation_r (idu_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_r DROP FOREIGN KEY FK_A3D5199376A6230');
        $this->addSql('DROP INDEX IDX_A3D5199376A6230 ON reservation_r');
        $this->addSql('ALTER TABLE reservation_r DROP idu_id');
    }
}
