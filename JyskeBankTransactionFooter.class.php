<?php
define('JYSKEBANK_FOOTER_TYPE', 'IB999999999999');

class JyskeBankTransactionFooter extends JyskeBankRecord {
  
  private $sum;
  private $number;

  public function __construct($sum, $number, $date = NULL) {
    $this->type = JYSKEBANK_FOOTER_TYPE;
    $this->sum = $sum;
    $this->number = $number;
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
          'content' => $this->number,
          'length' => 6,
          'type' => 'number',
        ),
        array(
          'content' => $this->formatAmount($this->sum),
          // 13 digits and +
          'length' => 14,
          'type' => 'number',
        ),
        array(
          'length' => 64,
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