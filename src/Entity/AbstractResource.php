<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\MappedSuperclass
 */
class AbstractResource extends AbstractContributeResource
{
    /**
     * @var string
     *
     * @Assert\NotBlank(message = "dream.not_blank")
     * @ORM\Column(name="title", type="string", length=100)
     */
    protected $title;

    /**
     * Set title
     *
     * @param  string $title
     * @return $this
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
}
