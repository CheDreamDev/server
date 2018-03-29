<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\ExistsFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

// @ApiFilter(ExistsFilter::class, properties={"dreams"}) // please add this annotation to the class after establishing one-to-many Dreams relation

/**
 * @ORM\Table(name="cities")
 * @ORM\Entity(repositoryClass="App\Repository\CityRepository")
 *
 * @ApiResource(
 *     attributes={
 *         "normalization_context"={"groups"={"read"}},
 *         "denormalization_context"={"groups"={"write"}}
 *     },
 *     collectionOperations={"get", "post"},
 *     itemOperations={"get"}
 * )
 */
class City
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @Groups("read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     *
     * @Assert\Length(min=3, max=100)
     * @Groups({"read", "write"})
     */
    private $name;

//    /**
//     * @ORM\OneToMany(targetEntity="App\Entity\Dream", mappedBy="city")
//     *
//     * @Groups("read")
//     */
//    private $dreams;
//
//    /**
//     * City constructor.
//     */
//    public function __construct()
//    {
//        $this->dreams = new ArrayCollection();
//    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

//    /**
//     * @return mixed
//     */
//    public function getDreams()
//    {
//        return $this->dreams;
//    }
}
