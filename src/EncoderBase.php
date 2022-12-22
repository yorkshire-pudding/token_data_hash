<?php

namespace Drupal\token_data_hash;

/**
 *
 */
abstract class EncoderBase {

  /**
   * @param string $string
   * @return string
   */
  public abstract function encode(string $string): string;

  /**
   * @param string $string
   * @return string
   */
  public abstract function decode(string $string): string;
}
