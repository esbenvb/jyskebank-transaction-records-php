<?php

class JyskeBankTransaction {
  private $header;
  private $footer;
  private $records = array();
  private $date;
  private $sum = 0.0;
  
  public function __construct($date = NULL) {
    $this->date = $date ? $date : time();
  }
  
  public function addRecord(JyskeBankTransactionRecord $record) {
    array_push($this->records, $record);
    return $this;
  }
  
  public function finish() {
    $this->header = new JyskeBankTransactionHeader($this->date);
    foreach ($this->records as $record) {
      $this->sum += $record->getAmount(TRUE);
    }
    $this->footer = new JyskeBankTransactionFooter($this->sum, count($this->records), $this->date);
    return $this;
  }
  
  public function export() {
    $lines = array();
    $lines = array_merge($lines, $this->header->generateLines());
    foreach ($this->records as $record) {
       $lines = array_merge($lines, $record->generateLines());
    }
    $lines = array_merge($lines, $this->footer->generateLines());
    $text = implode("\r\n", $lines);
    $text .= "\r\n";
    return $text;
  }
}
