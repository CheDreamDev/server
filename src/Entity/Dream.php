<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table(name="dreams")
 * @ORM\Entity(repositoryClass="App\Repository\DreamRepository")
 *
 * @ApiResource(
 *     attributes={
 *         "normalization_context"={"groups"={"read"}},
 *         "denormalization_context"={"groups"={"write"}}
 *     },
 *     collectionOperations={
 *         "get"={
 *             "normalization_context"={
 *                 "groups"={"read-dream"}
 *             }
 *         },
 *         "post"
 *     }
 * )
 *
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 */
class Dream
{
    use TimestampableEntity, SoftDeleteableEntity;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Groups({"read", "read-dream"})
     */
    protected $id;

    /**
     * @var string
     *
     * @Assert\NotBlank(message = "dream.not_blank")
     * @Assert\Length(min = "5", minMessage = "dream.min_length")
     *
     * @ORM\Column(name="title", type="string", length=200)
     *
     * @Groups({"read", "write", "read-dream"})
     *
     */
    protected $title;

    /**
     * @var string
     *
     * @Assert\NotBlank(message = "dream.not_blank")
     *
     * @ORM\Column(name="description", type="text")
     *
     * @Groups({"read", "write", "read-dream"})
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=100, nullable = true)
     *
     * @Groups({"read", "write", "read-dream"})
     */
    protected $status;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
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
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @Groups({"read", "read-dream"})
     *
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @Groups({"read", "read-dream"})
     *
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param int $workCompleted
     */
    public function setWorkCompleted($workCompleted)
    {
        $this->workCompleted = $workCompleted;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @Groups({"read", "read-dream"})
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}
