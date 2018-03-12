<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 */
class AbstractContribute extends AbstractContributeResource implements EventInterface
{
    /**
     * @var bool
     *
     * @ORM\Column(name="hiddenContributor", type="boolean")
     */
    protected $hiddenContributor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="equipmentContributions")
     */
    protected $user;

    /**
     * Set hiddenContributor
     *
     * @param  boolean $hiddenContributor
     *
     * @return $this
     */
    public function setHiddenContributor($hiddenContributor)
    {
        $this->hiddenContributor = $hiddenContributor;

        return $this;
    }

    /**
     * Get hiddenContributor
     *
     * @return boolean
     */
    public function getHiddenContributor()
    {
        return $this->hiddenContributor;
    }

    /**
     * Set user
     *
     * @param  User $user
     *
     * @return $this
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getEventImage()
    {
        return $this->getUser()->getAvatar();
    }

    /**
     * @return string
     */
    public function getEventTitle()
    {
        return sprintf('%s %s contributed %s', $this->getUser()->getFirstName(), $this->getUser()->getLastName(), $this->getDream()->getTitle());
    }
}
