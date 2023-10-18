<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231014132910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post_tag MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE post_tag DROP FOREIGN KEY FK_5ACE3AF04B89032C');
        $this->addSql('ALTER TABLE post_tag DROP FOREIGN KEY FK_5ACE3AF0BAD26311');
        $this->addSql('DROP INDEX `primary` ON post_tag');
        $this->addSql('ALTER TABLE post_tag DROP id, CHANGE post_id post_id INT NOT NULL, CHANGE tag_id tag_id INT NOT NULL');
        $this->addSql('ALTER TABLE post_tag ADD CONSTRAINT FK_5ACE3AF04B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_tag ADD CONSTRAINT FK_5ACE3AF0BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_tag ADD PRIMARY KEY (post_id, tag_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post_tag DROP FOREIGN KEY FK_5ACE3AF04B89032C');
        $this->addSql('ALTER TABLE post_tag DROP FOREIGN KEY FK_5ACE3AF0BAD26311');
        $this->addSql('ALTER TABLE post_tag ADD id INT AUTO_INCREMENT NOT NULL, CHANGE post_id post_id INT DEFAULT NULL, CHANGE tag_id tag_id INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE post_tag ADD CONSTRAINT FK_5ACE3AF04B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE post_tag ADD CONSTRAINT FK_5ACE3AF0BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
