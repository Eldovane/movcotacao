<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class QuotesMigration extends AbstractMigration
{
    public function up(): void
    {
      $table = $this->table('movcotacao');
      $table
        // Id empresa compradora.
        ->addColumn('comprador', 'integer')
        // Id empresa fornecedora.
        ->addColumn('fornecedor', 'integer')
        // Número da cotação.
        ->addColumn('numero_cotacao', 'integer')
        // Código do produto de acordo com a cotação.
        ->addColumn('id_produto', 'string', ['limit' => 15])
        // Referência para saber quais produtos são similares / desenho.
        ->addColumn('id_sku', 'string', ['limit' => 50])
        // Referência do produto no fabricante.
        ->addColumn('id_referencia', 'string', ['limit' => 50])
        ->addColumn('descricao_produto', 'string', ['limit' => 150])
        ->addColumn('quantidade_produto', 'float')
        ->addColumn('valor_ofertado', 'float', ['null' => true])
        ->addColumn('observacao', 'string', ['limit' => 250, 'null' => true])
        ->addColumn('data_abertura', 'datetime')
        ->addColumn('data_fechamento', 'datetime', ['null' => true])
        ->addColumn(
          'status', 'enum',
          ['values' => ['Aberta', 'Fechada'], 'default' => "'Aberta'"]
        )
        ->addColumn('data_validade', 'datetime')
        ->save();
    }


    public function down(): void {
      $this->table('movcotacao')->drop()->save();
    }
}
