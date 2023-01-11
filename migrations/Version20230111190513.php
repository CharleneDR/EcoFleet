<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230111190513 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE unavailability_date_car DROP FOREIGN KEY FK_A00F3B8B80369FB1');
        $this->addSql('ALTER TABLE unavailability_date_car DROP FOREIGN KEY FK_A00F3B8BC3C6F69F');
        $this->addSql('DROP TABLE unavailability_date_car');
        $this->addSql('ALTER TABLE car DROP unavailabilitydate');
        $this->addSql('ALTER TABLE unavailability_date ADD car_id INT NOT NULL');
        $this->addSql('ALTER TABLE unavailability_date ADD CONSTRAINT FK_B1C40504C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('CREATE INDEX IDX_B1C40504C3C6F69F ON unavailability_date (car_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE unavailability_date_car (unavailability_date_id INT NOT NULL, car_id INT NOT NULL, INDEX IDX_A00F3B8B80369FB1 (unavailability_date_id), INDEX IDX_A00F3B8BC3C6F69F (car_id), PRIMARY KEY(unavailability_date_id, car_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE unavailability_date_car ADD CONSTRAINT FK_A00F3B8B80369FB1 FOREIGN KEY (unavailability_date_id) REFERENCES unavailability_date (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE unavailability_date_car ADD CONSTRAINT FK_A00F3B8BC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE car ADD unavailabilitydate DATE NOT NULL');
        $this->addSql('ALTER TABLE unavailability_date DROP FOREIGN KEY FK_B1C40504C3C6F69F');
        $this->addSql('DROP INDEX IDX_B1C40504C3C6F69F ON unavailability_date');
        $this->addSql('ALTER TABLE unavailability_date DROP car_id');
    }
}
