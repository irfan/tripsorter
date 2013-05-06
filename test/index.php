<?php
/**
 * Test file for the trip sorter. 
 * It's initialize an example of the trip sort.
 */
  
  /**
   * Include bootstrap file to initialize trip sorter.
   */
   echo PHP_EOL . 'Trip Sort Test Suit' . PHP_EOL;
   echo '==============================' . PHP_EOL;
   
  require_once __DIR__ . '/../src/bootstrap.php';
  
  /**
   * Classes to use in this test.
   */
  use \tripsort\assets\CardFactory;
  use \tripsort\assets\CardAbstract;
  use \tripsort\assets\transportable\Person;
  use \tripsort\assets\TransportableAbstract;
  use \tripsort\modules\travel\Travel;
  
  /**
   * $passenger could be an instance of Person 
   * or an array which contains Person instances.
   */
  $passengers = array(new Person('Abby'), new Person('Bob'));
  
  echo PHP_EOL . '- Passengers tests:' . PHP_EOL;
  
  foreach ($passengers as $key => $passenger) {
    if ($passenger instanceof TransportableAbstract) {
        echo 'PASS: ' . $passenger->name . ' should extends TransportableAbstract' . PHP_EOL;
    }
    else {
        throw new Exception($passenger->name . ' should extends TransportableAbstract');
    }
  }
  
  /**
   * Tickets an array of Cards.
   * If you dont define 'type' member for the array the tickets will create by CommonCard class.
   */
  $test_tickets = array(
      array(
        'source' => 'Dubai Airport',
        'destination' => 'Istanbul Airport',
        'vehicle' => 'plane',
        'seat' => '43A',
        'gate' => null
      ),
      array(
        'source' => 'Marina',
        'destination' => 'Metro Station',
        'vehicle' => 'taxi',
        'seat' => null,
        'gate' => null
      ),
      array(
        'source' => 'Amsterdam Airport',
        'destination' => 'NewYork Airport',
        'vehicle' => 'plane',
        'seat' => '11A',
        'gate' => null
      ),
      array(
        'source' => 'Metro Station',
        'destination' => 'Dubai Airport',
        'vehicle' => 'metro',
        'seat' => null,
        'gate' => null
      ),
      array(
        'source' => 'Istanbul Airport',
        'destination' => 'Amsterdam Airport',
        'vehicle' => 'plane',
        'seat' => '9C',
        'gate' => 'T4'
      )
  );
  
  $tickets = array();
  foreach ($test_tickets as $t) {
    array_push($tickets, CardFactory::create($t));
  }
  
  echo PHP_EOL . '- Boarding Cards tests:' . PHP_EOL;
  
  if (!is_array($tickets)) {
      throw new Exception("Tickets should be an array which contains a kind of Card object by extending CardAbstract");
    }

    foreach ($tickets as $key => $ticket) {
      if ($ticket instanceof CardAbstract) {
          echo 'PASS: ' . $ticket->source . ' to ' . $ticket->destination . ' card should extends CardAbstract' . PHP_EOL;
      }
      else {
          throw new Exception($ticket->source . ' to ' . $ticket->destination . ' card should extends CardAbstract');
      }
    }
  
  /**
   * Create a Travel class and sort boarding cards.
   * Boarding cards should be in correct order 
   */
   
  $travel = new Travel($passengers, $tickets);
  $route = $travel->sortTickets()->getTickets();
  $passenger = $travel->getPassengers();
  
  /**
   * $passangers should be "Abby, Bob, "
   */
  echo PHP_EOL . '- Result test for passengers:' . PHP_EOL;
  
  if ($passenger != 'Abby, Bob, ') {
    echo 'ERROR: $passenger should be "Abby, Bob, "' . PHP_EOL ;
  }
  else {
    echo 'PASS: $passenger should be "Abby, Bob, "' . PHP_EOL;
  }
  
  echo PHP_EOL . '- Order test result for boarding cards:' . PHP_EOL;
  
  for ($i=0; $i < count($route); $i++) { 
      
      $next = isset($route[$i+1]) ? $route[$i+1]->source : $route[$i]->destination;
      
    if ($route[$i]->destination == $next) {
        echo 'PASS: ' . $route[$i]->source . ' to ' . $route[$i]->destination . ' by ' . $route[$i]->vehicle;
        echo ($route[$i]->gate) ? ', gate ' . $route[$i]->gate : '';
        echo ($route[$i]->seat) ? ', seat ' . $route[$i]->seat : '';
        echo PHP_EOL;
    }
    else {
        echo 'ERROR: ' . $route[$i]->source . ' to ' . $route[$i]->destination . ' by ' . $route[$i]->vehicle;
        echo ($route[$i]->gate) ? ', gate ' . $route[$i]->gate : '';
        echo ($route[$i]->seat) ? ', seat ' . $route[$i]->seat : '';
        echo PHP_EOL;
    }
    if ($i == count($route) -1 ) {
      echo 'PASS: You arrived to final destination.' . PHP_EOL;
      break;
    }
  }
