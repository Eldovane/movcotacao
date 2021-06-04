<?php
  namespace App\Providers;

  class HashProvider {
    /**
     * @param string $payload
     * @return string
     */
    public function hash(string $payload): string {
      return password_hash($payload, PASSWORD_DEFAULT);
    }

    public function compare(string $password, string $hash): bool {
      return password_verify($password, $hash);
    }
  }
?>
