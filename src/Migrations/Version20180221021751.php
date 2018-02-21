<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180221021751 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', category_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', title VARCHAR(255) NOT NULL, publisher VARCHAR(255) NOT NULL, INDEX IDX_CBE5A33112469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reader (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reader_book (reader_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', book_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_2A3845F31717D737 (reader_id), INDEX IDX_2A3845F316A2B381 (book_id), PRIMARY KEY(reader_id, book_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wishlist (reader_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', book_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_9CE12A311717D737 (reader_id), INDEX IDX_9CE12A3116A2B381 (book_id), PRIMARY KEY(reader_id, book_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trade (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', old_reader_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', new_reader_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', book_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', created_at DATETIME NOT NULL, INDEX IDX_7E1A436652A39386 (old_reader_id), INDEX IDX_7E1A43662588D258 (new_reader_id), INDEX IDX_7E1A436616A2B381 (book_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A33112469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE reader_book ADD CONSTRAINT FK_2A3845F31717D737 FOREIGN KEY (reader_id) REFERENCES reader (id)');
        $this->addSql('ALTER TABLE reader_book ADD CONSTRAINT FK_2A3845F316A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE wishlist ADD CONSTRAINT FK_9CE12A311717D737 FOREIGN KEY (reader_id) REFERENCES reader (id)');
        $this->addSql('ALTER TABLE wishlist ADD CONSTRAINT FK_9CE12A3116A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE trade ADD CONSTRAINT FK_7E1A436652A39386 FOREIGN KEY (old_reader_id) REFERENCES reader (id)');
        $this->addSql('ALTER TABLE trade ADD CONSTRAINT FK_7E1A43662588D258 FOREIGN KEY (new_reader_id) REFERENCES reader (id)');
        $this->addSql('ALTER TABLE trade ADD CONSTRAINT FK_7E1A436616A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A33112469DE2');
        $this->addSql('ALTER TABLE reader_book DROP FOREIGN KEY FK_2A3845F316A2B381');
        $this->addSql('ALTER TABLE wishlist DROP FOREIGN KEY FK_9CE12A3116A2B381');
        $this->addSql('ALTER TABLE trade DROP FOREIGN KEY FK_7E1A436616A2B381');
        $this->addSql('ALTER TABLE reader_book DROP FOREIGN KEY FK_2A3845F31717D737');
        $this->addSql('ALTER TABLE wishlist DROP FOREIGN KEY FK_9CE12A311717D737');
        $this->addSql('ALTER TABLE trade DROP FOREIGN KEY FK_7E1A436652A39386');
        $this->addSql('ALTER TABLE trade DROP FOREIGN KEY FK_7E1A43662588D258');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE reader');
        $this->addSql('DROP TABLE reader_book');
        $this->addSql('DROP TABLE wishlist');
        $this->addSql('DROP TABLE trade');
    }
}
