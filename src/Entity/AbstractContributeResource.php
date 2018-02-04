<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Dream;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractContributeResource
{
    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="createdAt", type="datetime")
     */
    protected $createdAt;
    /**
     * @var float
     *
     * @Assert\NotBlank
     * @Assert\GreaterThan(value = 0)
     * @ORM\Column(name="quantity", type="float")
     */
    protected $quantity;
    /**
     * @ORM\ManyToOne(targetEntity="Dream", inversedBy="dreamEquipmentContributions")
     */
    protected $dream;
    /**
     * Set createdAt
     *
     * @param  \DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    /**
     * Set quantity
     *
     * @param  float $quantity
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }
    /**
     * Get quantity
     *
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
    /**
     * Set dream
     *
     * @param  Dream $dream
     * @return $this
     */
    public function setDream(Dream $dream = null)
    {
        $this->dream = $dream;
        return $this;
    }
    /**
     * Get dream
     *
     * @return Dream
     */
    public function getDream()
    {
        return $this->dream;
    }
}
