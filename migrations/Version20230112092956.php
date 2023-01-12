<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230112092956 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rent_user (rent_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_FDF97802E5FD6250 (rent_id), INDEX IDX_FDF97802A76ED395 (user_id), PRIMARY KEY(rent_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rent_user ADD CONSTRAINT FK_FDF97802E5FD6250 FOREIGN KEY (rent_id) REFERENCES rent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rent_user ADD CONSTRAINT FK_FDF97802A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rent_user DROP FOREIGN KEY FK_FDF97802E5FD6250');
        $this->addSql('ALTER TABLE rent_user DROP FOREIGN KEY FK_FDF97802A76ED395');
        $this->addSql('DROP TABLE rent_user');
    }
}
