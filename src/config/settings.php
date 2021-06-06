<?php
  return [
    'app_url' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'
      ? 'https://' . $_SERVER['HTTP_HOST']
      : 'http://' . $_SERVER['HTTP_HOST']
  ];

?>
