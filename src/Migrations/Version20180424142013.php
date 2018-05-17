<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180424142013 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_info ADD userInfo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_info ADD CONSTRAINT FK_B1087D9EE5704DA FOREIGN KEY (userInfo_id) REFERENCES member (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B1087D9EE5704DA ON user_info (userInfo_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_info DROP FOREIGN KEY FK_B1087D9EE5704DA');
        $this->addSql('DROP INDEX UNIQ_B1087D9EE5704DA ON user_info');
        $this->addSql('ALTER TABLE user_info DROP userInfo_id');
    }
}
