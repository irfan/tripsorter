<?php
/**
 * Usage:
 * ArraySort::sort($array);
 * 
 * Description: 
 * 
 * Two of the methods for each object are mandatory members. 
 * 1. source member: The start point of the array. (Ex: $item->getSource())
 * 2. destination member: The end point of the array. (Ex: $item->getDestination())
 * 
 * If there is no member which has same source with any other element's destination value
 * then its the last element of the array.
 * Otherwise there should be other member which has same value in its source.
 * 
 * @param $items an array which has array members which contains at least 2 member
 */

namespace tripsort\utils\sorters;

use \tripsort\utils\interfaces\SortInterface;
use \Exception;

/**
 * Sorts an array depends their source and destination.
 */
class ArraySort implements SortInterface {
  
  /**
   * Stores an array which contain all tickets as unordered
   */
  protected static $items;
  
  /**
   * Stores an array which contains all tickets as ordered
   */
  protected static $arranged = array();
  
  /**
   * Stores an array which will check in second or third step.
   */
  protected static $tmp = array();
  
  /**
   * Sorts and returns the array
   * @param array $items
   * @return array
   */
  public static function sort($items){
    
    self::$items = $items;
    
    // take an element from $items ant push it to self::$arranged array
    if (count(self::$arranged) == 0) {
        array_push(self::$arranged, array_shift(self::$items));
    }
    
    foreach (self::$items as $key => $item) {
      if (!$item->source || !$item->destination) {
        throw new Exception("source and destination members are mandatory");
      }
      
      $source = reset(self::$arranged);
      $source = $source->source;
      
      $destination = end(self::$arranged);
      $destination = $destination->destination;
      
      if ($destination == $item->source || $source == $item->destination) {
        
        if ($item->source == $destination) {
          array_push(self::$arranged, $item);
        }
        
        if ($item->destination == $source) {
          array_unshift(self::$arranged, $item);
        }
        
        if (isset(self::$tmp[$key])) {
          unset(self::$tmp[$key]);
        }
        
      }
      else {
        array_push(self::$tmp, $item);
      }
    }
    
    if (count(self::$tmp) > 0) {
      self::sort(self::$tmp);
    }
    
    return self::$arranged;
  }
}


