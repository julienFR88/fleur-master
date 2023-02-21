<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230221121449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD first_name VARCHAR(50) DEFAULT NULL, ADD middle_name VARCHAR(50) DEFAULT NULL, ADD last_name VARCHAR(50) DEFAULT NULL, ADD mobile VARCHAR(15) DEFAULT NULL, ADD vendor VARCHAR(1) DEFAULT NULL, ADD registered_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD last_login DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD intro LONGTEXT NOT NULL, ADD profile VARCHAR(50) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP first_name, DROP middle_name, DROP last_name, DROP mobile, DROP vendor, DROP registered_at, DROP last_login, DROP intro, DROP profile');
    }
}
