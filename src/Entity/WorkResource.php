<?php

namespace App\Entity;

use App\Entity\AbstractResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * DreamResource
 *
 * @ORM\Table(name="work_resource")
 * @ORM\Entity
 */
class WorkResource extends AbstractResource
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
