<?php

/**
 * all code by me
 *
 * @copyright  Stefan H.G. Buchhofer
 * @version    Release: 1.0.0
 * @link       www.ilenvo-media.de
 * @email      ilenvo@me.com
 * @year       2017
 */

namespace AppBundle\Events\Subscriber;

use AppBundle\Interfaces\PaginationInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Knp\Component\Pager\Event\ItemsEvent;

/**
 * Class PaginationSubscriber
 * @package AppBundle\Events\Subscriber
 */
class PaginationSubscriber implements EventSubscriberInterface
{
    /**
     * @param ItemsEvent $event
     */
    public function items(ItemsEvent $event)
    {
        if ($event->target instanceof PaginationInterface) {
            $event->count = $event->target->getCount();
            if(null !== $event->target->getSortableList() || is_array($event->target->getSortableList())){
                $event->items = $event->target->getSortableList()->toArray();
            } else {
                $event->items = [];
            }
            $event->stopPropagation();
        }
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents() : array
    {
        return array(
            'knp_pager.items' => array('items', 1),
        );
    }
}
