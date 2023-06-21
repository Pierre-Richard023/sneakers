<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230621144520 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brands (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favorites (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, UNIQUE INDEX UNIQ_E46960F59395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favorites_sneaker (favorites_id INT NOT NULL, sneaker_id INT NOT NULL, INDEX IDX_F88330B184DDC6B4 (favorites_id), INDEX IDX_F88330B1B44896C4 (sneaker_id), PRIMARY KEY(favorites_id, sneaker_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE models (id INT AUTO_INCREMENT NOT NULL, brands_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_E4D63009E9EEC0C7 (brands_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, number VARCHAR(60) NOT NULL, INDEX IDX_E52FFDEE9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders_sneaker (orders_id INT NOT NULL, sneaker_id INT NOT NULL, INDEX IDX_B32CCAF1CFFE9AD6 (orders_id), INDEX IDX_B32CCAF1B44896C4 (sneaker_id), PRIMARY KEY(orders_id, sneaker_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sneaker (id INT AUTO_INCREMENT NOT NULL, brand_id INT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, color VARCHAR(255) NOT NULL, article_number VARCHAR(40) NOT NULL, shoe_size LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', stock INT NOT NULL, release_date DATE NOT NULL, details LONGTEXT DEFAULT NULL, INDEX IDX_4259B88A44F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sneakers_images (id INT AUTO_INCREMENT NOT NULL, sneaker_id INT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_1B6E054EB44896C4 (sneaker_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favorites ADD CONSTRAINT FK_E46960F59395C3F3 FOREIGN KEY (customer_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE favorites_sneaker ADD CONSTRAINT FK_F88330B184DDC6B4 FOREIGN KEY (favorites_id) REFERENCES favorites (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorites_sneaker ADD CONSTRAINT FK_F88330B1B44896C4 FOREIGN KEY (sneaker_id) REFERENCES sneaker (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE models ADD CONSTRAINT FK_E4D63009E9EEC0C7 FOREIGN KEY (brands_id) REFERENCES brands (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE9395C3F3 FOREIGN KEY (customer_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE orders_sneaker ADD CONSTRAINT FK_B32CCAF1CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orders_sneaker ADD CONSTRAINT FK_B32CCAF1B44896C4 FOREIGN KEY (sneaker_id) REFERENCES sneaker (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sneaker ADD CONSTRAINT FK_4259B88A44F5D008 FOREIGN KEY (brand_id) REFERENCES brands (id)');
        $this->addSql('ALTER TABLE sneakers_images ADD CONSTRAINT FK_1B6E054EB44896C4 FOREIGN KEY (sneaker_id) REFERENCES sneaker (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE favorites DROP FOREIGN KEY FK_E46960F59395C3F3');
        $this->addSql('ALTER TABLE favorites_sneaker DROP FOREIGN KEY FK_F88330B184DDC6B4');
        $this->addSql('ALTER TABLE favorites_sneaker DROP FOREIGN KEY FK_F88330B1B44896C4');
        $this->addSql('ALTER TABLE models DROP FOREIGN KEY FK_E4D63009E9EEC0C7');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE9395C3F3');
        $this->addSql('ALTER TABLE orders_sneaker DROP FOREIGN KEY FK_B32CCAF1CFFE9AD6');
        $this->addSql('ALTER TABLE orders_sneaker DROP FOREIGN KEY FK_B32CCAF1B44896C4');
        $this->addSql('ALTER TABLE sneaker DROP FOREIGN KEY FK_4259B88A44F5D008');
        $this->addSql('ALTER TABLE sneakers_images DROP FOREIGN KEY FK_1B6E054EB44896C4');
        $this->addSql('DROP TABLE brands');
        $this->addSql('DROP TABLE favorites');
        $this->addSql('DROP TABLE favorites_sneaker');
        $this->addSql('DROP TABLE models');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE orders_sneaker');
        $this->addSql('DROP TABLE sneaker');
        $this->addSql('DROP TABLE sneakers_images');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
