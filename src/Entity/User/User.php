<?php

namespace App\Entity\User;

//use Doctrine\Common\Collections\ArrayCollection;
//use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

//use App\Entity\FinancialContribute;
//use App\Entity\WorkContribute;
//use App\Entity\OtherContribute;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="app_users")
 *
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 *
 * @ApiResource
 */
class User implements UserInterface, \Serializable
{

//    use ContactsInfo;

    public const FAKE_EMAIL_PART = '@example.com';

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45, unique=true)
     *
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
     *
     * @Assert\NotBlank
     */
    protected $facebookId;

//    /**
//     * @ORM\ManyToMany(targetEntity="App\Entity\Dream", mappedBy="usersWhoFavorites" )
//     */
//    protected $favoriteDreams;
//
//    /**
//     * @ORM\OneToMany(targetEntity="App\Entity\FinancialContribute", mappedBy="user")
//     */
//    protected $financialContributions;
//
//    /**
//     * @ORM\OneToMany(targetEntity="App\Entity\Dream", mappedBy="author")
//     */
//    protected $dreams;
//
//    /**
//     * @ORM\OneToMany(targetEntity="App\Entity\EquipmentContribute", mappedBy="user")
//     */
//    protected $equipmentContributions;
//
//    /**
//     * @ORM\OneToMany(targetEntity="App\Entity\WorkContribute", mappedBy="user")
//     */
//    protected $workContributions;
//
//    /**
//     * @ORM\OneToMany(targetEntity="App\Entity\OtherContribute", mappedBy="user")
//     */
//    protected $otherContributions;

    /**
     * User constructor.
     */
    public function __construct()
    {
//        $this->dreams = new ArrayCollection();
//        $this->favoriteDreams = new ArrayCollection();
//        $this->financialContributions = new ArrayCollection();
        $this->isActive = true;
//        $this->equipmentContributions = new ArrayCollection();
//        $this->workContributions = new ArrayCollection();
//        $this->otherContributions = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return null
     */
    public function getSalt(): null
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return array('ROLE_USER');
    }

    /**
     *
     */
    public function eraseCredentials()
    {
    }

    /**
     * @see \Serializable::serialize()
     *
     * @return array
     */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password,
            $this->email,
            $this->facebookId,
        ]);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        [
            $this->id,
            $this->username,
            $this->password,
            $this->email,
            $this->facebookId,
        ] = unserialize($serialized, null);
    }

    /**
     * @return string
     */
    public function getFacebookId(): string
    {
        return $this->facebookId;
    }

    /**
     * @param string $facebookId
     *
     * @return User
     */
    public function setFacebookId($facebookId): self
    {
        $this->facebookId = $facebookId;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }


    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName): self
    {
        $this->lastName = $lastName;

        return $this;
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
     *
     * @return User
     */
    public function setBirthday($birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * @return string
     */
    public function getAbout(): string
    {
        return $this->about;
    }

    /**
     * @param string $about
     *
     * @return User
     */
    public function setAbout($about): self
    {
        $this->about = $about;

        return $this;
    }

//    /**
//     * Add favoriteDreams
//     *
//     * @param  Dream $favoriteDreams
//     *
//     * @return User
//     */
//    public function addFavoriteDream(Dream $favoriteDreams)
//    {
//        $this->favoriteDreams[] = $favoriteDreams;
//        $favoriteDreams->addUsersWhoFavorite($this);
//
//        return $this;
//    }
//
//    /**
//     * Remove favoriteDreams
//     *
//     * @param Dream $favoriteDreams
//     */
//    public function removeFavoriteDream(Dream $favoriteDreams)
//    {
//        $this->favoriteDreams->removeElement($favoriteDreams);
//        $favoriteDreams->removeUsersWhoFavorite($this);
//    }
//
//    /**
//     * Get favoriteDreams
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getFavoriteDreams()
//    {
//        return $this->favoriteDreams;
//    }
//
//    /**
//     * Add dreams
//     *
//     * @param  Dream $dreams
//     *
//     * @return User
//     */
//    public function addDream(Dream $dreams)
//    {
//        $this->dreams[] = $dreams;
//
//        return $this;
//    }
//
//    /**
//     * Remove dreams
//     *
//     * @param Dream $dreams
//     */
//    public function removeDream(Dream $dreams)
//    {
//        $this->dreams->removeElement($dreams);
//    }
//
//    /**
//     * Get dreams
//     *
//     * @return Collection
//     */
//    public function getDreams()
//    {
//        return $this->dreams;
//    }
//
//    /**
//     * @param mixed $equipmentContributions
//     */
//    public function setEquipmentContributions($equipmentContributions)
//    {
//        $this->equipmentContributions = $equipmentContributions;
//    }
//
//    /**
//     * Add equipmentContributions
//     *
//     * @param  EquipmentContribute $equipmentContributions
//     *
//     * @return User
//     */
//    public function addEquipmentContribution(EquipmentContribute $equipmentContributions)
//    {
//        $this->equipmentContributions[] = $equipmentContributions;
//
//        return $this;
//    }
//
//    /**
//     * Remove equipmentContributions
//     *
//     * @param EquipmentContribute $equipmentContributions
//     */
//    public function removeEquipmentContribution(EquipmentContribute $equipmentContributions)
//    {
//        $this->equipmentContributions->removeElement($equipmentContributions);
//    }
//
//    /**
//     * Get equipmentContributions
//     *
//     * @return Collection
//     */
//    public function getEquipmentContributions()
//    {
//        return $this->equipmentContributions;
//    }
//
//    /**
//     * Get avatar
//     *
//     * @return string
//     */
//    public function getAvatar()
//    {
//        return '';
//    }
//
//    /**
//     * Add financialContributions
//     *
//     * @param  FinancialContribute $financialContributions
//     *
//     * @return User
//     */
//    public function addFinancialContribution(FinancialContribute $financialContributions)
//    {
//        $this->financialContributions[] = $financialContributions;
//
//        return $this;
//    }
//
//
//    /**
//     * Remove financialContributions
//     *
//     * @param FinancialContribute $financialContributions
//     */
//    public function removeFinancialContribution(FinancialContribute $financialContributions)
//    {
//        $this->financialContributions->removeElement($financialContributions);
//    }
//
//    /**
//     * Get financialContributions
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getFinancialContributions()
//    {
//        return $this->financialContributions;
//    }
//
//    /**
//     * Add workContributions
//     *
//     * @param  WorkContribute $workContributions
//     *
//     * @return User
//     */
//    public function addWorkContribution(WorkContribute $workContributions)
//    {
//        $this->workContributions[] = $workContributions;
//
//        return $this;
//    }
//
//    /**
//     * Remove workContributions
//     *
//     * @param WorkContribute $workContributions
//     */
//    public function removeWorkContribution(WorkContribute $workContributions)
//    {
//        $this->workContributions->removeElement($workContributions);
//    }
//
//    /**
//     * Get workContributions
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getWorkContributions()
//    {
//        return $this->workContributions;
//    }
//
//    /**
//     * Add otherContributions
//     *
//     * @param  OtherContribute $otherContributions
//     *
//     * @return User
//     */
//    public function addOtherContribution(OtherContribute $otherContributions)
//    {
//        $this->otherContributions[] = $otherContributions;
//
//        return $this;
//    }
//
//    /**
//     * Remove otherContributions
//     *
//     * @param OtherContribute $otherContributions
//     */
//    public function removeOtherContribution(OtherContribute $otherContributions)
//    {
//        $this->otherContributions->removeElement($otherContributions);
//    }
}
