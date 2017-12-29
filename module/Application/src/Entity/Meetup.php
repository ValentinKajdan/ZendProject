<?php

declare(strict_types=1);

namespace Application\Entity;

use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Meetup
 *
 * Attention : Doctrine génère des classes proxy qui étendent les entités, celles-ci ne peuvent donc pas être finales !
 *
 * @package Application\Entity
 * @ORM\Entity(repositoryClass="\Application\Repository\MeetupRepository")
 * @ORM\Table(name="meetups")
 */
class Meetup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=36)
     **/
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=2000, nullable=false)
     */
    private $description = '';

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $dateDebut = '';

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $dateFin = '';

    public function __construct(string $title, string $description = '', datetime $dateDebut, datetime $dateFin)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->title = $title;
        $this->description = $description;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
    }

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title) : void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }

    /**
     * @return datetime
     */
    public function getDateDebut() : string
    {
        return $this->dateDebut;
    }

    /**
     * @param datetime $dateDebut
     */
    public function setDateDebut(datetime $dateDebut) : void
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return datetime
     */
    public function getDateFin() : string
    {
        return $this->dateFin;
    }

    /**
     * @param datetime $dateFin
     */
    public function setDateFin(datetime $dateFin) : void
    {
        $this->dateFin = $dateFin;
    }
}
