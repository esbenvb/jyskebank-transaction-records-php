<?php


abstract class JyskeBankRecord {
  protected $type;
  
  // Unix timestamp 
  protected $date;
  
  abstract protected function recordStructure();
  
  public function __construct($date = NULL) {
    $this->date = $date ? $date : time(); 
  }

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
    $string = utf8_decode($text);
    return $string;
  }
}
