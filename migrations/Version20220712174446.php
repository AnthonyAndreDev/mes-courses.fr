<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220712174446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fridge_products (fridge_id INT NOT NULL, products_id INT NOT NULL, INDEX IDX_2B7625C414A48E59 (fridge_id), INDEX IDX_2B7625C46C8A81A9 (products_id), PRIMARY KEY(fridge_id, products_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, quantity INT NOT NULL, expiration_date DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fridge_products ADD CONSTRAINT FK_2B7625C414A48E59 FOREIGN KEY (fridge_id) REFERENCES fridge (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fridge_products ADD CONSTRAINT FK_2B7625C46C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fridge_products DROP FOREIGN KEY FK_2B7625C46C8A81A9');
        $this->addSql('DROP TABLE fridge_products');
        $this->addSql('DROP TABLE products');
    }
}
