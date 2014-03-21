<?php
/**
 * table.php
 *
 * Table class file
 *
 */
/**
 * Table class
 *
 * @package  Smithside Auctions
 */
class Table
{
  /**
   * ID
   * @var int
   */
  protected $id;

  /**
   * Initialize the class with data from database
   * @param array
   */
  public function __construct($input = false) {
    if (is_array($input)) {
      foreach ($input as $key => $val) {
      // Note the $key instead of key. 
      // This will give the value in $key instead of 'key' itself
      $this->$key = $val;
      }
    }
  }

  /**
   * Return ID
   * @return int
   */
  public function getId() {
  return $this->id;
  }  
  
}
