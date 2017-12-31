<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Entity\Meetup;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

final class MeetupControllerFactory
{
    public function __invoke(ContainerInterface $container) : MeetupController
    {
        $meetupRepository = $container->get(EntityManager::class)->getRepository(Meetup::class);

        return new MeetupController($meetupRepository);
    }
}
