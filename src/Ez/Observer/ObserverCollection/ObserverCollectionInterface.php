<?php

namespace Ez\Observer\ObserverCollection;

use Ez\Observer\Observer\ObserverInterface;

/**
 * Interface ObserverCollectionInterface
 *
 * @package Ez\Observer\ObserverCollection
 * @author Derek Li
 */
interface ObserverCollectionInterface
{
    /**
     * @param ObserverInterface $observer
     * @return $this
     */
    public function add(ObserverInterface $observer);

    /**
     * @param ObserverInterface $observer
     * @return $this
     */
    public function remove(ObserverInterface $observer);

    /**
     * @return array
     */
    public function getAll();
}