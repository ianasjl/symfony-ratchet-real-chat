<?php
/**
 * Created by PhpStorm.
 * User: ianas
 * Date: 04.05.2018
 * Time: 17:27
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation as JMSSerializer;

/**
 * @ORM\Entity
 * @ORM\Table(name="groupusers")
 * @UniqueEntity("groupname")
 * @JMSSerializer\ExclusionPolicy("all")
 */
class Groupusers implements \JsonSerializable
{

    /**
     * @ORM\Column(type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("string")
     * @JMSSerializer\Groups({"groupusers_all"})
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Users", mappedBy="userId")
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("ArrayCollection")
     * @JMSSerializer\MaxDepth(2)
     * @JMSSerializer\Groups({"groupusers_all"})
     */
    protected $userIdArray;

    /**
     * @var string The groupname of the chat
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("string")
     * @JMSSerializer\Groups({"group_all"})
     * @ORM\Column(type="string", nullable=true, length=60, unique=true)
     */
    private $groupname;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->userIdArray = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add userIdArray.
     *
     * @param \AppBundle\Entity\Groupusers $userIdArray
     *
     * @return Groupusers
     */
    public function addUserIdArray(\AppBundle\Entity\Groupusers $userIdArray)
    {
        $this->userIdArray[] = $userIdArray;

        return $this;
    }

    /**
     * Remove userIdArray.
     *
     * @param \AppBundle\Entity\Groupusers $userIdArray
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeUserIdArray(\AppBundle\Entity\Groupusers $userIdArray)
    {
        return $this->userIdArray->removeElement($userIdArray);
    }

    /**
     * Get userIdArray.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserIdArray()
    {
        return $this->userIdArray;
    }


    /**
     * Set groupname.
     *
     * @param string|null $groupname
     *
     * @return Groupusers
     */
    public function setGroupname($groupname = null)
    {
        $this->groupname = $groupname;

        return $this;
    }

    /**
     * Get groupname.
     *
     * @return string|null
     */
    public function getGroupname()
    {
        return $this->groupname;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'id'    => $this->id,
            'userIdArray'  => $this->userIdArray,
            'groupname' => $this->groupname,
        ];
    }
}
