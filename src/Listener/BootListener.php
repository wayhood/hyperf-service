<?php

declare(strict_types=1);

namespace Wayhood\Service\Listener;

use Hyperf\Di\Annotation\AnnotationCollector;
use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Framework\Event\BeforeMainServerStart;
use Hyperf\Server\Event\MainCoroutineServerStart;
use Psr\Container\ContainerInterface;
use Wayhood\Service\Annotation\Service;

class BootListener implements ListenerInterface
{
    public function __construct(private ContainerInterface $container)
    {
    }

    /**
     * @return string[] returns the events that you want to listen
     */
    public function listen(): array
    {
        return [
            BeforeMainServerStart::class,
            MainCoroutineServerStart::class,
        ];
    }

    /**
     * Handle the Event when the event is triggered, all listeners will
     * complete before the event is returned to the EventDispatcher.
     */
    public function process(object $event): void
    {
        /** @var BeforeMainServerStart $event */
        $annotationServices = $this->getAnnotationServices();		
        $annotationServices = array_keys($annotationServices);

        foreach ($annotationServices as $class) {
             if (is_string($class)) {
             	$reflect = new \ReflectionClass($class);
				$interfaces = $reflect->getInterfaceNames();
				if (count($interfaces) > 0) {
                    if (!$this->container->has($interfaces[0])) {
                        $classInstance = $this->container->make($class);
                        $this->container->set($interfaces[0], $classInstance);
                    }
				}
             }
        }
    }

    private function getAnnotationServices()
    {
        return AnnotationCollector::getClassesByAnnotation(Service::class);
    }
}
