<?php
  namespace App\Services;
  use App\Database\Connection;

class GetOpenQuoteDataService {
  public function execute(string $company, int $quoteNumber) {
    $connection = Connection::getConnection();

    $listQuotesOpeningQuery = "
      SELECT * FROM movcotacao
        WHERE fornecedor = {$company}
          AND numero_cotacao  = {$quoteNumber}
          AND status = 'Aberta'
          AND data_abertura <= NOW()
          AND data_validade >= NOW()
          ORDER BY id_sku;
    ";

    $listQuotesOpening = $connection
      ->query($listQuotesOpeningQuery)
      ->fetch_all(MYSQLI_ASSOC);

    $clientCompanyQuery = "
      SELECT * FROM empresas
        WHERE id = {$listQuotesOpening[0]['comprador']}
    ";

    $clientCompany = $connection->query($clientCompanyQuery)->fetch_assoc();

    $openingDate = date_create($listQuotesOpening[0]['data_abertura']);
    $closingDate = date_create($listQuotesOpening[0]['data_validade']);

    $quotationInfo = array(
      'numero_cotacao' => $listQuotesOpening[0]['numero_cotacao'],
      'data_abertura' => date_format($openingDate, 'd/m/Y H:i:s'),
      'data_validade' => date_format($closingDate, 'd/m/Y H:i:s'),
      'comprador' => $clientCompany['id']
    );

    $quotationInfo = array_merge($quotationInfo, $clientCompany);

    unset($quotationInfo['id']);

    $connection->close();

    return [
      'listQuotesOpening' => $listQuotesOpening,
      'quotationInfo' => $quotationInfo
    ];
  }
  }
?>
