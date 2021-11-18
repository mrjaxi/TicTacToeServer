<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211118122337 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(50) NOT NULL, password VARCHAR(255) NOT NULL, usertoken VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_data (matchid INT AUTO_INCREMENT NOT NULL, bot TINYINT(1) NOT NULL, winner TINYINT(1) NOT NULL, left_state VARCHAR(255) NOT NULL, right_state VARCHAR(255) NOT NULL, images_id LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', date VARCHAR(255) NOT NULL, userId INT NOT NULL, FOREIGN KEY (userId) REFERENCES users (id) ON DELETE CASCADE, PRIMARY KEY(matchid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, userid INT NOT NULL, relmatchid INT NOT NULL, FOREIGN KEY (userid) REFERENCES users (id) ON DELETE CASCADE, FOREIGN KEY (relmatchid) REFERENCES game_data (matchid) ON DELETE CASCADE, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_data');
        $this->addSql('DROP TABLE users');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
