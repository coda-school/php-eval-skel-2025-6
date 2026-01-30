<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260129200407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profile CHANGE password password VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE profile_xlike ADD profile_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE profile_xlike ADD ver_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE profile_xlike DROP profile_id');
        $this->addSql('ALTER TABLE profile_xlike DROP ver_id');
        $this->addSql('ALTER TABLE profile_xlike ADD CONSTRAINT FK_75735C6E88900185 FOREIGN KEY (profile_id_id) REFERENCES profile (id) NOT DEFERRABLE');
        $this->addSql('ALTER TABLE profile_xlike ADD CONSTRAINT FK_75735C6EC2F21244 FOREIGN KEY (ver_id_id) REFERENCES ver (id) NOT DEFERRABLE');
        $this->addSql('CREATE INDEX IDX_75735C6E88900185 ON profile_xlike (profile_id_id)');
        $this->addSql('CREATE INDEX IDX_75735C6EC2F21244 ON profile_xlike (ver_id_id)');
        $this->addSql('ALTER TABLE profile_xprofile ADD profile_one_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE profile_xprofile ADD profile_two_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE profile_xprofile DROP profile_one_id');
        $this->addSql('ALTER TABLE profile_xprofile DROP profile_two_id');
        $this->addSql('ALTER TABLE profile_xprofile ADD CONSTRAINT FK_FFC6418C811DB103 FOREIGN KEY (profile_one_id_id) REFERENCES profile (id) NOT DEFERRABLE');
        $this->addSql('ALTER TABLE profile_xprofile ADD CONSTRAINT FK_FFC6418C680C18E1 FOREIGN KEY (profile_two_id_id) REFERENCES profile (id) NOT DEFERRABLE');
        $this->addSql('CREATE INDEX IDX_FFC6418C811DB103 ON profile_xprofile (profile_one_id_id)');
        $this->addSql('CREATE INDEX IDX_FFC6418C680C18E1 ON profile_xprofile (profile_two_id_id)');
        $this->addSql('ALTER TABLE response ADD ver_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE response DROP ver_id');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_3E7B0BFBC2F21244 FOREIGN KEY (ver_id_id) REFERENCES ver (id) NOT DEFERRABLE');
        $this->addSql('CREATE INDEX IDX_3E7B0BFBC2F21244 ON response (ver_id_id)');
        $this->addSql('ALTER TABLE ver ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE ver DROP user_id');
        $this->addSql('ALTER TABLE ver ADD CONSTRAINT FK_9BC42029D86650F FOREIGN KEY (user_id_id) REFERENCES profile (id) NOT DEFERRABLE');
        $this->addSql('CREATE INDEX IDX_9BC42029D86650F ON ver (user_id_id)');
        $this->addSql('ALTER TABLE profile DROP created_date');
        $this->addSql('ALTER TABLE ver DROP created_date');
        $this->addSql('ALTER TABLE profile_xlike DROP created_date');
        $this->addSql('ALTER TABLE profile_xprofile DROP created_date');
        $this->addSql('ALTER TABLE response DROP created_date');
        $this->addSql('ALTER TABLE profile DROP updated_date');
        $this->addSql('ALTER TABLE ver DROP updated_date');
        $this->addSql('ALTER TABLE profile_xlike DROP updated_date');
        $this->addSql('ALTER TABLE profile_xprofile DROP updated_date');
        $this->addSql('ALTER TABLE response DROP updated_date');
        $this->addSql('ALTER TABLE profile DROP deleted_date');
        $this->addSql('ALTER TABLE ver DROP deleted_date');
        $this->addSql('ALTER TABLE profile_xlike DROP deleted_date');
        $this->addSql('ALTER TABLE profile_xprofile DROP deleted_date');
        $this->addSql('ALTER TABLE response DROP deleted_date');
        $this->addSql('ALTER TABLE profile DROP is_deleted');
        $this->addSql('ALTER TABLE ver DROP is_deleted');
        $this->addSql('ALTER TABLE profile_xlike DROP is_deleted');
        $this->addSql('ALTER TABLE profile_xprofile DROP is_deleted');
        $this->addSql('ALTER TABLE response DROP is_deleted');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profile_xlike DROP CONSTRAINT FK_75735C6E88900185');
        $this->addSql('ALTER TABLE profile_xlike DROP CONSTRAINT FK_75735C6EC2F21244');
        $this->addSql('DROP INDEX IDX_75735C6E88900185');
        $this->addSql('DROP INDEX IDX_75735C6EC2F21244');
        $this->addSql('ALTER TABLE profile_xlike ADD profile_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE profile_xlike ADD ver_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE profile_xlike DROP profile_id_id');
        $this->addSql('ALTER TABLE profile_xlike DROP ver_id_id');
        $this->addSql('ALTER TABLE profile_xprofile DROP CONSTRAINT FK_FFC6418C811DB103');
        $this->addSql('ALTER TABLE profile_xprofile DROP CONSTRAINT FK_FFC6418C680C18E1');
        $this->addSql('DROP INDEX IDX_FFC6418C811DB103');
        $this->addSql('DROP INDEX IDX_FFC6418C680C18E1');
        $this->addSql('ALTER TABLE profile_xprofile ADD profile_one_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE profile_xprofile ADD profile_two_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE profile_xprofile DROP profile_one_id_id');
        $this->addSql('ALTER TABLE profile_xprofile DROP profile_two_id_id');
        $this->addSql('ALTER TABLE response DROP CONSTRAINT FK_3E7B0BFBC2F21244');
        $this->addSql('DROP INDEX IDX_3E7B0BFBC2F21244');
        $this->addSql('ALTER TABLE response ADD ver_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE response DROP ver_id_id');
        $this->addSql('ALTER TABLE ver DROP CONSTRAINT FK_9BC42029D86650F');
        $this->addSql('DROP INDEX IDX_9BC42029D86650F');
        $this->addSql('ALTER TABLE ver ADD user_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE ver DROP user_id_id');
    }
}
