<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180507193034 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_info DROP FOREIGN KEY FK_B1087D9E7597D3FE');
        $this->addSql('ALTER TABLE user_info ADD CONSTRAINT FK_B1087D9E7597D3FE FOREIGN KEY (member_id) REFERENCES member (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_info DROP FOREIGN KEY FK_B1087D9E7597D3FE');
        $this->addSql('ALTER TABLE user_info ADD CONSTRAINT FK_B1087D9E7597D3FE FOREIGN KEY (member_id) REFERENCES member (id) ON DELETE CASCADE');
    }
}
