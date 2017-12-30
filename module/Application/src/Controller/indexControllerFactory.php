<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Entity\Meetup;
use Application\Form\MeetupForm;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

final class IndexControllerFactory
{
    public function __invoke(ContainerInterface $container) : IndexController
    {
        $meetupRepository = $container->get(EntityManager::class)->getRepository(Meetup::class);
        $meetupForm = $container->get(MeetupForm::class);

        // var_dump($meetupRepository);

        return new IndexController($meetupRepository, $meetupForm);
    }
}
