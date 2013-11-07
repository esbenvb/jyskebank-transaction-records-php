<?php

define('JYSKEBANK_DOMESTIC_TRANSFER_TYPE', 'IB030202000005');

// Transfer types.
define('JYSKEBANK_DOMESTIC_TRANSFER_CHECK', 1);
define('JYSKEBANK_DOMESTIC_TRANSFER_BANK', 2);

// Entry types.
define('JYSKEBANK_DOMESTIC_TRANSFER_ENTRY_STATEMENT', 0);
define('JYSKEBANK_DOMESTIC_TRANSFER_ENTRY_SPECIAL', 1);
define('JYSKEBANK_DOMESTIC_TRANSFER_ENTRY_CHECK', 2);

class JyskeBankDomesticTransfer extends JyskeBankTransactionRecord {

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
    $this->name = $name;
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
  
  protected function recordStructure() {
    // This is the most basic structure. TODO: Expand support.
    $structure = array();
    switch ($this->transferType) {
      // FIXME: only works if entrytype == JYSKEBANK_DOMESTIC_TRANSFER_ENTRY_STATEMENT
      case JYSKEBANK_DOMESTIC_TRANSFER_BANK:
        $line = array(
          array(
            'content' => $this->type,
            'length' => 14,
            'type' => 'text',
          ),
          array(
            'content' => 1,
            'length' => 4,
            'type' => 'number',
          ),
          array(
            'content' => $this->formatDate($this->date),
            'length' => 8,
            'type' => 'number',
          ),
          array(
            'content' => $this->formatAmount($this->amount),
            // 13 digits and +
            'length' => 14,
            'type' => 'number',
          ),
          array(
            'content' => $this->currency,
            'length' => 3,
            'type' => 'text',
          ),
          array(
            'content' => $this->fromType,
            'length' => 1,
            'type' => 'number',
          ),
          array(
            'content' => str_pad($this->fromReg, 4, '0', STR_PAD_LEFT) . str_pad($this->fromAccount, 10, '0', STR_PAD_LEFT),
            'length' => 15,
            'type' => 'number',
          ),
          array(
            'content' => $this->transferType,
            'length' => 1,
            'type' => 'number',
          ),
          array(
            'content' => $this->toReg,
            'length' => 4,
            'type' => 'number',
          ),
          array(
            'content' => $this->toAccount,
            'length' => 10,
            'type' => 'number',
          ),
          array(
            'content' => $this->entryType,
            'length' => 1,
            'type' => 'number',
          ),
          //Should be empty unless  JYSKEBANK_DOMESTIC_TRANSFER_ENTRY_STATEMENT and JYSKEBANK_DOMESTIC_TRANSFER_BANK
          array(
            'content' => $this->entryText,
            'length' => 35,
            'type' => 'text',
          ),
          array(
            'content' => $this->name,
            'length' => 32,
            'type' => 'text',
          ),
          array(
            'content' => $this->address,
            'length' => 32,
            'type' => 'text',
          ),
          // Cut address in two.
          array(
            'content' => $this->address,
            'length' => 32,
            'type' => 'text',
          ),
          array(
            'content' => $this->zipcode,
            'length' => 4,
            'type' => 'number',
          ),
          array(
            'content' => $this->reference,
            'length' => 35,
            'type' => 'text',
          ),

          
          
          
          
          array(
            'length' => 1,
            'type' => 'space',
          ),

        );
        $structure[] = $line;
        return $structure;
    }
  }
}
