<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231021133350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post_child (id INT AUTO_INCREMENT NOT NULL, post_id INT DEFAULT NULL, headline VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_B5A8D8C64B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post_child ADD CONSTRAINT FK_B5A8D8C64B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post_child DROP FOREIGN KEY FK_B5A8D8C64B89032C');
        $this->addSql('DROP TABLE post_child');
    }
}
