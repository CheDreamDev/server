<?php

namespace App\Entity;
use App\Entity\AbstractContribute;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\WorkResource;

/**
 *
 * @ORM\Table(name="work_contributes")
 * @ORM\Entity(repositoryClass="App\Repository\CommonRepository")
 */
class WorkContribute extends AbstractContribute
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="WorkResource")
     */
    protected $workResource;
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
     * Set workResource
     *
     * @param  WorkResource $workResource
     * @return WorkContribute
     */
    public function setWorkResource(WorkResource $workResource = null)
    {
        $this->workResource = $workResource;
        return $this;
    }
    /**
     * Get workResource
     *
     * @return WorkResource
     */
    public function getWorkResource()
    {
        return $this->workResource;
    }
}
