<?php
/**
 * Created by PhpStorm.
 * User: ianas
 * Date: 08.05.2018
 * Time: 20:08
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation as JMSSerializer;

/**
 * @ORM\Entity
 * @ORM\Table(name="groupmessages")
 * @UniqueEntity("groupmessagesname")
 * @JMSSerializer\ExclusionPolicy("all")
 */
class Groupmessages implements \JsonSerializable
{
    /**
     * @ORM\Column(type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("string")
     * @JMSSerializer\Groups({"groupmessages_all"})
     */
    protected $id;

    /**
     * @var string The groupmessagesname of the chat
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("string")
     * @JMSSerializer\Groups({"groupmessages_all"})
     * @ORM\Column(type="string", nullable=true, length=60, unique=true)
     */
    private $groupmessagesname;

    /**
     * @ORM\OneToMany(targetEntity="Messages", mappedBy="messagename")
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("ArrayCollection")
     * @JMSSerializer\MaxDepth(2)
     * @JMSSerializer\Groups({"groupmessages_all"})
     */
    protected $messagesArray;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->messagesArray = new \Doctrine\Common\Collections\ArrayCollection();
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
            'groupmessagesname'  => $this->groupmessagesname,
            'messagesArray' => $this->messagesArray,
        ];
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
     * Set groupmessagesname.
     *
     * @param string|null $groupmessagesname
     *
     * @return Groupmessages
     */
    public function setGroupmessagesname($groupmessagesname = null)
    {
        $this->groupmessagesname = $groupmessagesname;

        return $this;
    }

    /**
     * Get groupmessagesname.
     *
     * @return string|null
     */
    public function getGroupmessagesname()
    {
        return $this->groupmessagesname;
    }

    /**
     * Add messagesArray.
     *
     * @param \AppBundle\Entity\Messages $messagesArray
     *
     * @return Groupmessages
     */
    public function addMessagesArray(\AppBundle\Entity\Messages $messagesArray)
    {
        $this->messagesArray[] = $messagesArray;

        return $this;
    }

    /**
     * Remove messagesArray.
     *
     * @param \AppBundle\Entity\Messages $messagesArray
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeMessagesArray(\AppBundle\Entity\Messages $messagesArray)
    {
        return $this->messagesArray->removeElement($messagesArray);
    }

    /**
     * Get messagesArray.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessagesArray()
    {
        return $this->messagesArray->toArray();
    }
}
