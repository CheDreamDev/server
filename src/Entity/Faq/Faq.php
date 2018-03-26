<?php

namespace App\Entity\Faq;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Faq\FaqRepository")
 *
 * @ApiResource(
 *     attributes={
 *         "normalization_context"={"groups"={"read"}},
 *         "denormalization_context"={"groups"={"write"}}
 *     },
 *     collectionOperations={"get": {
 *         "method"="GET",
 *         "normalization_context"={"groups"={"read-faqs"}}
 *     }, "post"},
 *     itemOperations={"put", "delete"})
 */
class Faq
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
     * @Groups({"read", "read-faqs"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     *
     * @Assert\Length(min=5, max=1000)
     *
     * @Groups({"read", "write"})
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @Assert\Length(min=0, max=1000)
     *
     * @Groups({"read", "write"})
     */
    private $answer;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @param string $question
     *
     * @return Faq
     */
    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    /**
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->answer;
    }

    /**
     * @param string $answer
     *
     * @return Faq
     */
    public function setAnswer(string $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * @Groups({"read", "read-faqs"})
     *
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @Groups({"read", "read-faqs"})
     *
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @Groups({"read", "read-faqs"})
     *
     * @return string
     */
    public function getPreview(): string
    {
        return substr($this->question, 0, 100);
    }
}
