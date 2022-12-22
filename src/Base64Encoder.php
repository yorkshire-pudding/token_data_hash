<?php

namespace Drupal\token_data_hash;

/**
 *
 */
class Base64Encoder extends EncoderBase {

  /**
   * {@inheritDoc}
   */
  public function encode(string $string): string {
    $data = base64_encode($string);

    // Modify the output so it's safe to use in URLs.
    // Borrowed from D7 drupal_base64_encode.
    return strtr($data, [
      '+' => '-',
    ]);
  }

  /**
   * {@inheritDoc}
   */
  public function decode(string $string): string {
    $data = strtr($string, [
      '-' => '+',
    ]);

    return base64_decode($data);
  }

}
