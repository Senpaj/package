<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180424142420 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_info ADD member_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_info ADD CONSTRAINT FK_B1087D9E7597D3FE FOREIGN KEY (member_id) REFERENCES member (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B1087D9E7597D3FE ON user_info (member_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_info DROP FOREIGN KEY FK_B1087D9E7597D3FE');
        $this->addSql('DROP INDEX UNIQ_B1087D9E7597D3FE ON user_info');
        $this->addSql('ALTER TABLE user_info DROP member_id');
    }
}
