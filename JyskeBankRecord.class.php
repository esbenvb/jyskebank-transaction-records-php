<?php
abstract class JyskeBankRecord {
  protected $type;
  
  // The transaction object refering to this record.
  protected $transaction;
  
  // Unix timestamp 
  protected $date;
  
  abstract protected function recordStructure();
  
  public function __construct($date = NULL) {
    $this->date = $date ? $date : time(); 
  }

  public function setTransaction($transaction) {
    $this->transaction = $transaction;
    return $this;
  }

  // Generates the line entries for the record.
  public function generateLines() {
    $structure = $this->recordStructure();
    $lines = array();
    foreach ($structure as $structure_line) {
      $line_array = array();
      foreach ($structure_line as $item) {
        $content = $this->fillField($item);
        $line_array[] = '"' . $content . '"';
      }
      $lines[] = implode(',', $line_array);
    }
    return $lines;
  }

  protected function formatDate($timestamp) {
    return date('Ymd', $timestamp);
  }

  // Fills a field with padding or cuts it to the max length.
  protected function fillField($item) {
    switch ($item['type']) {
      case 'text':
        if (strlen($item['content']) > $item['length']) {
          return substr($item['content'], 0, $item['length']);
        }
        else if (strlen($item['content']) < $item['length']) {
          return str_pad($item['content'], $item['length']);
        }
        return $item['content'];

      case 'number':
        if (strlen($item['content']) < $item['length']) {
          return str_pad($item['content'], $item['length'], '0', STR_PAD_LEFT);
        }
        return $item['content'];

      case 'space':
        return str_pad('', $item['length']);
    }
  }

  protected function formatAmount($amount) {
    $string = number_format($amount * 100 , 0, '.', '');
    $string .= $amount < 0 ? '-' : '+';
    return $string;
  }

  protected function formatText($text) {
    return iconv($this->transaction->sourceEncoding, $this->transaction->destinationEncoding, $text);
  }

  // Makes a long multi-line string fit into the specified limits.
  protected function fitRecordLines($string, $linecount, $linelength) {
    // Convert charset.
    $string = $this->formatText($string);
    // Split into lines.
    $lines = explode("\n", $string);
    $result_lines = array();
    foreach ($lines as $index => $line) {
      // Line is too long.
      if (strlen($line) > $linelength) {
        // Split into words.
        $words = explode(' ', $line);
        // Add words to lines.
        do {
          $lineArr = array();
          // Split words longer than line length.
          while ($words && strlen($words[0]) > $linelength) {
            // Remove long word from list.
            $word = array_shift($words);
            $pos = floor(strlen($word) / $linelength) * $linelength;
            // Cut the word into pieces.
            $part = substr($word, $pos);
            $word = substr($word, 0, $pos);
            // Re-insert pieces.
            array_unshift($words, $part);
            array_unshift($words, $word);
          }
          // Fill up each line with words.
          while ($words && strlen(implode(' ', array_merge($lineArr, array($words[0])))) <= $linelength) {
            $lineArr[] = array_shift($words);
            $line = implode(' ', $lineArr);
          }
          $line = implode(' ', $lineArr);
          $result_lines[] = $line;
          // Return when number of lines have been reached.
          if (count($result_lines) == $linecount) {
            return $result_lines;
          }
        }
        while ($words);
      }
      // Just add lines shorter than limit.
      else {
        $result_lines[] = $line;
        // Return when number of lines have been reached.
        if (count($result_lines) == $linecount) {
          return $result_lines;
        }
      }
    }
    // Add empty lines.
    while (count($result_lines) < $linecount) {
      $result_lines[] = '';
    }
    return $result_lines;
  }
  
  // Determines the actual length of a multi-line text record.
  protected function recordLinesLength($linedata) {
    $length = 0;
    foreach ($linedata as $index => $line) {
      if (trim($line)) {
        $length = $index+1;
      }
    }
    return $length;
  }
}
