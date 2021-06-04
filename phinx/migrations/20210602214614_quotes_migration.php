<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class QuotesMigration extends AbstractMigration
{
    public function up(): void
    {
      $table = $this->table('movcotacao');
      $table
        ->addColumn('idsku', 'string', ['limit' => 50])
        ->addColumn('idreferencia', 'string', ['limit' => 50])
        ->addColumn('descricao_produto', 'string', ['limit' => 150])
        ->addColumn('quantidadeproduto', 'float')
        ->addColumn('valorofertado', 'float')
        ->addColumn('observacao', 'string', ['limit' => 250])
        ->addColumn('numerocotacao', 'integer')
        ->addColumn('dataabertura', 'datetime')
        ->addColumn('datafechamento', 'datetime')
        ->addTimestamps()
        ->save();
    }


    public function down(): void {
      $this->table('movcotacao')->drop()->save();
    }
}
