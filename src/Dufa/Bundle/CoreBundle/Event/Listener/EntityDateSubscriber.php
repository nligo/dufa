<?php
namespace Dufa\Bundle\CoreBundle\Event\Listener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;

class EntityDateSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return ['prePersist', 'preUpdate'];
    }

    public function prePersist(LifecycleEventArgs $args)
    {

        $this->setDate($args, 'setCreatedAt');
        $this->setDate($args, 'setUpdatedAt');
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->setDate($args, 'setUpdatedAt');
    }

    private function setDate(LifecycleEventArgs $args, $methodName)
    {
        $entity = $args->getEntity();

        if (method_exists($entity, $methodName)) {
            $entity->$methodName(new \DateTime());
        }
    }
}
