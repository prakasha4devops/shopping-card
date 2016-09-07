<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160907154204 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE boat DROP FOREIGN KEY FK_D86E834AE210F69A');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, qty INT NOT NULL, oder_date DATE NOT NULL, INDEX IDX_F52993984584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, price VARCHAR(255) NOT NULL, date_added VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993984584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('DROP TABLE buttock_angle');
        $this->addSql('DROP INDEX IDX_D86E834AE210F69A ON boat');
        $this->addSql('ALTER TABLE boat ADD length_unit VARCHAR(255) NOT NULL, ADD disp_unit VARCHAR(255) NOT NULL, DROP buttock_angle_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order DROP FOREIGN KEY FK_F52993984584665A');
        $this->addSql('CREATE TABLE buttock_angle (id INT AUTO_INCREMENT NOT NULL, value VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE product');
        $this->addSql('ALTER TABLE boat ADD buttock_angle_id INT NOT NULL, DROP length_unit, DROP disp_unit');
        $this->addSql('ALTER TABLE boat ADD CONSTRAINT FK_D86E834AE210F69A FOREIGN KEY (buttock_angle_id) REFERENCES buttock_angle (id)');
        $this->addSql('CREATE INDEX IDX_D86E834AE210F69A ON boat (buttock_angle_id)');
    }
}
