<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240808090600 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE developer ADD birthday DATE NOT NULL');
        $this->addSql('ALTER TABLE developer ADD skills TEXT NOT NULL');
        $this->addSql('ALTER TABLE developer ADD experience_years INT NOT NULL');
        $this->addSql('ALTER TABLE developer ADD hire_date DATE NOT NULL');
        $this->addSql('ALTER TABLE developer ADD salary NUMERIC(10, 1) NOT NULL');
        $this->addSql('ALTER TABLE developer ADD status VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE developer ADD address VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE developer ADD notes TEXT NOT NULL');
        $this->addSql('ALTER TABLE project ADD start_date DATE NOT NULL');
        $this->addSql('ALTER TABLE project ADD end_date DATE NOT NULL');
        $this->addSql('ALTER TABLE project ADD budget NUMERIC(15, 2) NOT NULL');
        $this->addSql('ALTER TABLE project ADD status VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE project ADD project_manager VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE project ADD documents TEXT NOT NULL');
        $this->addSql('ALTER TABLE project ADD priority VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE project ADD technologies TEXT NOT NULL');
        $this->addSql('ALTER TABLE project ADD notes TEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE project DROP start_date');
        $this->addSql('ALTER TABLE project DROP end_date');
        $this->addSql('ALTER TABLE project DROP budget');
        $this->addSql('ALTER TABLE project DROP status');
        $this->addSql('ALTER TABLE project DROP project_manager');
        $this->addSql('ALTER TABLE project DROP documents');
        $this->addSql('ALTER TABLE project DROP priority');
        $this->addSql('ALTER TABLE project DROP technologies');
        $this->addSql('ALTER TABLE project DROP notes');
        $this->addSql('ALTER TABLE developer DROP birthday');
        $this->addSql('ALTER TABLE developer DROP skills');
        $this->addSql('ALTER TABLE developer DROP experience_years');
        $this->addSql('ALTER TABLE developer DROP hire_date');
        $this->addSql('ALTER TABLE developer DROP salary');
        $this->addSql('ALTER TABLE developer DROP status');
        $this->addSql('ALTER TABLE developer DROP address');
        $this->addSql('ALTER TABLE developer DROP notes');
    }
}
