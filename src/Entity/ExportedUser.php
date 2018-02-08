<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * ExportedUser
 *
 * @ORM\Table(name="exported_user")
 * @ORM\Entity
 */
class ExportedUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;
    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
