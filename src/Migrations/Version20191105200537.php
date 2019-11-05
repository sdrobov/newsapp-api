<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191105200537 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE admin ADD token VARCHAR(255) NOT NULL');
        $this->addSql('CREATE INDEX idx_admin_token ON admin (token)');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP INDEX idx_admin_token');
        $this->addSql('ALTER TABLE admin DROP token');
    }
}
