<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FinancialResource
 *
 * @ORM\Table(name="financial_resource")
 * @ORM\Entity
 */
class FinancialResource extends AbstractResource
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
