<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version202412020153914 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL, article_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526D12469DE2 FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_9474526D12469DE2 ON comment (article_id)');
    }

    public function down(Schema $schema): void
    {

    }
}
