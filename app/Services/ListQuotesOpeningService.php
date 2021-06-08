<?php
  namespace App\Services;
  use App\Database\Connection;

class ListQuotesOpeningService {
  public function execute(string $company) {
    $connection = Connection::getConnection();

    $listQuotesOpeningQuery = "
      SELECT * FROM ibmax01.movcotacao
        WHERE fornecedor = {$company}
        GROUP BY numero_cotacao ;
    ";

    $listQuotesOpening = $connection
      ->query($listQuotesOpeningQuery)
      ->fetch_all(MYSQLI_ASSOC);

    $serializedListQuotesOpening = array_map(
      function($quotation) use ($connection) {
        $getClientCompanyQuery = "
          SELECT nome_fantasia FROM empresas
            WHERE id = {$quotation['comprador']}
        ";

        $clientCompany = $connection->query($getClientCompanyQuery)->fetch_assoc();

        $openingDate = date_create($quotation['data_abertura']);
        $closingDate = date_create($quotation['data_validade']);

        return [
          'comprador' => $clientCompany['nome_fantasia'],
          'numero_cotacao' => $quotation['numero_cotacao'],
          'data_abertura' => date_format($openingDate, 'd/m/Y H:i:s'),
          'data_validade' => date_format($closingDate, 'd/m/Y H:i:s')
        ];
      },
      $listQuotesOpening
    );

    $connection->close();

    return $serializedListQuotesOpening;
  }
}
?>
