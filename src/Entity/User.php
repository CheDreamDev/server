<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\FinancialContribute;
use App\Entity\WorkContribute;
use App\Entity\OtherContribute;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="app_users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{

    use ContactsInfo;

    const FAKE_EMAIL_PART = "@example.com";

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=50, nullable=true)
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="middleName", type="string", length=50, nullable=true)
     */
    protected $middleName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=50, nullable=true)
     */
    protected $lastName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     */
    protected $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="about", type="text", nullable=true)
     */
    protected $about;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_id", type="string", length=45, nullable=true, unique=true)
     */
    protected $facebookId;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Dream", mappedBy="usersWhoFavorites" )
     */
    protected $favoriteDreams;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FinancialContribute", mappedBy="user")
     */
    protected $financialContributions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Dream", mappedBy="author")
     */
    protected $dreams;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EquipmentContribute", mappedBy="user")
     */
    protected $equipmentContributions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\WorkContribute", mappedBy="user")
     */
    protected $workContributions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OtherContribute", mappedBy="user")
     */
    protected $otherContributions;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->dreams = new ArrayCollection();
        $this->favoriteDreams = new ArrayCollection();
        $this->financialContributions = new ArrayCollection();
        $this->isActive = true;
        $this->equipmentContributions = new ArrayCollection();
        $this->workContributions = new ArrayCollection();
        $this->otherContributions = new ArrayCollection();
        parent::__construct();
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
        ]);
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->email,
            $this->facebookId
            ) = unserialize($serialized);
    }

    /**
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * @param string $facebookId
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * @param string $middleName
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return string
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * @param string $about
     */
    public function setAbout($about)
    {
        $this->about = $about;
    }

    /**
     * Add favoriteDreams
     *
     * @param  Dream $favoriteDreams
     * @return User
     */
    public function addFavoriteDream(Dream $favoriteDreams)
    {
        $this->favoriteDreams[] = $favoriteDreams;
        $favoriteDreams->addUsersWhoFavorite($this);
        return $this;
    }

    /**
     * Remove favoriteDreams
     *
     * @param Dream $favoriteDreams
     */
    public function removeFavoriteDream(Dream $favoriteDreams)
    {
        $this->favoriteDreams->removeElement($favoriteDreams);
        $favoriteDreams->removeUsersWhoFavorite($this);
    }

    /**
     * Get favoriteDreams
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFavoriteDreams()
    {
        return $this->favoriteDreams;
    }

    /**
     * Add dreams
     *
     * @param  Dream $dreams
     * @return User
     */
    public function addDream(Dream $dreams)
    {
        $this->dreams[] = $dreams;
        return $this;
    }

    /**
     * Remove dreams
     *
     * @param Dream $dreams
     */
    public function removeDream(Dream $dreams)
    {
        $this->dreams->removeElement($dreams);
    }

    /**
     * Get dreams
     *
     * @return Collection
     */
    public function getDreams()
    {
        return $this->dreams;
    }

    /**
     * @param mixed $equipmentContributions
     */
    public function setEquipmentContributions($equipmentContributions)
    {
        $this->equipmentContributions = $equipmentContributions;
    }

    /**
     * Add equipmentContributions
     *
     * @param  EquipmentContribute $equipmentContributions
     * @return User
     */
    public function addEquipmentContribution(EquipmentContribute $equipmentContributions)
    {
        $this->equipmentContributions[] = $equipmentContributions;
        return $this;
    }

    /**
     * Remove equipmentContributions
     *
     * @param EquipmentContribute $equipmentContributions
     */
    public function removeEquipmentContribution(EquipmentContribute $equipmentContributions)
    {
        $this->equipmentContributions->removeElement($equipmentContributions);
    }

    /**
     * Get equipmentContributions
     *
     * @return Collection
     */
    public function getEquipmentContributions()
    {
        return $this->equipmentContributions;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return '';
    }

    /**
     * Add financialContributions
     *
     * @param  FinancialContribute $financialContributions
     * @return User
     */
    public function addFinancialContribution(FinancialContribute $financialContributions)
    {
        $this->financialContributions[] = $financialContributions;
        return $this;
    }


    /**
     * Remove financialContributions
     *
     * @param FinancialContribute $financialContributions
     */
    public function removeFinancialContribution(FinancialContribute $financialContributions)
    {
        $this->financialContributions->removeElement($financialContributions);
    }

    /**
     * Get financialContributions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFinancialContributions()
    {
        return $this->financialContributions;
    }

    /**
     * Add workContributions
     *
     * @param  WorkContribute $workContributions
     * @return User
     */
    public function addWorkContribution(WorkContribute $workContributions)
    {
        $this->workContributions[] = $workContributions;
        return $this;
    }

    /**
     * Remove workContributions
     *
     * @param WorkContribute $workContributions
     */
    public function removeWorkContribution(WorkContribute $workContributions)
    {
        $this->workContributions->removeElement($workContributions);
    }

    /**
     * Get workContributions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWorkContributions()
    {
        return $this->workContributions;
    }

    /**
     * Add otherContributions
     *
     * @param  OtherContribute $otherContributions
     * @return User
     */
    public function addOtherContribution(OtherContribute $otherContributions)
    {
        $this->otherContributions[] = $otherContributions;
        return $this;
    }

    /**
     * Remove otherContributions
     *
     * @param OtherContribute $otherContributions
     */
    public function removeOtherContribution(OtherContribute $otherContributions)
    {
        $this->otherContributions->removeElement($otherContributions);
    }
}
