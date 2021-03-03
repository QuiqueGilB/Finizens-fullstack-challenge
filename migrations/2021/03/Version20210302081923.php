<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210302081923 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE investmentcontext_ordermodule_order ADD portfolio_id INT NOT NULL, ADD allocation_id INT NOT NULL, DROP portfolio_idvalue, DROP allocation_idvalue, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE investmentcontext_portfoliomodule_allocation CHANGE id id INT NOT NULL, CHANGE portfolio_id portfolio_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE investmentcontext_portfoliomodule_portfolio CHANGE id id INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE investmentcontext_ordermodule_order ADD portfolio_idvalue INT NOT NULL, ADD allocation_idvalue INT NOT NULL, DROP portfolio_id, DROP allocation_id, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE investmentcontext_portfoliomodule_allocation CHANGE id id INT NOT NULL, CHANGE portfolio_id portfolio_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE investmentcontext_portfoliomodule_portfolio CHANGE id id INT NOT NULL');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
