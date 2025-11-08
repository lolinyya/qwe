<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251108170837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE orders_dishes (orders_id INTEGER NOT NULL, dishes_id INTEGER NOT NULL, PRIMARY KEY(orders_id, dishes_id), CONSTRAINT FK_F9DDEA8CCFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F9DDEA8CA05DD37A FOREIGN KEY (dishes_id) REFERENCES dishes (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_F9DDEA8CCFFE9AD6 ON orders_dishes (orders_id)');
        $this->addSql('CREATE INDEX IDX_F9DDEA8CA05DD37A ON orders_dishes (dishes_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__orders AS SELECT id FROM orders');
        $this->addSql('DROP TABLE orders');
        $this->addSql('CREATE TABLE orders (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, people_id INTEGER NOT NULL, CONSTRAINT FK_E52FFDEE3147C936 FOREIGN KEY (people_id) REFERENCES people (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO orders (id) SELECT id FROM __temp__orders');
        $this->addSql('DROP TABLE __temp__orders');
        $this->addSql('CREATE INDEX IDX_E52FFDEE3147C936 ON orders (people_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE orders_dishes');
        $this->addSql('CREATE TEMPORARY TABLE __temp__orders AS SELECT id FROM orders');
        $this->addSql('DROP TABLE orders');
        $this->addSql('CREATE TABLE orders (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('INSERT INTO orders (id) SELECT id FROM __temp__orders');
        $this->addSql('DROP TABLE __temp__orders');
    }
}
