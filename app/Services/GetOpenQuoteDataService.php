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
          AND data_validade >= NOW();
    ";

    $listQuotesOpening = $connection
      ->query($listQuotesOpeningQuery)
      ->fetch_all(MYSQLI_ASSOC);

    $companyQuery = "
      SELECT * FROM empresas
        WHERE id = {$listQuotesOpening[0]['comprador']}
    ";

    $company = $connection->query($companyQuery)->fetch_assoc();

    $openingDate = date_create($listQuotesOpening[0]['data_abertura']);
    $closingDate = date_create($listQuotesOpening[0]['data_validade']);

    $quotationInfo = array(
      'numero_cotacao' => $listQuotesOpening[0]['numero_cotacao'],
      'data_abertura' => date_format($openingDate, 'd/m/Y H:i:s'),
      'data_validade' => date_format($closingDate, 'd/m/Y H:i:s')
    );

    array_merge($quotationInfo, $company);

    $connection->close();

    return [
      'listQuotesOpening' => $listQuotesOpening,
      'company' => $company,
      'quotationInfo' => $quotationInfo
    ];
  }
  }
?>
