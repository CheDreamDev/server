<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="tags")
 * @ORM\Entity(repositoryClass="App\Repository\CommonRepository")
 */
class Tags
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
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Dream", mappedBy="tags" )
     */
    protected $dreamsWithTag;

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
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDreamsWithTag()
    {
        return $this->dreamsWithTag;
    }

    /**
     * @param mixed $dreamsWithTag
     */
    public function setDreamsWithTag($dreamsWithTag)
    {
        $this->dreamsWithTag = $dreamsWithTag;
    }
}
