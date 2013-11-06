<?php

define('JYSKEBANK_DOMESTIC_TRANSFER_TYPE', 'IB030202000005');

// Transfer types.
define('JYSKEBANK_DOMESTIC_TRANSFER_CHECK', 1);
define('JYSKEBANK_DOMESTIC_TRANSFER_BANK', 2);

// Entry types.
define('JYSKEBANK_DOMESTIC_TRANSFER_ENTRY_STATEMENT', 0);
define('JYSKEBANK_DOMESTIC_TRANSFER_ENTRY_SPECIAL', 1);
define('JYSKEBANK_DOMESTIC_TRANSFER_ENTRY_CHECK', 2);

class JyskeBankDomesticTransfer implements JyskeBankTransactionRecord {

  private $address;
  private $zipcode;
  private $city;
  private $specialMessage;
  private $toReg;
  private $toAccount;
  private $transferType;
  private $entryType;
  
  public function __construct() {
    parent::__construct();
    $this->type = JYSKEBANK_DOMESTIC_TRANSFER_TYPE;
    $this->transferType = JYSKEBANK_DOMESTIC_TRANSFER_BANK;
    $this->entryType = JYSKEBANK_DOMESTIC_TRANSFER_ENTRY_STATEMENT;
  }
  
  public function setRecipientAccount($reg, $account) {
    $this->toReg = $reg;
    $this->toAccount = $account;
    return $this;
  }
  
  public function setRecipient($name, $data = array()) {
    $self->name = $name;
    $data += array( 
      'address' => '',
      'zipcode' => '',
      'city' => '',
    );
    $this->address = $data['address'];
    $this->zipcode = $data['zipcode'];
    $this->city = $data['city'];
    return $this;
  }  

  public function setSpecialMessage($message) {
    $this->specialMessage = $message;
    return $this;
  }
  
  public function setEntryType($type) {
    $this->entryType = $type;
    return $this;
  }
  
  public function setTransferType($type) {
    $this->transferType = $type;
    return $this;
  }
}