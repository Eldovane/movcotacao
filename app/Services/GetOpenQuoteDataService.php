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

    return [
      'listQuotesOpening' => $listQuotesOpening,
      'company' => $company
    ];
  }
  }
?>
