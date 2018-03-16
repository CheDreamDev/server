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
     * @var int
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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="workContributions")
     */
    protected $user;

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
     *
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
