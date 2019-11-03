<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191103211316 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql('
CREATE TABLE article (
    id INT AUTO_INCREMENT NOT NULL,
    title VARCHAR(255) NOT NULL,
    text TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at DATETIME DEFAULT NULL,
    deleted_at DATETIME DEFAULT NULL,
    PRIMARY KEY(id),
    FULLTEXT idx_article_title (title),
    FULLTEXT idx_article_text (text)
) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('
CREATE TABLE article_category (
    article_id INT NOT NULL,
    category_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    INDEX idx_article_category_article_id (article_id),
    INDEX idx_article_category_category_id (category_id),
    PRIMARY KEY(article_id, category_id)
) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('
CREATE TABLE category (
    id INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at DATETIME DEFAULT NULL,
    deleted_at DATETIME DEFAULT NULL,
    PRIMARY KEY(id),
    FULLTEXT idx_category_name (name)
) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('
ALTER TABLE article_category
    ADD CONSTRAINT fk_article_category_ref_article
    FOREIGN KEY (article_id) REFERENCES article (id)
    ON DELETE RESTRICT');
        $this->addSql('
ALTER TABLE article_category
    ADD CONSTRAINT fk_article_category_ref_category
    FOREIGN KEY (category_id) REFERENCES category (id)
    ON DELETE RESTRICT');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE article_category DROP FOREIGN KEY fk_article_category_ref_article');
        $this->addSql('ALTER TABLE article_category DROP FOREIGN KEY fk_article_category_ref_category');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_category');
        $this->addSql('DROP TABLE category');
    }
}
