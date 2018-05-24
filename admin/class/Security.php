<?php

class Security {

  // Security for input fields
  static function secureString($input) {
    $nohtml = filter_var($input, FILTER_SANITIZE_STRING);
    $trimmed = trim($nohtml);

    return $trimmed;
  }

}
