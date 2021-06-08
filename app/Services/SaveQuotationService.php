<?php
  namespace App\Services;
  use App\Database\Connection;

class SaveQuotationService {
  public function execute(string $company, array $quotes) {
    $connection = Connection::getConnection();

    $errors = array();

    array_walk($quotes, function($quotation) use ($company, $connection) {
      $updateQuoteQuery = "
        UPDATE movcotacao
        SET
          valor_ofertado = {$quotation['valor_ofertado']},
          observacao = '{$quotation['observacao']}'
            WHERE fornecedor = {$company}
              AND id_sku = {$quotation['id_sku']}
              AND id_produto = {$quotation['id_produto']}
              AND id_referencia = '{$quotation['id_referencia']}'
              LIMIT 1
      ";

      $result = $connection->query($updateQuoteQuery);

      if (!$result) {
        array_push(
          $errors,
          "Não foi possível salvar a alteração feita no item {$quotation['id_produto']}"
        );
      }
    });

    $connection->close();

    $error = count($errors) > 0
      ? [
        'quotationNumber' => $quotes[0]['numero_cotacao'],
        'errors' => $errors,
      ]
      : null;

    return [
      'error' => $error
    ];
  }
}
?>
