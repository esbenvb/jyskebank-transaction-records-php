<?php

class JyskeBankTransaction {
  private $header;
  private $footer;
  private $records = array();
  private $date;
  private $sum = 0.0;
  public $sourceEncoding = 'UTF-8';
  public $destinationEncoding = 'CP865';

  public function __construct($date = NULL) {
    $this->date = $date ? $date : time();
  }

  // Set the source and destination encodings.
  public function setEncoding($source, $destination) {
    $this->sourceEncoding = $source;
    $this->destinationEncoding = $destination;
  }

  // Add a record to the transaction.
  public function addRecord(JyskeBankTransactionRecord $record) {
    $record->setTransaction($this);
    array_push($this->records, $record);
    return $this;
  }
  
  // Finishes the transaction by calculating stats etc.
  public function finish() {
    $this->header = new JyskeBankTransactionHeader($this->date);
    foreach ($this->records as $record) {
      $this->sum += $record->getAmount(TRUE);
    }
    $this->footer = new JyskeBankTransactionFooter($this->sum, count($this->records), $this->date);
    return $this;
  }
  
  // Export the transaction data into a string used for the file.
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
