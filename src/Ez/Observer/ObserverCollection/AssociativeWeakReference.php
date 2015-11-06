<?php

namespace Ez\Observer\ObserverCollection;

use Ez\Observer\Observer\ObserverInterface;

/**
 * Class AssociativeWeakReference
 *
 * @package Ez\Observer\ObserverCollection
 * @author Derek Li
 */
class AssociativeWeakReference implements ObserverCollectionInterface
{
    /**
     * @var array
     */
    protected $observers = array();

    /**
     * @param ObserverInterface $observer
     * @return $this
     */
    public function add(ObserverInterface $observer)
    {
        $this->observers[spl_object_hash($observer)] = new \WeakRef($observer);
        return $this;
    }

    /**
     * @param ObserverInterface $observer
     * @return $this
     */
    public function remove(ObserverInterface $observer)
    {
        $observerId = spl_object_hash($observer);
        if (array_key_exists($observerId, $this->observers)) {
            unset($this->observers[$observerId]);
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        $observers = array();
        foreach ($this->observers as $observerWeakRef) {
            if ($observerWeakRef->valid()) {
                $observers[] = $observerWeakRef->get();
            }
        }
        return $observers;
    }
}