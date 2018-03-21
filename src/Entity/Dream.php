<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table(name="dreams")
 * @ORM\Entity(repositoryClass="App\Repository\DreamRepository")
 *
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @ApiResource()
 * @ApiFilter(SearchFilter::class, properties={"city": "exact"})
 */
class Dream
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Assert\NotBlank(message = "dream.not_blank")
     * @Assert\Length(min = "5", minMessage = "dream.min_length")
     *
     * @ORM\Column(name="title", type="string", length=200)
     */
    protected $title;

    /**
     * @Assert\NotBlank(message = "dream.not_blank")
     *
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @ORM\Column(name="rejectedDescription", type="text", nullable=true)
     */
    protected $rejectedDescription;

    /**
     * @ORM\Column(name="implementedDescription", type="text", nullable=true)
     */
    protected $implementedDescription;

    /**
     * @ORM\Column(name="completedDescription", type="text", nullable=true)
     */
    protected $completedDescription;

    /**
     * @Assert\NotBlank(message = "dream.not_blank")
     * @Assert\Regex(pattern="/^[+0-9 ()-]+$/", message="dream.only_numbers")
     *
     * @ORM\Column(name="phone", type="string", length=45, nullable=true)
     */
    protected $phone;

    /**
     * @Gedmo\Slug(fields={"title"})
     *
     * @ORM\Column(name="slug", type="string", length=200, unique=true)
     */
    protected $slug;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    protected $deletedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiredDate", type="date", nullable=true)
     */
    protected $expiredDate;

    /**
     * @var int
     *
     * @ORM\Column(name="financialCompleted", type="smallint", nullable=true)
     */
    protected $financialCompleted;

    /**
     * @var int
     *
     * @ORM\Column(name="workCompleted", type="smallint", nullable=true)
     */
    protected $workCompleted;

    /**
     * @var int
     *
     * @ORM\Column(name="equipmentCompleted", type="smallint", nullable=true)
     */
    protected $equipmentCompleted;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="favoriteDreams")
     * @ORM\JoinTable(name="favorite_dreams")
     */
    protected $usersWhoFavorites;

    /**
     * @var int
     *
     * @ORM\Column(name="favoritesCount", type="integer", nullable=false)
     */
    protected $favoritesCount;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="dreams")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", nullable=false)
     */
    protected $author;

    /**
     * @ORM\Column(name="currentStatus", type="string", length=100, nullable = true)
     */
    protected $currentStatus;

    protected $dreamPictures;
    protected $dreamPoster;
    protected $dreamFiles;
    protected $dreamVideos;

    /**
     * @ORM\OneToMany(targetEntity="EquipmentContribute", mappedBy="dream")
     */
    protected $dreamEquipmentContributions;

    /**
     * @ORM\OneToMany(targetEntity="Status", mappedBy="dream", cascade={"persist"})
     */
    protected $statuses;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tags", inversedBy="$dreamsWithTag" )
     * @ORM\Column(type="string")
     */
    protected $tags;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\City", inversedBy="dreams")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id", nullable=false)
     */
    protected $city;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->usersWhoFavorites = new ArrayCollection();
        $this->favoritesCount = 0;
        $this->dreamEquipmentContributions = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add usersWhoFavorites.
     *
     * @param \App\Entity\User $usersWhoFavorites
     *
     * @return Dream
     */
    public function addUsersWhoFavorite(\App\Entity\User $usersWhoFavorites)
    {
        $this->usersWhoFavorites[] = $usersWhoFavorites;
        $this->favoritesCount = $this->usersWhoFavorites->count();

        return $this;
    }

    /**
     * Remove usersWhoFavorites.
     *
     * @param \App\Entity\User $usersWhoFavorites
     */
    public function removeUsersWhoFavorite(\App\Entity\User $usersWhoFavorites)
    {
        $this->usersWhoFavorites->removeElement($usersWhoFavorites);
        $this->favoritesCount = $this->usersWhoFavorites->count();
    }

    /**
     * Get usersWhoFavorites.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsersWhoFavorites()
    {
        return $this->usersWhoFavorites;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getRejectedDescription()
    {
        return $this->rejectedDescription;
    }

    /**
     * @param mixed $rejectedDescription
     */
    public function setRejectedDescription($rejectedDescription)
    {
        $this->rejectedDescription = $rejectedDescription;
    }

    /**
     * @return mixed
     */
    public function getImplementedDescription()
    {
        return $this->implementedDescription;
    }

    /**
     * @param mixed $implementedDescription
     */
    public function setImplementedDescription($implementedDescription)
    {
        $this->implementedDescription = $implementedDescription;
    }

    /**
     * @return mixed
     */
    public function getCompletedDescription()
    {
        return $this->completedDescription;
    }

    /**
     * @param mixed $completedDescription
     */
    public function setCompletedDescription($completedDescription)
    {
        $this->completedDescription = $completedDescription;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @param \DateTime $deletedAt
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }

    /**
     * @return \DateTime
     */
    public function getExpiredDate()
    {
        return $this->expiredDate;
    }

    /**
     * @param \DateTime $expiredDate
     */
    public function setExpiredDate($expiredDate)
    {
        $this->expiredDate = $expiredDate;
    }

    /**
     * @return int
     */
    public function getFinancialCompleted()
    {
        return $this->financialCompleted;
    }

    /**
     * @param int $financialCompleted
     */
    public function setFinancialCompleted($financialCompleted)
    {
        $this->financialCompleted = $financialCompleted;
    }

    /**
     * @return int
     */
    public function getWorkCompleted()
    {
        return $this->workCompleted;
    }

    /**
     * @param int $workCompleted
     */
    public function setWorkCompleted($workCompleted)
    {
        $this->workCompleted = $workCompleted;
    }

    /**
     * @return int
     */
    public function getEquipmentCompleted()
    {
        return $this->equipmentCompleted;
    }

    /**
     * @param int $equipmentCompleted
     */
    public function setEquipmentCompleted($equipmentCompleted)
    {
        $this->equipmentCompleted = $equipmentCompleted;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @param mixed $usersWhoFavorites
     */
    public function setUsersWhoFavorites($usersWhoFavorites)
    {
        $this->usersWhoFavorites = $usersWhoFavorites;
    }

    /**
     * @return int
     */
    public function getFavoritesCount()
    {
        return $this->favoritesCount;
    }

    /**
     * @param int $favoritesCount
     */
    public function setFavoritesCount($favoritesCount)
    {
        $this->favoritesCount = $favoritesCount;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getCurrentStatus()
    {
        return $this->currentStatus;
    }

    /**
     * @param mixed $currentStatus
     */
    public function setCurrentStatus($currentStatus)
    {
        $this->currentStatus = $currentStatus;
    }

    /**
     * @return mixed
     */
    public function getDreamPictures()
    {
        return $this->dreamPictures;
    }

    /**
     * @param mixed $dreamPictures
     */
    public function setDreamPictures($dreamPictures)
    {
        $this->dreamPictures = $dreamPictures;
    }

    /**
     * @return mixed
     */
    public function getDreamPoster()
    {
        return $this->dreamPoster;
    }

    /**
     * @param mixed $dreamPoster
     */
    public function setDreamPoster($dreamPoster)
    {
        $this->dreamPoster = $dreamPoster;
    }

    /**
     * @return mixed
     */
    public function getDreamFiles()
    {
        return $this->dreamFiles;
    }

    /**
     * @param mixed $dreamFiles
     */
    public function setDreamFiles($dreamFiles)
    {
        $this->dreamFiles = $dreamFiles;
    }

    /**
     * @return mixed
     */
    public function getDreamVideos()
    {
        return $this->dreamVideos;
    }

    /**
     * @param mixed $dreamVideos
     */
    public function setDreamVideos($dreamVideos)
    {
        $this->dreamVideos = $dreamVideos;
    }

    /**
     * Add dreamEquipmentContributions.
     *
     * @param EquipmentContribute $dreamEquipmentContributions
     *
     * @return Dream
     */
    public function addDreamEquipmentContribution(EquipmentContribute $dreamEquipmentContributions)
    {
        $this->dreamEquipmentContributions[] = $dreamEquipmentContributions;

        return $this;
    }

    /**
     * Remove dreamEquipmentContributions.
     *
     * @param EquipmentContribute $dreamEquipmentContributions
     */
    public function removeDreamEquipmentContribution(EquipmentContribute $dreamEquipmentContributions)
    {
        $this->dreamEquipmentContributions->removeElement($dreamEquipmentContributions);
    }

    /**
     * Get dreamEquipmentContributions.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDreamEquipmentContributions()
    {
        return $this->dreamEquipmentContributions;
    }

    /**
     * Get mediaPoster.
     *
     * @var string
     *
     * @return string
     */
    public function getMediaPoster()
    {
        return '';
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }
}
