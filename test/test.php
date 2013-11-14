<?php

require '../jyskebank_transaction_records.php';

$t = new JyskeBankTransaction();


$dt1 = new JyskeBankDomesticTransfer();
$t->addRecord($dt1);

$dt1->setAmount(12312, 'DKK')
  ->setDate(strtotime('+1 day'))
  ->setReference('UID : 12312')
  ->setSource('0400', '124365', JYSKEBANK_DOMESTIC_TRANSACTION_RECORD_FROM_BANK_ACCOUNT)
  ->setRecipientAccount('1232', 1123122)
  ->setEntryText('asdsadsaaDFDS DSAFSAD FSADF SA')
  ->setCreditorInfo('UID: 12222')
  ->setDebitorInfo('UID: 7764')
  ->setSenderInfo('ff fsdf saf sadfsd fdjsklfjsd 12345678912345678912345678915646zzzzzzzzzzzz fdsfds fds fdsf fdsafdsagdfg dfggdsfgfds gfd 2342dsfdsfsd sdfdagsdfga23r2323 sf23g ae22 gwr g 34g2rw')
  ->setDocumentReference(0x1231)
  ->setExtendedMessage('Lorem ipsum dolor sit amet, c æ ø  dfsf f sdøf onsectetur å  adipisicing elit, sed do  ÆØ  tempor incididunt ut labore et dolore Ååå aliqua. Ut enim åminim veniam, å quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."

Afsnit 1.10.32 fra "de Finibus Bonorum et Malorum", skrevet af Cicero i 45 f.kr.

"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"')
    
  ->setRecipient('Din æøå mor', array(
    'address' => 'skodvej 123',
    'zipcode' => '2312',
    'city' => 'skodby',
  ));

$dt2 = new JyskeBankDomesticTransfer();
$t->addRecord($dt2);

$dt2->setAmount(1666, 'DKK')
  ->setDate(strtotime('+3 days'))
  ->setTransferType(JYSKEBANK_DOMESTIC_TRANSFER_CHECK)
  ->setReference('UID : 78955')
  ->setSource('0401', '133742', JYSKEBANK_DOMESTIC_TRANSACTION_RECORD_FROM_BANK_ACCOUNT)
  ->setRecipientAccount('1111', 3333333)
  ->setEntryText('asdsadsaaDFDS DSAFSAD FSADF SA')
  ->setExtendedMessage('Lorem ipsum dolor sit amet, c æ ø  dfsf f sdøf onsectetur å  adipisicing elit, sed do  ÆØ  tempor incididunt ut labore et dolore Ååå aliqua. Ut enim åminim veniam, å quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."

Afsnit 1.10.32 fra "de Finibus Bonorum et Malorum", skrevet af Cicero i 45 f.kr.

"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"')
    
  ->setRecipient('Din far', array(
    'address' => 'abehulen 1',
    'zipcode' => '4568',
    'city' => 'zoo',
  ));

$dt2 = new JyskeBankDomesticTransfer();
$t->addRecord($dt2);

$dt2->setAmount(1666, 'DKK')
  ->setDate(strtotime('+3 days'))
  ->setTransferType(JYSKEBANK_DOMESTIC_TRANSFER_CHECK)
  ->setReference('UID : 78955')
  ->setSource('0401', '133742', JYSKEBANK_DOMESTIC_TRANSACTION_RECORD_FROM_BANK_ACCOUNT)
  ->setRecipientAccount('1111', 3333333)
  ->setEntryText('asdsadsaaDFDS DSAFSAD FSADF SA')
  ->setExtendedMessage('Lorem ipsum dolor sit amet, c æ ø  dfsf f sdøf onsectetur å  adipisicing elit, sed do  ÆØ  tempor i"')
    
  ->setRecipient('Din far', array(
    'address' => 'abehulen 1',
    'zipcode' => '4568',
    'city' => 'zoo',
  ));


$dt2 = new JyskeBankDomesticTransfer();
$t->addRecord($dt2);

$dt2->setAmount(1399.43, 'DKK')
  ->setDate(strtotime('+2 days'))
  ->setEntryText('Hej her er dine penge')
  ->setReference('UID : 78955')
  ->setSource('0401', '133742', JYSKEBANK_DOMESTIC_TRANSACTION_RECORD_FROM_BANK_ACCOUNT)
  ->setRecipientAccount('1111', 3333333)
  ->setRecipient('Din oldefar', array(
    'address' => 'abehulen 1',
    'zipcode' => '4568',
    'city' => 'zoo',
  ));

$dt1 = new JyskeBankDomesticTransfer();
$t->addRecord($dt1);

$dt1->setAmount(12345.56, 'EUR')
  ->setDate(strtotime('+1 day'))
  ->setReference('REFERENCE HERE')
  ->setSource('1234', '1234567890', JYSKEBANK_DOMESTIC_TRANSACTION_RECORD_FROM_BANK_ACCOUNT)
  ->setRecipientAccount('4321', '0987654321')
  ->setCreditorInfo('CREDITOR INFO HERE')
  ->setDebitorInfo('DEBITOR INFO HERE')
  ->setSenderInfo('SENDER INFO LINE 1
SENDER INFO LINE 2
SENDER INFO LINE 3
SENDER INFO LINE 4
SENDER INFO LINE 5
SENDER INFO LINE 6
SENDER INFO LINE 7
SENDER INFO LINE 8
SENDER INFO LINE 9')
  ->setDocumentReference('DOCUMENT REFERENCE HERE')
  ->setExtendedMessage('SPECIAL MESSAGE LINE 1
SPECIAL MESSAGE LINE 2
SPECIAL MESSAGE LINE 3
SPECIAL MESSAGE LINE 4
SPECIAL MESSAGE LINE 5
SPECIAL MESSAGE LINE 6
SPECIAL MESSAGE LINE 7
SPECIAL MESSAGE LINE 8
SPECIAL MESSAGE LINE 9
SPECIAL MESSAGE LINE 10
SPECIAL MESSAGE LINE 11
SPECIAL MESSAGE LINE 12
SPECIAL MESSAGE LINE 13
SPECIAL MESSAGE LINE 14
SPECIAL MESSAGE LINE 15
SPECIAL MESSAGE LINE 16
SPECIAL MESSAGE LINE 17
SPECIAL MESSAGE LINE 18')
  ->setRecipient('RECIPIENT NAME', array(
    'address' => 'RECIPIENT ADDRESS',
    'address2' => 'RECIPIENT ADDRESS2',
    'zipcode' => '1234',
    'city' => 'RECIPIENT CITY',
  ));


$dt1 = new JyskeBankDomesticTransfer();
$t->addRecord($dt1);

$dt1->setAmount(567.12, 'EUR')
  ->setDate(strtotime('0 days'))
  ->setReference('REFERENCE HERE')
  ->setSource('1234', '1234567890', JYSKEBANK_DOMESTIC_TRANSACTION_RECORD_FROM_BANK_ACCOUNT)
  ->setRecipientAccount('4321', '0987654321')
  ->setEntryText('ENTRY TEXT HERE')
  ->setRecipient('RECIPIENT NAME', array(
    'address' => 'RECIPIENT ADDRESS',
    'address2' => 'RECIPIENT ADDRESS2',
    'zipcode' => '1234',
    'city' => 'RECIPIENT CITY',
  ));




$dt1 = new JyskeBankDomesticTransfer();
$t->addRecord($dt1);

$dt1->setAmount(567.12, 'EUR')
  ->setDate(strtotime('0 days'))
  ->setReference('REFERENCE HERE')
  ->setSource('1234', '1234567890', JYSKEBANK_DOMESTIC_TRANSACTION_RECORD_FROM_BANK_ACCOUNT)
  ->setRecipientAccount('4321', '0987654321')
  ->setEntryText('ENTRY TEXT HEREæøåÆØÅ')
  ->setRecipient('RECIPIENT NAMEå', array(
    'address' => 'RECIPIENT ADDRESSø',
    'address2' => 'RECIPIENT ADDRESS2æ',
    'zipcode' => '1234',
    'city' => 'RECIPIENT CITYæ',
  ))
  ->setCreditorInfo('CREDITOR INFO HEREæ')
  ->setDebitorInfo('DEBITOR INFO HEREø')
  ->setSenderInfo('SENDER INFO LINE 1
SENDER INFO LINE 2
SENDER INFO LINE 3
SENDER INFO LINE 4æøåÆØÅ
SENDER INFO LINE 5
SENDER INFO LINE 6
SENDER INFO LINE 7
SENDER INFO LINE 8
SENDER INFO LINE 9')
  ->setDocumentReference('DOCUMENT REFERENCE HERE');





//$t->setEncoding('UTF-8', 'MS-ANSI');


$t->finish();

echo $t->export();
