<?php
/**
 * Created by PhpStorm.
 * User: ianas
 * Date: 04.05.2018
 * Time: 18:22
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation as JMSSerializer;

/**
 * @ORM\Entity
 * @ORM\Table(name="groups")
 * @JMSSerializer\ExclusionPolicy("all")
 */
class Groups implements \JsonSerializable
{

    /**
     * @ORM\Column(type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("string")
     * @JMSSerializer\Groups({"groups_all"})
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Group", mappedBy="groupname")
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("ArrayCollection")
     * @JMSSerializer\MaxDepth(2)
     * @JMSSerializer\Groups({"groups_all"})
     */
    protected $groupsArray;

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
            'groupsArray'  => $this->groupsArray,
        ];
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->groupsArray = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add groupsArray.
     *
     * @param \AppBundle\Entity\Group $groupsArray
     *
     * @return Groups
     */
    public function addGroupsArray(\AppBundle\Entity\Group $groupsArray)
    {
        $this->groupsArray[] = $groupsArray;

        return $this;
    }

    /**
     * Remove groupsArray.
     *
     * @param \AppBundle\Entity\Group $groupsArray
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeGroupsArray(\AppBundle\Entity\Group $groupsArray)
    {
        return $this->groupsArray->removeElement($groupsArray);
    }

    /**
     * Get groupsArray.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroupsArray()
    {
        return $this->groupsArray;
    }
}
