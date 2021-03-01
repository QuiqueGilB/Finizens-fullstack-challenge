<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210301161052 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE investmentcontext_ordermodule_order (id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', order_typevalue VARCHAR(4) NOT NULL, order_statusvalue VARCHAR(15) NOT NULL, sharesvalue INT NOT NULL, portfolio_idvalue INT NOT NULL, allocation_idvalue INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE investmentcontext_portfoliomodule_allocation (id INT NOT NULL, portfolio_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', sharesvalue INT NOT NULL, INDEX IDX_7A74C974B96B5643 (portfolio_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE investmentcontext_portfoliomodule_portfolio (id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE investmentcontext_portfoliomodule_allocation ADD CONSTRAINT FK_7A74C974B96B5643 FOREIGN KEY (portfolio_id) REFERENCES investmentcontext_portfoliomodule_portfolio (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE investmentcontext_portfoliomodule_allocation DROP FOREIGN KEY FK_7A74C974B96B5643');
        $this->addSql('DROP TABLE investmentcontext_ordermodule_order');
        $this->addSql('DROP TABLE investmentcontext_portfoliomodule_allocation');
        $this->addSql('DROP TABLE investmentcontext_portfoliomodule_portfolio');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
