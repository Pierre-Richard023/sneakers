<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230708211933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sneaker DROP FOREIGN KEY FK_4259B88A44F5D008');
        $this->addSql('DROP INDEX IDX_4259B88A44F5D008 ON sneaker');
        $this->addSql('ALTER TABLE sneaker CHANGE shoe_size shoe_size DOUBLE PRECISION NOT NULL, CHANGE brand_id model_id INT NOT NULL');
        $this->addSql('ALTER TABLE sneaker ADD CONSTRAINT FK_4259B88A7975B7E7 FOREIGN KEY (model_id) REFERENCES models (id)');
        $this->addSql('CREATE INDEX IDX_4259B88A7975B7E7 ON sneaker (model_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sneaker DROP FOREIGN KEY FK_4259B88A7975B7E7');
        $this->addSql('DROP INDEX IDX_4259B88A7975B7E7 ON sneaker');
        $this->addSql('ALTER TABLE sneaker CHANGE shoe_size shoe_size LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', CHANGE model_id brand_id INT NOT NULL');
        $this->addSql('ALTER TABLE sneaker ADD CONSTRAINT FK_4259B88A44F5D008 FOREIGN KEY (brand_id) REFERENCES brands (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_4259B88A44F5D008 ON sneaker (brand_id)');
    }
}
