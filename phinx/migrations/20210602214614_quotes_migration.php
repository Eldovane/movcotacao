<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class QuotesMigration extends AbstractMigration
{
    public function up(): void
    {
      $table = $this->table('movcotacao');
      $table
        ->addColumn('comprador', 'integer') // Id empresa compradora.
        ->addColumn('fornecedor', 'integer') // Id empresa fornecedora.
        ->addColumn('numero_cotacao', 'integer') // Número da cotação.
        ->addColumn('id_produto', 'string', ['limit' => 15]) // Código do produto de acordo com a cotação.
        ->addColumn('id_sku', 'string', ['limit' => 50]) // Referência para saber quais produtos são similares / desenho.
        ->addColumn('id_referencia', 'string', ['limit' => 50]) // Referência do produto no fabricante.
        ->addColumn('descricao_produto', 'string', ['limit' => 150])
        ->addColumn('quantidade_produto', 'float')
        ->addColumn('valor_ofertado', 'float')
        ->addColumn('observacao', 'string', ['limit' => 250])
        ->addColumn('data_abertura', 'datetime')
        ->addColumn('data_fechamento', 'datetime')
        ->addColumn('status', 'enum', ['values' => ['Aberta', 'Fechada']])
        ->addColumn('data_validade', 'datetime')
        ->save();
    }


    public function down(): void {
      $this->table('movcotacao')->drop()->save();
    }
}
