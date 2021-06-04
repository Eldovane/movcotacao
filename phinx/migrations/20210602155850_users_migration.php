<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UsersMigration extends AbstractMigration
{
    public function up(): void
    {
      $table = $this->table('usuarios');
      $table
        ->addColumn('nome', 'string', ['limit' => 60])
        ->addColumn('email', 'string', ['limit' => 50])
        ->addColumn('usuario', 'string', ['limit' => 50])
        ->addColumn('senha', 'string', ['limit' => 80])
        ->addColumn('documento', 'string', ['limit' => 14])
        ->addColumn(
          'tipo', 'enum', ['values' => ["Fornecedor", "Comprador", "Fornecedor/Comprador"]]
        )
        ->addColumn('codigo_recuperar_senha', 'string', ['limit' => 6, 'null' => true])
        ->addColumn('token_recuperar_senha', 'string', ['limit' => 50, 'null' => true])
        ->addTimestamps()
        ->save();
    }

    public function down(): void
    {
      $this->table('usuarios')->drop()->save();
    }
}
