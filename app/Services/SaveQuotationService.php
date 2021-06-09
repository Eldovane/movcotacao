<?php
  namespace App\Services;
  use App\Database\Connection;

class SaveQuotationService {
  public function execute(
      string $company,
      int $quotationNumber,
      array $quotes,
      bool $is_closing
  ) {
    $connection = Connection::getConnection();

    $errors = array();

    array_walk(
      $quotes,
      function($quotation)
      use ($company, $quotationNumber, $is_closing, $connection)
      {
        $setPartOfQuery = "
          valor_ofertado = {$quotation['valor_ofertado']},
          observacao = '{$quotation['observacao']}'
        ";

        if ($is_closing) {
          $setPartOfQuery .= ", data_fechamento = NOW()";
        }

        $updateQuoteQuery = "
          UPDATE movcotacao
          SET {$setPartOfQuery}
            WHERE fornecedor = {$company}
              AND id_sku = {$quotation['id_sku']}
              AND id_produto = {$quotation['id_produto']}
              AND id_referencia = '{$quotation['id_referencia']}'
              AND numero_cotacao = {$quotationNumber}
              LIMIT 1
        ";

        var_dump($quotation);
        print_r($updateQuoteQuery);

        $result = $connection->query($updateQuoteQuery);

        if (!$result) {
          array_push(
            $errors,
            "Não foi possível salvar a alteração feita no item {$quotation['id_produto']}"
          );
        }
      }
    );

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
