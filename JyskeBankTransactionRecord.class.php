<?php

define('JYSKEBANK_DOMESTIC_TRANSACTION_RECORD_FROM_FINANCE_ACCOUNT', 1);
define('JYSKEBANK_DOMESTIC_TRANSACTION_RECORD_FROM_BANK_ACCOUNT', 2);

abstract class JyskeBankTransactionRecord implements JyskeBankRecord {
  private $fromType;
  private $fromAccount;

  private $entryText;
  private $name;
  private $reference;
  private $message;

  
  // ISO 4217
  private $currency;
  
  // Float
  private $amount;
  
  // Unix timestamp 
  private $date;
  
  
  public function __construct($date) {
    $this->date = $date;
  }
  
  abstract public function setRecipient($name, $data);
  
  public function setAmount ($amount, $currency) {
    $this->amount = $amount;
    $this->currency = $currency;
    return $this;
  }
  
  public function getAmount ($as_number = FALSE) {
    if ($as_number) {
      return $this->amount;
    }
    return array('amount' => $this->amount, 'currency' => $this->currency);
  }
  
  public function setDate($date) {
    $this->date = $date;
    return $this;
  }

  public function setMessage($message) {
    $this->message = $message;
    return $this;
  }
  
  public function setSource($account, $type = JYSKEBANK_DOMESTIC_TRANSACTION_RECORD_FROM_BANK_ACCOUNT) {
    $this->fromType = $type;
    $this->fromAccount = $type;
    return $this;
  }  
  
  public function setReference($reference) {
    $this->reference = $reference;
    return $this;
  }
}