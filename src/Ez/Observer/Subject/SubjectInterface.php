<?php

namespace Ez\Observer\Subject;

use Ez\Observer\ObserverCollection\ObserverCollectionInterface;
use Ez\Observer\Observer\ObserverInterface;
use Ez\Observer\Event\EventInterface;

/**
 * Interface SubjectInterface
 *
 * @package Ez\Observer\Subject
 * @author Derek Li
 */
interface SubjectInterface
{
    /**
     * @return ObserverCollectionInterface
     */
    public function getObserverCollection();

    /**
     * @param ObserverInterface $observer
     * @return $this
     */
    public function registerObserver(ObserverInterface $observer);

    /**
     * @param ObserverInterface $observer
     * @return $this
     */
    public function unregisterObserer(ObserverInterface $observer);

    /**
     * @param EventInterface $event
     * @return $this
     */
    public function notifyObservers(EventInterface $event);
}