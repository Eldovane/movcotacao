<?php
  namespace App\Services;
  use App\Database\Connection;

class SaveQuotationService {
  public function execute(
      int $company,
      array $quotationInfo,
      array $quotes,
      bool $is_closing
  ) {
    $connection = Connection::getConnection();

    $errors = array();

    array_walk(
      $quotes,
      function($quotation)
      use ($company, $quotationInfo, $is_closing, $connection)
      {
        $valueOffered = $quotation['valor_ofertado']
          ? "{$quotation['valor_ofertado']}" : "NULL";
        $observation = $quotation['observacao']
          ? "'{$quotation['observacao']}'" : "NULL";

        if (isset($quotation['new_item'])) {
          $closingDateValue = "NULL";

          if ($is_closing) {
            $closingDateValue .= "NOW()";
          }

          $openingDate = date_create_from_format(
            'd/m/Y H:i:s',
            $quotationInfo['data_abertura']
          );
          $closingDate = date_create_from_format(
            'd/m/Y H:i:s',
            $quotationInfo['data_validade']
          );

          $openingDate = date_format($openingDate, 'Y-m-d H:i:s');
          $closingDate = date_format($closingDate, 'Y-m-d H:i:s');

          $insertNewItemQuery = "
           INSERT INTO movcotacao
            (
              comprador,
              fornecedor,
              numero_cotacao,
              id_sku,
              id_produto,
              id_referencia,
              descricao_produto,
              quantidade_produto,
              valor_ofertado,
              observacao,
              data_abertura,
              data_fechamento,
              status,
              data_validade,
              novo_item
            ) VALUES
            (
              {$quotationInfo['comprador']},
              {$company},
              {$quotationInfo['numero_cotacao']},
              {$quotation['id_sku']},
              NULL,
              '{$quotation['id_referencia']}',
              '{$quotation['descricao_produto']}',
              {$quotation['quantidade_produto']},
              {$valueOffered},
              {$observation},
              '{$openingDate}',
              {$closingDateValue},
              'Aberta',
              '{$closingDate}',
              1
            );
          ";

          $result = $connection->query($insertNewItemQuery);

          if (!$result) {
            array_push(
              $errors,
              "Não foi possível salvar o novo item adicionado com código produto: {$quotation['id_produto']}"
            );
          }
        } else if (isset($quotation['removed_item'])) {
          $deleteQuotationItemQuery = "
            DELETE FROM movcotacao
              WHERE id = {$quotation['id']} AND id_sku = {$quotation['id_sku']}
              LIMIT 1
          ";

          $result = $connection->query($deleteQuotationItemQuery);

          if (!$result) {
            array_push(
              $errors,
              "Não foi possível remover o item {$quotation['id']}-{$quotation['id_sku']}"
            );
          }
        } else if (isset($quotation['new_item_created'])) {
          $setPartOfQuery = "
            valor_ofertado = {$valueOffered},
            observacao = {$observation},
            id_referencia = '{$quotation['id_referencia']}',
            descricao_produto = '{$quotation['descricao_produto']}',
            quantidade_produto = {$quotation['quantidade_produto']}
          ";

          if ($is_closing) {
            $setPartOfQuery .= ", data_fechamento = NOW()";
          }

          $updateQuoatationItemQuery = "
            UPDATE movcotacao
            SET {$setPartOfQuery}
              WHERE fornecedor = {$company}
                AND id = {$quotation['id']}
                AND numero_cotacao = {$quotationInfo['numero_cotacao']}
                LIMIT 1
          ";

          $result = $connection->query($updateQuoatationItemQuery);

          if (!$result) {
            array_push(
              $errors,
              "Não foi possível salvar a alteração feita no item {$quotation['id_produto']}"
            );
          }
        } else {
          $setPartOfQuery = "
            valor_ofertado = {$valueOffered},
            observacao = '{$observation}',
          ";

          if ($is_closing) {
            $setPartOfQuery .= ", data_fechamento = NOW()";
          }

          $updateQuoatationItemQuery = "
            UPDATE movcotacao
            SET {$setPartOfQuery}
              WHERE fornecedor = {$company}
                AND id = {$quotation['id']}
                AND id_sku = {$quotation['id_sku']}
                AND id_produto = {$quotation['id_produto']}
                AND id_referencia = '{$quotation['id_referencia']}'
                AND numero_cotacao = {$quotationInfo['numero_cotacao']}
                LIMIT 1
          ";

          $result = $connection->query($updateQuoatationItemQuery);

          if (!$result) {
            array_push(
              $errors,
              "Não foi possível salvar a alteração feita no item {$quotation['id_produto']}"
            );
          }
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
