<?php
/**
 * Interface for sorting algorithms.
 */

namespace tripsort\utils\interfaces;

/**
 * Sort algorithms should implement this interface.
 */
interface SortInterface {
    /**
     * Sort method should implement.
     * @param array $items
     */
    public static function sort($items);
}