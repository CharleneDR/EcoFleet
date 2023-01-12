<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230112085037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rent (id INT AUTO_INCREMENT NOT NULL, car_id INT DEFAULT NULL, location_departure VARCHAR(255) NOT NULL, location_arrival VARCHAR(255) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, INDEX IDX_2784DCCC3C6F69F (car_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rent_employee (rent_id INT NOT NULL, employee_id INT NOT NULL, INDEX IDX_D7B28E6E5FD6250 (rent_id), INDEX IDX_D7B28E68C03F15C (employee_id), PRIMARY KEY(rent_id, employee_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rent ADD CONSTRAINT FK_2784DCCC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE rent_employee ADD CONSTRAINT FK_D7B28E6E5FD6250 FOREIGN KEY (rent_id) REFERENCES rent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rent_employee ADD CONSTRAINT FK_D7B28E68C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rent DROP FOREIGN KEY FK_2784DCCC3C6F69F');
        $this->addSql('ALTER TABLE rent_employee DROP FOREIGN KEY FK_D7B28E6E5FD6250');
        $this->addSql('ALTER TABLE rent_employee DROP FOREIGN KEY FK_D7B28E68C03F15C');
        $this->addSql('DROP TABLE rent');
        $this->addSql('DROP TABLE rent_employee');
    }
}
