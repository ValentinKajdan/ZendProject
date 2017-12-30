<?php

declare(strict_types=1);

namespace Application\Repository;

use Application\Entity\Meetup;
use Doctrine\ORM\EntityRepository;

final class MeetupRepository extends EntityRepository
{

    public function add($meetup) : void
    {
        $this->getEntityManager()->persist($meetup);
        $this->getEntityManager()->flush($meetup);
    }

    public function createMeetup(string $title, string $description, string $dateDebut, string $dateFin)
    {
        return new Meetup($title, $description, $dateDebut, $dateFin);
    }
}
