<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241024155011 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sneaker_sneaker_size DROP FOREIGN KEY FK_3679831B44896C4');
        $this->addSql('ALTER TABLE sneaker_sneaker_size DROP FOREIGN KEY FK_3679831E5168399');
        $this->addSql('DROP TABLE sneaker_sneaker_size');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sneaker_sneaker_size (sneaker_id INT NOT NULL, sneaker_size_id INT NOT NULL, INDEX IDX_3679831B44896C4 (sneaker_id), INDEX IDX_3679831E5168399 (sneaker_size_id), PRIMARY KEY(sneaker_id, sneaker_size_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE sneaker_sneaker_size ADD CONSTRAINT FK_3679831B44896C4 FOREIGN KEY (sneaker_id) REFERENCES sneaker (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sneaker_sneaker_size ADD CONSTRAINT FK_3679831E5168399 FOREIGN KEY (sneaker_size_id) REFERENCES sneaker_size (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
