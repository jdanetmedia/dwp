<?php

class Security {

  // Security for input fields
  static function secureString($input) {
    $nohtml = filter_var($input, FILTER_SANITIZE_STRING);
    $trimmed = trim($nohtml);

    return $trimmed;
  }

  static function secureInt($input) {
    $nohtml = filter_var($input, FILTER_SANITIZE_INT);
    $trimmed = trim($nothtml);

    return $trimmed;
  }

  static function secureEmail($input) {
    $nohtml = filter_var($input, FILTER_SANITIZE_EMAIL);
    $trimmed = trim($nothtml);

    return $trimmed;
  }

}
