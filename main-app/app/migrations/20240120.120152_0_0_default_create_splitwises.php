<?php

declare(strict_types=1);

namespace Migration;

use Cycle\Migrations\Migration;

class OrmDefault8ae896d8477240873e02727aa660af43 extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        $this->table('splitwises')
        ->addColumn('api_key', 'string', ['nullable' => false, 'default' => '', 'size' => 255])
        ->addColumn('id', 'bigPrimary', ['nullable' => false, 'default' => null])
        ->addColumn('deleted_at', 'datetime', ['nullable' => true, 'default' => null])
        ->setPrimaryKeys(['id'])
        ->create();
    }

    public function down(): void
    {
        $this->table('splitwises')->drop();
    }
}
