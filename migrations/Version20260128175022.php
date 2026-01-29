<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260128175022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profile ADD created_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE profile ADD updated_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE profile ADD deleted_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE profile ADD is_deleted BOOLEAN DEFAULT false NOT NULL');
        $this->addSql('ALTER TABLE profile ALTER bio SET DEFAULT \'\'');
        $this->addSql('ALTER TABLE profile ALTER followers SET DEFAULT 0');
        $this->addSql('ALTER TABLE profile ALTER following SET DEFAULT 0');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8157AA0FF85E0677 ON profile (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8157AA0FE7927C74 ON profile (email)');
        $this->addSql('ALTER TABLE profile_xlike ADD created_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE profile_xlike ADD updated_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE profile_xlike ADD deleted_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE profile_xlike ADD is_deleted BOOLEAN DEFAULT false NOT NULL');
        $this->addSql('ALTER TABLE profile_xlike ALTER profile_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE profile_xlike ALTER ver_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE profile_xprofile ADD created_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE profile_xprofile ADD updated_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE profile_xprofile ADD deleted_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE profile_xprofile ADD is_deleted BOOLEAN DEFAULT false NOT NULL');
        $this->addSql('ALTER TABLE profile_xprofile ALTER profile_one_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE profile_xprofile ALTER profile_two_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE response ADD created_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE response ADD updated_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE response ADD deleted_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE response ADD is_deleted BOOLEAN DEFAULT false NOT NULL');
        $this->addSql('ALTER TABLE response ALTER ver_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE ver ADD created_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE ver ADD updated_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE ver ADD deleted_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE ver ADD is_deleted BOOLEAN DEFAULT false NOT NULL');
        $this->addSql('ALTER TABLE ver ALTER user_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE ver ALTER likes SET DEFAULT 0');
        $this->addSql('ALTER TABLE ver ALTER comments SET DEFAULT 0');
        $this->addSql('ALTER TABLE ver ALTER shares SET DEFAULT 0');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_8157AA0FF85E0677');
        $this->addSql('DROP INDEX UNIQ_8157AA0FE7927C74');
        $this->addSql('ALTER TABLE profile DROP created_date');
        $this->addSql('ALTER TABLE profile DROP updated_date');
        $this->addSql('ALTER TABLE profile DROP deleted_date');
        $this->addSql('ALTER TABLE profile DROP is_deleted');
        $this->addSql('ALTER TABLE profile ALTER bio DROP DEFAULT');
        $this->addSql('ALTER TABLE profile ALTER followers DROP DEFAULT');
        $this->addSql('ALTER TABLE profile ALTER following DROP DEFAULT');
        $this->addSql('ALTER TABLE profile_xlike DROP created_date');
        $this->addSql('ALTER TABLE profile_xlike DROP updated_date');
        $this->addSql('ALTER TABLE profile_xlike DROP deleted_date');
        $this->addSql('ALTER TABLE profile_xlike DROP is_deleted');
        $this->addSql('ALTER TABLE profile_xlike ALTER profile_id TYPE INT');
        $this->addSql('ALTER TABLE profile_xlike ALTER ver_id TYPE INT');
        $this->addSql('ALTER TABLE profile_xprofile DROP created_date');
        $this->addSql('ALTER TABLE profile_xprofile DROP updated_date');
        $this->addSql('ALTER TABLE profile_xprofile DROP deleted_date');
        $this->addSql('ALTER TABLE profile_xprofile DROP is_deleted');
        $this->addSql('ALTER TABLE profile_xprofile ALTER profile_one_id TYPE INT');
        $this->addSql('ALTER TABLE profile_xprofile ALTER profile_two_id TYPE INT');
        $this->addSql('ALTER TABLE response DROP created_date');
        $this->addSql('ALTER TABLE response DROP updated_date');
        $this->addSql('ALTER TABLE response DROP deleted_date');
        $this->addSql('ALTER TABLE response DROP is_deleted');
        $this->addSql('ALTER TABLE response ALTER ver_id TYPE INT');
        $this->addSql('ALTER TABLE ver DROP created_date');
        $this->addSql('ALTER TABLE ver DROP updated_date');
        $this->addSql('ALTER TABLE ver DROP deleted_date');
        $this->addSql('ALTER TABLE ver DROP is_deleted');
        $this->addSql('ALTER TABLE ver ALTER user_id TYPE INT');
        $this->addSql('ALTER TABLE ver ALTER likes DROP DEFAULT');
        $this->addSql('ALTER TABLE ver ALTER comments DROP DEFAULT');
        $this->addSql('ALTER TABLE ver ALTER shares DROP DEFAULT');
    }
}
