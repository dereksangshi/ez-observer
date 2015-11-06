<?php

namespace Ez\Observer\Event;

/**
 * Interface EventInterface
 *
 * @package Ez\Observer\Event
 * @author Derek Li
 */
class Standard implements EventInterface
{
    /**
     * @var mixed
     */
    protected $target = null;

    /**
     * @var array
     */
    protected $params = array();

    /**
     * @var bool
     */
    protected $isPropagationStopped = false;

    /**
     * @param mixed $target
     * @return $this
     */
    public function setTarget($target)
    {
        $this->target = $target;
        return $this;
    }

    /**
     * @return $this
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param string $name Name of the param.
     * @param mixed $value
     * @return $this
     */
    public function setParam($name, $value)
    {
        $this->params[$name] = $value;
        return $this;
    }

    /**
     * @param string $name Name of the param.
     * @param mixed $default The default value to return if the param doesn't exist.
     * @return $this
     */
    public function getParam($name, $default = null)
    {
        if (array_key_exists($name, $this->params)) {
            return $this->params[$name];
        }
        return $default;
    }

    /**
     * @param array $params The params to set.
     * @return $this
     */
    public function setParams(array $params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param bool|true $stop
     * @return $this
     */
    public function stopPropagation($stop = true)
    {
        $this->isPropagationStopped = $stop;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPropagationStopped()
    {
        return $this->isPropagationStopped;
    }
}