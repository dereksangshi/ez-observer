<?php

namespace Ez\Observer\Event;

/**
 * Interface EventInterface
 *
 * @package Ez\Observer\Event
 * @author Derek Li
 */
interface EventInterface
{
    /**
     * @param mixed $target
     * @return $this
     */
    public function setTarget($target);

    /**
     * @return $this
     */
    public function getTarget();

    /**
     * @param string $name Name of the param.
     * @param mixed $value
     * @return $this
     */
    public function setParam($name, $value);

    /**
     * @param string $name Name of the param.
     * @param mixed $default The default value to return if the param doesn't exist.
     * @return $this
     */
    public function getParam($name, $default = null);

    /**
     * @param array $params The params to set.
     * @return $this
     */
    public function setParams(array $params);

    /**
     * @return array
     */
    public function getParams();

    /**
     * @param bool|true $stop
     * @return $this
     */
    public function stopPropagation($stop = true);

    /**
     * @return bool
     */
    public function isPropagationStopped();
}