<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\EquipmentResource;

/**
 *
 * @ORM\Table(name="equipment_contributes")
 * @ORM\Entity(repositoryClass="App\Repository\CommonRepository")
 */
class EquipmentContribute extends AbstractContribute
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="EquipmentResource")
     */
    protected $equipmentResource;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set equipmentResource
     *
     * @param  EquipmentResource $equipmentResource
     *
     * @return EquipmentContribute
     */
    public function setEquipmentResource(EquipmentResource $equipmentResource = null)
    {
        $this->equipmentResource = $equipmentResource;

        return $this;
    }

    /**
     * Get equipmentResource
     *
     * @return EquipmentResource
     */
    public function getEquipmentResource()
    {
        return $this->equipmentResource;
    }
}
