<?php
define('JYSKEBANK_DOMESTIC_TRANSFER_TYPE', 'IB030202000005');

// Transfer types.
define('JYSKEBANK_DOMESTIC_TRANSFER_CHECK', 1);
define('JYSKEBANK_DOMESTIC_TRANSFER_BANK', 2);

// Entry types.
define('JYSKEBANK_DOMESTIC_TRANSFER_ENTRY_STATEMENT', 0);
define('JYSKEBANK_DOMESTIC_TRANSFER_ENTRY_CHECK', 2);

class JyskeBankDomesticTransfer extends JyskeBankTransactionRecord {
  private $address;
  private $address2;
  private $zipcode;
  private $city;
  private $extendedMessage;
  private $extendedMessageData = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',);
  private $toReg;
  private $toAccount;
  private $transferType = JYSKEBANK_DOMESTIC_TRANSFER_BANK;
  private $entryType = JYSKEBANK_DOMESTIC_TRANSFER_ENTRY_STATEMENT;
  private $debitorInfo = '';
  private $documentReference = '';
  private $creditorInfo = '';
  private $senderData = array('', '', '', '', '');
  private $senderInfo;
  
  public function __construct() {
    parent::__construct();
    $this->type = JYSKEBANK_DOMESTIC_TRANSFER_TYPE;
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
      'address2' => '',
      'zipcode' => '',
      'city' => '',
    );
    $this->address = $data['address'];
    $this->address2 = $data['address2'];
    $this->zipcode = $data['zipcode'];
    $this->city = $data['city'];
    return $this;
  }  

  public function setExtendedMessage($message) {
    $this->extendedMessage = $message;
    if ($this->transferType == JYSKEBANK_DOMESTIC_TRANSFER_BANK) {
      $this->extendedMessageData = $this->fitRecordLines($message, 41, 35);
    }
    else if ($this->transferType == JYSKEBANK_DOMESTIC_TRANSFER_CHECK) {
      $this->extendedMessageData = $this->fitRecordLines($message, 10, 35);
    }

    return $this;
  }
  
  public function setDebitorInfo($info) {
    $this->debitorInfo = $info;
    return $this;
  }
  
  public function setCreditorInfo($info) {
    $this->creditorInfo = $info;
    return $this;
  }
  
  public function setSenderInfo($info) {
    $this->senderInfo = $info;
    $this->senderData = $this->fitRecordLines($info, 5, 35);
    
    // Fill data into line 2 if line one is not empty.
    if (trim($this->senderData[0]) && !trim($this->senderData[1])) {
      $this->senderData[1] = '--';
    }
    return $this;
  }

  public function setDocumentReference($info) {
    $this->documentReference = $info;
    return $this;
  }

  public function setTransferType($type) {
    $this->transferType = $type;
    if ($type == JYSKEBANK_DOMESTIC_TRANSFER_CHECK) {
      $this->entryType = JYSKEBANK_DOMESTIC_TRANSFER_ENTRY_CHECK;
    }
    else if ($type == JYSKEBANK_DOMESTIC_TRANSFER_BANK) {
      $this->entryType =JYSKEBANK_DOMESTIC_TRANSFER_ENTRY_STATEMENT;
    }
    return $this;
  }

  protected function recordStructure() {
    $lines = array();
    
    // Index 1.
    $lines[0] = array(
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
        'length' => 35,
        'type' => 'space',
      ),
      array(
        'content' => $this->formatText($this->name),
        'length' => 32,
        'type' => 'text',
      ),
      array(
        'content' => $this->formatText($this->address),
        'length' => 32,
        'type' => 'text',
      ),
      array(
        'content' => $this->formatText($this->address2),
        'length' => 32,
        'type' => 'text',
      ),
      array(
        'content' => $this->zipcode,
        'length' => 4,
        'type' => 'number',
      ),
      array(
        'content' => $this->formatText($this->city),
        'length' => 32,
        'type' => 'text',
      ),
      array(
        'content' => $this->formatText($this->reference),
        'length' => 35,
        'type' => 'text',
      ),
      // Special message.
      array(
        'length' => 35,
        'type' => 'space',
      ),
      array(
        'length' => 35,
        'type' => 'space',
      ),
      array(
        'length' => 35,
        'type' => 'space',
      ),
      array(
        'length' => 35,
        'type' => 'space',
      ),
      array(
        'length' => 35,
        'type' => 'space',
      ),
      array(
        'length' => 35,
        'type' => 'space',
      ),
      array(
        'length' => 35,
        'type' => 'space',
      ),
      array(
        'length' => 35,
        'type' => 'space',
      ),
      array(
        'length' => 35,
        'type' => 'space',
      ),
      // Blanks.
      array(
        'length' => 1,
        'type' => 'space',
      ),
      array(
        'length' => 215,
        'type' => 'space',
      ),
    );

    // Bank transfer specific lines
    switch ($this->transferType) {
      case JYSKEBANK_DOMESTIC_TRANSFER_BANK:
        if ($this->recordLinesLength($this->senderData) || $this->debitorInfo || $this->documentReference || $this->creditorInfo)
        // Index 2.
        $lines[1] = array(
          array(
            'content' => $this->type,
            'length' => 14,
            'type' => 'text',
          ),
          array(
            'content' => 2,
            'length' => 4,
            'type' => 'number',
          ),
          // Sender info.
          array(
            'content' => $this->senderData[0],
            'length' => 35,
            'type' => 'text',
          ),
          array(
            'content' => $this->senderData[1],
            'length' => 35,
            'type' => 'text',
          ),
          array(
            'content' => $this->senderData[2],
            'length' => 35,
            'type' => 'text',
          ),
          array(
            'content' => $this->senderData[3],
            'length' => 35,
            'type' => 'text',
          ),
          array(
            'content' => $this->senderData[4],
            'length' => 35,
            'type' => 'text',
          ),
          // Identification.
          array(
            'content' => $this->formatText($this->debitorInfo),
            'length' => 35,
            'type' => 'text',
          ),
          array(
            'content' => $this->formatText($this->documentReference),
            'length' => 35,
            'type' => 'text',
          ),
          array(
            'content' => $this->formatText($this->creditorInfo),
            'length' => 35,
            'type' => 'text',
          ),
          // Blanks
          array(
            'length' => 48,
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
        );

        // Add account statement entry line.
        $lines[0][11] = array(
          'content' => $this->formatText($this->entryText),
          'length' => 35,
          'type' => 'text',
        );
        // Add long message.
        // Fill message data for index 1.
        for ($i = 0; $i < 9; $i++) {
          $lines[0][18 + $i]['type'] = 'text';
          $lines[0][18 + $i]['content'] = $this->extendedMessageData[$i];
        }

        $messageLength = $this->recordLinesLength($this->extendedMessageData);
        // Create index 3 if needed.
        if ($messageLength > 9) {
          $lines[2] = array(
            array(
              'content' => $this->type,
              'length' => 14,
              'type' => 'text',
            ),
            array(
              'content' => 3,
              'length' => 4,
              'type' => 'number',
            ),
          );
          // Fill message data for index 3.
          for ($i = 9; $i < 31; $i++) {
            $lines[2][3 + $i - 9]['type'] = 'text';
            $lines[2][3 + $i - 9]['length'] = '35';
            $lines[2][3 + $i - 9]['content'] = $this->extendedMessageData[$i];
          }
          $lines[2][] = array(
            'length' => 32,
            'type' => 'space',
          );
        }
        // Create index 4 if needed.
        if ($messageLength > 31) {
          $lines[3] = array(
            array(
              'content' => $this->type,
              'length' => 14,
              'type' => 'text',
            ),
            array(
              'content' => 4,
              'length' => 4,
              'type' => 'number',
            ),
          );
          // Fill message data for index 4.
          for ($i = 31; $i < 41; $i++) {
            $lines[3][3 + $i - 31]['type'] = 'text';
            $lines[3][3 + $i - 31]['length'] = '35';
            $lines[3][3 + $i - 31]['content'] = $this->extendedMessageData[$i];
          }
          for ($i = 0; $i < 12; $i++) {
            $lines[3][] = array(
              'length' => 35,
              'type' => 'space',
            );
          }
          $lines[3][] = array(
            'length' => 32,
            'type' => 'space',
          );
        }

        break;

      case JYSKEBANK_DOMESTIC_TRANSFER_CHECK:
        // Fill message data for index 1.
        for ($i = 0; $i < 9; $i++) {
          $lines[0][18 + $i]['type'] = 'text';
          $lines[0][18 + $i]['content'] = $this->extendedMessageData[$i];
        }
        $messageLength = $this->recordLinesLength($this->extendedMessageData);
        // Create index 3 if needed.
        if ($messageLength > 9) {
          $lines[2] = array(
            array(
              'content' => $this->type,
              'length' => 14,
              'type' => 'text',
            ),
            array(
              'content' => 3,
              'length' => 4,
              'type' => 'number',
            ),
          );
          $lines[2][3]['type'] = 'text';
          $lines[2][3]['length'] = '35';
          $lines[2][3]['content'] = $this->extendedMessageData[9];

          // Fill message data for index 1.
          for ($i = 10; $i < 31; $i++) {
            $lines[2][3 + $i - 9]['type'] = 'space';
            $lines[2][3 + $i - 9]['length'] = '35';
          }
          $lines[2][] = array(
            'length' => 32,
            'type' => 'space',
          );
        }
        break;
    }
    return $lines;
  }
}
