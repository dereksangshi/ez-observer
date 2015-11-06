<?php

namespace Ez\Observer\Tests\Subject;

use Ez\Observer\Subject\Standard as StandardSubject;
use Ez\Observer\ObserverCollection\ObserverCollectionInterface;
use Ez\Observer\Observer\ObserverInterface;
use Ez\Observer\Event\EventInterface;
use Ez\Observer\Event\Standard as StandardEvent;

class PriceTest extends \PHPUnit_Framework_TestCase
{
    public function testRegisterObserver()
    {
        $subject = new StandardSubject();
        $observerA = new ObserverA();
        $observerB = new ObserverB();
        $allObservers = $subject
            ->registerObserver($observerA)
            ->registerObserver($observerB)
            ->getObserverCollection()
            ->getAll();
        $classes = array(
            'Ez\Observer\Tests\Subject\ObserverA',
            'Ez\Observer\Tests\Subject\ObserverB'
        );
        foreach ($allObservers as $observer) {
            $this->assertContains(get_class($observer), $classes);
        }
    }

    public function testUnregisterObserver()
    {
        $subject = new StandardSubject();
        $observerA = new ObserverA();
        $observerB = new ObserverB();
        $allObservers = $subject
            ->registerObserver($observerA)
            ->registerObserver($observerB)
            ->unregisterObserer($observerA)
            ->getObserverCollection()
            ->getAll();
        $this->assertEquals(1, count($allObservers));
        foreach ($allObservers as $observer) {
            $this->assertInstanceOf('\\Ez\\Observer\\Tests\\Subject\\ObserverB', $observer);
        }
    }

    public function testNotifyObservers()
    {
        $subject = new StandardSubject();
        $observerA = new ObserverA();
        $observerB = new ObserverB();
        $event = new StandardEvent();
        $subject
            ->registerObserver($observerA)
            ->registerObserver($observerB)
            ->notifyObservers($event);
        $this->assertEquals('This is ObserverA', $event->getParam('ObserverA'));
        $this->assertEquals('This is ObserverB', $event->getParam('ObserverB'));
    }

    public function testNotifyObserversStopPropagation()
    {
        $subject = new StandardSubject();
        $observerA = new ObserverA();
        $observerB = new ObserverB();
        $event = new StandardEvent();
        $subject
            ->registerObserver($observerA)
            ->notifyObservers($event);
        $this->assertEquals('This is ObserverA', $event->getParam('ObserverA'));
        $event->stopPropagation();
        $subject
            ->registerObserver($observerB)
            ->notifyObservers($event);
        $this->assertArrayHasKey('ObserverA', $event->getParams());
        $this->assertArrayNotHasKey('ObserverB', $event->getParams());
    }
}

class ObserverA implements ObserverInterface
{
    public function notify(EventInterface $event)
    {
        $event->setParam('ObserverA', 'This is ObserverA');
    }
}

class ObserverB implements ObserverInterface
{
    public function notify(EventInterface $event)
    {
        $event->setParam('ObserverB', 'This is ObserverB');
    }
}