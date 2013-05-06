<?php
/**
 * The class uses for creating a card to use of passanger
 */

namespace tripsort\assets\cards;

use \tripsort\assets\CardAbstract as CardAbstract;

/**
 * The class uses for creating a card to use of passanger
 */

class CommonCard extends CardAbstract {
  
  /**
   * Source point of the ticket.
   */
  protected $source;
  
  /**
   * Destination of the ticket.
   */
  protected $destination;
  
  /**
   * Vehicle type of the ticket.
   */
  protected $vehicle;
  
  /**
   * Seat number of the ticket.
   */
  protected $seat;
  
  /**
   * Gate # of the ticket.
   */
  protected $gate;
  
  /**
   * Constructor for the CommonCard class.
   * @param array $card
   */
  function __construct(array $card) {
    $this->source       = $card['source'];
    $this->destination  = $card['destination'];
    $this->vehicle      = $card['vehicle'];
    $this->seat         = $card['seat'];
    $this->gate         = $card['gate'];
    
    return $this;
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
