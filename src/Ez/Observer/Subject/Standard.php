<?php

namespace Ez\Observer\Subject;

use Ez\Observer\ObserverCollection\ObserverCollectionInterface;
use Ez\Observer\ObserverCollection\AssociativeWeakReference as AssociativeWeakReferenceObserverCollection;
use Ez\Observer\Observer\ObserverInterface;
use Ez\Observer\Event\EventInterface;

class Standard implements SubjectInterface
{
    /**
     * @var ObserverCollectionInterface
     */
    protected $observerCollection = null;

    /**
     * @param ObserverCollectionInterface $observerCollection
     * @return $this
     */
    public function setObserverCollection(ObserverCollectionInterface $observerCollection)
    {
        $this->observerCollection = $observerCollection;
        return $this;
    }

    /**
     * @return ObserverCollectionInterface
     */
    public function getObserverCollection()
    {
        if (!isset($this->observerCollection)) {
            $this->observerCollection = new AssociativeWeakReferenceObserverCollection();
        }
        return $this->observerCollection;
    }

    /**
     * @param ObserverInterface $observer
     * @return $this
     */
    public function registerObserver(ObserverInterface $observer)
    {
        $this->getObserverCollection()->add($observer);
        return $this;
    }

    /**
     * @param ObserverInterface $observer
     * @return $this
     */
    public function unregisterObserer(ObserverInterface $observer)
    {
        $this->getObserverCollection()->remove($observer);
        return $this;
    }

    /**
     * @param EventInterface $event
     * @return $this
     */
    public function notifyObservers(EventInterface $event)
    {
        foreach ($this->getObserverCollection()->getAll() as $observer) {
            if ($event->isPropagationStopped()) {
                break;
            }
            if ($observer instanceof ObserverInterface) {
                $this->notifyObserver($observer, $event);
            }
        }
        return $this;
    }

    /**
     * @param ObserverInterface $observer
     * @param EventInterface $event
     * @return $this
     */
    protected function notifyObserver(ObserverInterface $observer, EventInterface $event)
    {
        $observer->notify($event);
        return $this;
    }
}