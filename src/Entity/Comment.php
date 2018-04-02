<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="comments")
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 *
 * @ApiResource(
 *     attributes={
 *         "normalization_context"={"groups"={"read"}},
 *         "denormalization_context"={"groups"={"write"}}
 *     },
 *     collectionOperations={"post"},
 *     itemOperations={"get", "put", "delete"}
 * )
 *
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 */
class Comment
{
    use TimestampableEntity,
        SoftDeleteableEntity;

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @Groups("read")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     *
     * @Assert\Length(min=3, max=10000)
     *
     * @Groups({"read", "write"})
     */
    private $body;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $body
     *
     * @return Comment
     */
    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @Groups("read")
     *
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @Groups("read")
     *
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
}
