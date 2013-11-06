<?php

class JyskeBankTransaction {
  private $header;
  private $footer;
  private $records;
  private $date;
  private $sum;
  
  public function __construct($date = NULL) {
    $this->date = $date ? $date : time();
    $this->records = array();
    $this->sum = 0;
  }
  
  public function addRecord(JyskeBankTransactionRecord $record) {
    array_push($this->records, $record);
    $this->sum += $record->getAmount(TRUE);
  }
  
  public function finish() {
    $this->footer = new JyskeBankTransactionFooter($this->total, $this->number, $this->date);
    $this->header = new JyskeBankTransactionHeader($this->date);
  }
  
  public function export() {
    $lines = array();
    $lines += $this->header->generateLines();
    foreach ($this->records as $record) {
      $lines += $record->generateLines();
    }
    $lines += $this->footer->generateLines();
    $text = implode("\r\n", $lines);
    $text .= "\r\n";
    return $text;
  }
}
