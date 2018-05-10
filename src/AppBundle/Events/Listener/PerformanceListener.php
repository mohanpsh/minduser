<?php

namespace AppBundle\Events\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Class PerformanceListener
 * @package AppBundle\Events\Listener
 */
class PerformanceListener
{
    /**
     * @var string
     */
    private $startTime;

    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $this->startTime = microtime(true);
    }

    /**
     * @return float
     */
    public function getScriptSeconds()
    {
        return round(microtime(true) - $this->startTime, 4);
    }
}
