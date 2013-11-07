<?php

define('JYSKEBANK_DOMESTIC_TRANSACTION_RECORD_FROM_FINANCE_ACCOUNT', 1);
define('JYSKEBANK_DOMESTIC_TRANSACTION_RECORD_FROM_BANK_ACCOUNT', 2);

abstract class JyskeBankTransactionRecord extends JyskeBankRecord {
  protected $fromType;
  protected $fromAccount;
  protected $fromReg;

  protected $entryText;
  protected $name;
  protected $reference;
  protected $message;

  
  // ISO 4217
  protected $currency;
  
  // Float
  protected $amount;
  
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
  
  public function setEntryText($entryText) {
    $this->entryText = $entryText;
    return $this;
  }

  public function setSource($reg, $account, $type = JYSKEBANK_DOMESTIC_TRANSACTION_RECORD_FROM_BANK_ACCOUNT) {
    $this->fromType = $type;
    $this->fromReg = $reg;
    $this->fromAccount = $account;
    return $this;
  }  
  
  public function setReference($reference) {
    $this->reference = $reference;
    return $this;
  }
}