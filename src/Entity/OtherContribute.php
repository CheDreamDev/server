<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 *
 * @ORM\Table(name="other_contributes")
 * @ORM\Entity(repositoryClass="App\Repository\CommonRepository")
 */
class OtherContribute extends AbstractContribute
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
     * @var string
     *
     * @Assert\NotBlank(message = "dream.not_blank")
     * @ORM\Column(name="title", type="string", length=250)
     */
    protected $title;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="otherContributions")
     */
    protected $user;

    public function __construct()
    {
        $this->setQuantity(0);
    }
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
     * Set title
     *
     * @param  string          $title
     * @return OtherContribute
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}
