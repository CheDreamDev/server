<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DreamResource
 *
 * @ORM\Table(name="equipment_resource")
 * @ORM\Entity
 */
class EquipmentResource extends AbstractResource
{
    const TON = 'ton';
    const KG = 'kg';
    const PIECE = 'piece';

    public static function getReadableQuantityTypes()
    {
        return array(
            self::PIECE => 'dream.equipment.piece',
            self::KG => 'dream.equipment.kg',
            self::TON => 'dream.equipment.ton'
        );
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="quantityType", type="string", length=15, nullable=true)
     */
    protected $quantityType;

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
     * Set quantityType
     *
     * @param  string $quantityType
     * @return $this
     */
    public function setQuantityType($quantityType)
    {
        $this->quantityType = $quantityType;
        return $this;
    }

    /**
     * Get quantityType
     *
     * @return string
     */
    public function getQuantityType()
    {
        return $this->quantityType;
    }
}
