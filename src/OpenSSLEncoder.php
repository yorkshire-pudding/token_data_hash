<?php

namespace Drupal\token_data_hash;

/**
 *
 */
class OpenSSLEncoder extends Base64Encoder {
  private string $key;

  public function __construct(string $key) {
    $this->setKey($key);
  }

  public function setKey(string $key) {
    $this->key = md5($key);
  }

  public function encode(string $string): string {
    $string = openssl_encrypt($string, 'aes-256-ecb', $this->key, OPENSSL_RAW_DATA);
    $string = trim($string);
    return parent::encode($string);
  }

  public function decode(string $string): string {
    $string = parent::decode($string);
    if (empty($string)) {
      return $string;
    }
    $string = openssl_decrypt($string, 'aes-256-ecb', $this->key, OPENSSL_RAW_DATA);
    return trim($string);
  }

}
