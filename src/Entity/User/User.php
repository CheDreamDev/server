<?php

namespace App\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Table(name="app_users")
 *
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 *
 * @ApiResource(
 *     attributes={
 *         "normalization_context"={"groups"={"read"}},
 *         "denormalization_context"={"groups"={"write"}}
 *     },
 *     itemOperations={
 *         "put"={
 *             "denormalization_context"={
 *                 "groups"={"put-users"}
 *             }
 *         },
 *         "get","delete"
 *     }
 * )
 */
class User implements UserInterface, \Serializable
{

    use TimestampableEntity;
    use SoftDeleteableEntity;


    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Groups("read")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=45, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=60, unique=true)
     *
     * @Groups({"read", "put-users"})
     */
    private $email;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean")
     *
     * @Groups("read")
     */
    private $isActive;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=50, nullable=true)
     *
     * @Groups("read")
     */
    protected $firstName;


    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=50, nullable=true)
     *
     * @Groups("read")
     */
    protected $lastName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     *
     * @Groups("read")
     */
    protected $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="about", type="text", nullable=true)
     *
     * @Groups("read")
     */
    protected $about;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_id", type="string", length=45, nullable=true, unique=true)
     *
     * @Assert\NotBlank
     *
     * @Groups({"read", "write"})
     */
    protected $facebookId;


    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->isActive = true;
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
    public function getSalt()
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
     *  @return void
     */
    public function eraseCredentials(): void
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
     * @return \DateTime
     */
    public function getBirthday(): \DateTime
    {
        return $this->birthday;
    }

    /**
     * @param \DateTime $birthday
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

    /**
     * @return \DateTime
     *
     * @Groups("read")
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     *
     * @Groups("read")
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
}
