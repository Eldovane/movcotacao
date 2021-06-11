<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddNewColumnNewItemInQuotes extends AbstractMigration
{
    public function up(): void
    {
      $table = $this->table('movcotacao');

      $table
        ->addColumn('novo_item', 'integer', ['null' => true])
        ->update();
    }

    public function down(): void {
      $table = $this->table('movcotacao');

      $table
        ->removeColumn('novo_item')
        ->update();
    }
}
