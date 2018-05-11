<?php
/**
 * Created by PhpStorm.
 * User: ianas
 * Date: 08.05.2018
 * Time: 19:39
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation as JMSSerializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="messages")
 * @UniqueEntity("messagename")
 * @JMSSerializer\ExclusionPolicy("all")
 */
class Messages implements \JsonSerializable
{

    /**
     * @ORM\Column(type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("string")
     * @JMSSerializer\Groups({"messages_all"})
     */
    private $id;

    /**
     * @var string The messagename of the chat
     * @ORM\Column(type="string")
     * @JMSSerializer\Expose
     * @ManyToOne(targetEntity="Groupmessages", inversedBy="messagesArray")
     * @ORM\JoinColumn(nullable=true)
     * @JMSSerializer\Type("string")
     * @JMSSerializer\Groups({"messages_all"})
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $messagename;

    /**
     * @var string The fromUserId of the chat
     * @ORM\Column(type="integer")
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("string")
     * @JMSSerializer\Groups({"messages_all"})
     * @ORM\Column(type="string", nullable=true, length=60, unique=true)
     */
    private $fromUserId;

    /**
     * @Assert\DateTime()
     */
    private $posted_at;

    /**
     * @var string The fromSocketId of the chat
     * @ORM\Column(type="integer")
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("string")
     * @JMSSerializer\Groups({"messages_all"})
     * @ORM\Column(type="string", nullable=true, length=60, unique=true)
     */
    private $fromSocketId;


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
     * Set messagename.
     *
     * @param string $messagename
     *
     * @return Messages
     */
    public function setMessagename($messagename)
    {
        $this->messagename = $messagename;

        return $this;
    }

    /**
     * Get messagename.
     *
     * @return string
     */
    public function getMessagename()
    {
        return $this->messagename;
    }

    /**
     * Set fromUserId.
     *
     * @param int $fromUserId
     *
     * @return Messages
     */
    public function setFromUserId($fromUserId)
    {
        $this->fromUserId = $fromUserId;

        return $this;
    }

    /**
     * Get fromUserId.
     *
     * @return int
     */
    public function getFromUserId()
    {
        return $this->fromUserId;
    }

    /**
     * Set fromSocketId.
     *
     * @param int $fromSocketId
     *
     * @return Messages
     */
    public function setFromSocketId($fromSocketId)
    {
        $this->fromSocketId = $fromSocketId;

        return $this;
    }

    /**
     * Get fromSocketId.
     *
     * @return int
     */
    public function getFromSocketId()
    {
        return $this->fromSocketId;
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
            'messagename'  => $this->messagename,
            'fromUserId' => $this->fromUserId,
            'fromSocketId' => $this->fromSocketId,
        ];
    }
}
