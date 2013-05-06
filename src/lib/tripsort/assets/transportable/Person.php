<?php
/**
 * Person class who'll make the trip.
 * You will need the class to create a trip or a person who has a name please use this class.
 */
namespace tripsort\assets\transportable;

use \tripsort\assets\TransportableAbstract as PersonAbstract;

/**
 * Person class who'll make the trip
 */
class Person extends PersonAbstract {
  
  /**
   * Name of the person.
   */
  protected $name;
  
  /**
   * Constructor
   * Sets the name as a person name.
   * @param string $name
   */
  function __construct($name) {
    $this->name = $name;
  }
  
  /**
   * PHP Magic getter
   * @param string $property
   */
  public function __get($property)
  {
    if (property_exists($this, $property)) {
        return $this->$property;
    }
  }
  
}
