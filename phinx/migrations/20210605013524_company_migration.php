<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CompanyMigration extends AbstractMigration
{
    public function up(): void
    {
      $table = $this->table('empresas');
      $table
        ->addColumn('cpf_cnpj', 'string', ['limit' => 14])
        ->addColumn('nome', 'string' , ['limit' => 150])
        ->addColumn('nome_fantasia', 'string', ['limit' => 30])
        ->addColumn('telefone', 'string', ['limit' => 30])
        ->addColumn('whatsapp', 'string', ['limit' => 15])
        ->addColumn('email', 'string', ['limit' => 50])
        ->addTimestamps()
        ->save();
    }


    public function down(): void {
      $this->table('empresas')->drop()->save();
    }
}

