<?php

namespace Ez\Observer\Observer;

use Ez\Observer\Event\EventInterface;

/**
 * Interface ObserverInterface
 *
 * @package Ez\Observer\Observer
 * @author Derek Li
 */
interface ObserverInterface
{
    public function notify(EventInterface $event);
}