<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180517075131 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE customer_order (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, fk_client INT NOT NULL, description VARCHAR(255) DEFAULT NULL, auto_make VARCHAR(255) NOT NULL, auto_model VARCHAR(255) NOT NULL, status INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_info DROP country, DROP city, DROP address, DROP description');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE customer_order');
        $this->addSql('ALTER TABLE user_info ADD country VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD city VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD address VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD description VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
