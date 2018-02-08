<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * Faq
 *
 * @ORM\Table(name="faq")
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Faq
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
     * @ORM\Column(name="title", type="string", length=100)
     */
    protected $title;
    /**
     * @var string
     *
     * @ORM\Column(name="question", type="text")
     */
    protected $question;
    /**
     * @var string
     *
     * @ORM\Column(name="answer", type="text")
     */
    protected $answer;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    protected $deletedAt;
    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=200, unique=true)
     */
    protected $slug;
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
     * @param  string $title
     * @return Faq
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
    /**
     * Set question
     *
     * @param  string $question
     * @return Faq
     */
    public function setQuestion($question)
    {
        $this->question = $question;
        return $this;
    }
    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }
    /**
     * Set answer
     *
     * @param  string $answer
     * @return Faq
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
        return $this;
    }
    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }
    /**
     * Set deletedAt
     *
     * @param  \DateTime $deletedAt
     * @return Faq
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }
    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }
    /**
     * Set slug
     *
     * @param  string $slug
     * @return Faq
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }
    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
