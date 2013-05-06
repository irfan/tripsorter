<?php
/**
 * CardFactory class in factory pattern.
 */
namespace tripsort\assets;

use \tripsort\assets\cards\CommonCard;
use \Exception;

/**
 * CardFactory class in factory pattern.
 * Creates a kind of travel card, if card type is not defined then creates an instance of CommonCard.
 */

abstract class CardFactory {
    
    /**
     * Creates an instance of a card.
     * @return CommonCard If $card['type] is not defined then it returns CommonCard as default.
     * @param array $card
     */
    public static function create($card) {
    
      // if type is not setted then use CommonCard class.
      if (!isset($card['type'])) {
        return new CommonCard($card);
      }
      else {
        // then use the type like PlaneCard, BusCard, MetroCard, TaxiCard
        try {
          return new $card['type'] . 'Card';
        }
        catch (Exception $e) {
          throw new Exception($card['type'] . 'Card' . ' class not found! ' . $e);
        }
      }
    }
}
