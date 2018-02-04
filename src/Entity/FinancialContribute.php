<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="financial_contributes")
 * @ORM\Entity(repositoryClass="App\Repository\CommonRepository")
 */
class FinancialContribute extends AbstractContribute
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
     * @ORM\ManyToOne(targetEntity="FinancialResource")
     */
    protected $financialResource;
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
     * Set financialResource
     *
     * @param  FinancialResource $financialResource
     * @return FinancialContribute
     */
    public function setFinancialResource(FinancialResource $financialResource = null)
    {
        $this->financialResource = $financialResource;
        return $this;
    }
    /**
     * Get financialResource
     *
     * @return FinancialResource
     */
    public function getFinancialResource()
    {
        return $this->financialResource;
    }
}
