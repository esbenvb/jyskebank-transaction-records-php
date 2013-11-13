<?php
define('JYSKEBANK_HEADER_TYPE', 'IB000000000000');

class JyskeBankTransactionHeader extends JyskeBankRecord {
  public function __construct($date = NULL) {
    $this->type = JYSKEBANK_HEADER_TYPE;
    parent::__construct($date);
  }
  
  protected function recordStructure() {
    return array(
      array(
        array(
          'content' => $this->type,
          'length' => 14,
          'type' => 'text',
        ),
        array(
          'content' => $this->formatDate($this->date),
          'length' => 8,
          'type' => 'number',
        ),
        array(
          'length' => 90,
          'type' => 'space',
        ),
        array(
          'length' => 255,
          'type' => 'space',
        ),
        array(
          'length' => 255,
          'type' => 'space',
        ),
        array(
          'length' => 255,
          'type' => 'space',
        ),
      ),
    );
  }
}
