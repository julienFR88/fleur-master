<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230302100306 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` CHANGE status status SMALLINT DEFAULT NULL, CHANGE sub_total sub_total DOUBLE PRECISION DEFAULT NULL, CHANGE item_discount item_discount DOUBLE PRECISION DEFAULT NULL, CHANGE tax tax DOUBLE PRECISION DEFAULT NULL, CHANGE shipping shipping DOUBLE PRECISION DEFAULT NULL, CHANGE total total DOUBLE PRECISION DEFAULT NULL, CHANGE discount discount DOUBLE PRECISION DEFAULT NULL, CHANGE grand_total grand_total DOUBLE PRECISION DEFAULT NULL, CHANGE email email VARCHAR(50) DEFAULT NULL, CHANGE line2 line2 VARCHAR(50) DEFAULT NULL, CHANGE content content LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` CHANGE status status SMALLINT NOT NULL, CHANGE sub_total sub_total DOUBLE PRECISION NOT NULL, CHANGE item_discount item_discount DOUBLE PRECISION NOT NULL, CHANGE tax tax DOUBLE PRECISION NOT NULL, CHANGE shipping shipping DOUBLE PRECISION NOT NULL, CHANGE total total DOUBLE PRECISION NOT NULL, CHANGE discount discount DOUBLE PRECISION NOT NULL, CHANGE grand_total grand_total DOUBLE PRECISION NOT NULL, CHANGE email email VARCHAR(50) NOT NULL, CHANGE line2 line2 VARCHAR(50) NOT NULL, CHANGE content content LONGTEXT NOT NULL');
    }
}
