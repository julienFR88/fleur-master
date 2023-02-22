<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222090050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE first_name first_name VARCHAR(255) DEFAULT NULL, CHANGE middle_name middle_name VARCHAR(255) DEFAULT NULL, CHANGE last_name last_name VARCHAR(255) DEFAULT NULL, CHANGE mobile mobile VARCHAR(255) DEFAULT NULL, CHANGE vendor vendor VARCHAR(255) DEFAULT NULL, CHANGE intro intro VARCHAR(1) DEFAULT NULL, CHANGE profile profile LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` CHANGE first_name first_name VARCHAR(50) DEFAULT NULL, CHANGE middle_name middle_name VARCHAR(50) DEFAULT NULL, CHANGE last_name last_name VARCHAR(50) DEFAULT NULL, CHANGE mobile mobile VARCHAR(15) DEFAULT NULL, CHANGE vendor vendor VARCHAR(1) DEFAULT NULL, CHANGE intro intro LONGTEXT NOT NULL, CHANGE profile profile VARCHAR(50) DEFAULT NULL');
    }
}
