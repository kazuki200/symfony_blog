<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231014102728 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE category_name name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE post CHANGE category_id category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tag CHANGE tag_name name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE name category_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE tag CHANGE name tag_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE post CHANGE category_id category_id INT NOT NULL');
    }
}
