<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class VacancyTableMigration extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up(): void
    {
        $table = $this->table('vacancies');
        $table
            ->addColumn('title', 'string')
            ->addColumn('description', 'text')
            ->addColumn('workplace', 'string')
            ->addColumn('salary', 'float')
            ->addColumn('status', 'smallinteger')
            ->create();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $table = $this->table('vacancies');
        $table->drop();
    }
}
