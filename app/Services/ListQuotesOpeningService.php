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

    return $listQuotesOpening;
  }
}
?>
