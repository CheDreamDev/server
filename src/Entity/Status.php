<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use App\Entity\Dream;

/**
 * Status
 *
 * @ORM\Table(name="status")
 * @ORM\Entity(repositoryClass="App\Repository\CommonRepository")
 */
class Status implements EventInterface
{
    const SUBMITTED            = 'submitted';
    const REJECTED             = 'rejected';
    const COLLECTING_RESOURCES = 'collecting-resources';
    const IMPLEMENTING         = 'implementing';
    const COMPLETED            = 'completed';
    const SUCCESS              = 'success';
    const FAIL                 = 'fail';
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
     * @return string
     *
     * @ORM\Column(name="title", type="string", length=30)
     */
    protected $title;
    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="createdAt", type="datetime")
     */
    protected $createdAt;
    /**
     *
     * @ORM\ManyToOne(targetEntity="Dream", inversedBy="statuses")
     */
    protected $dream;
    public function __construct($title)
    {
        $this->title = $title;
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
     * @param  string $title
     * @return Status
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
     * Set createdAt
     *
     * @param  \DateTime $createdAt
     * @return Status
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    /**
     * Set dream
     *
     * @param  Dream $dream
     * @return Status
     */
    public function setDream(Dream $dream = null)
    {
        $this->dream = $dream;
        return $this;
    }
    /**
     * Get dream
     *
     * @return Dream
     */
    public function getDream()
    {
        return $this->dream;
    }
    public static function getStatusesArray()
    {
        return array(
            self::SUBMITTED => self::SUBMITTED,
            self::COLLECTING_RESOURCES => self::COLLECTING_RESOURCES,
            self::REJECTED => self::REJECTED,
            self::IMPLEMENTING => self::IMPLEMENTING,
            self::COMPLETED => self::COMPLETED,
            self::SUCCESS => self::SUCCESS,
            self::FAIL => self::FAIL,
        );
    }

    public function getEventImage()
    {
        return $this->getDream()->getMediaPoster();
    }
    public function getEventTitle()
    {
        return sprintf('Dream "%s", has changed status to "%s"', $this->getDream()->getTitle(), $this->getTitle());
    }
}