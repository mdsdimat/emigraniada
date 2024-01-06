<?php

declare(strict_types=1);

namespace Migration;

use Cycle\Migrations\Migration;

class OrmDefault4c7165576b417b7e175ba52d9eeb865c extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        $this->table('checks')
        ->addColumn('id', 'bigPrimary', ['nullable' => false, 'default' => null])
        ->addColumn('deleted_at', 'datetime', ['nullable' => true, 'default' => null])
        ->setPrimaryKeys(['id'])
        ->create();

        $this->table('files')
        ->addColumn('file_path', 'string', ['nullable' => false, 'default' => null, 'size' => 255])
        ->addColumn('file_name', 'string', ['nullable' => false, 'default' => null, 'size' => 255])
        ->addColumn('id', 'bigPrimary', ['nullable' => false, 'default' => null])
        ->addColumn('deleted_at', 'datetime', ['nullable' => true, 'default' => null])
        ->addColumn('check_id', 'bigInteger', ['nullable' => false, 'default' => null])
        ->addIndex(['check_id'], ['name' => 'files_index_check_id_6599219024311', 'unique' => false])
        ->addForeignKey(['check_id'], 'checks', ['id'], [
            'name' => 'files_foreign_check_id_6599219024320',
            'delete' => 'CASCADE',
            'update' => 'CASCADE',
            'indexCreate' => true,
        ])
        ->setPrimaryKeys(['id'])
        ->create();
    }

    public function down(): void
    {
        $this->table('files')->drop();
        $this->table('checks')->drop();
    }
}
