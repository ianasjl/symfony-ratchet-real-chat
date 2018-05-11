<?php
/**
 * Created by PhpStorm.
 * User: ianas
 * Date: 04.05.2018
 * Time: 17:23
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation as JMSSerializer;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 * @JMSSerializer\ExclusionPolicy("all")
 */
class Users implements UserInterface, \JsonSerializable
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ManyToOne(targetEntity="Groupusers", inversedBy="userIdArray")
     * @ORM\JoinColumn(nullable=true)
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("string")
     * @JMSSerializer\Groups({"users_all"})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $userId;

    /**
     * @var string The username of the chat
     * @Assert\NotBlank(message="Please enter your name.")
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long."
     * )
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("string")
     * @JMSSerializer\Groups({"users_all"})
     * @ORM\Column(type="string", length=25, unique=true)
     */
    protected $username;

    /**
     * @ORM\Column(type="string", nullable=true, length=64)
     */
    protected $password;

    /**
     * @var string The email of the user
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("string")
     * @JMSSerializer\Groups({"users_all"})
     * @ORM\Column(type="string", nullable=true, length=60, unique=true)
     */
    protected $email;


    /**
     * @Assert\DateTime()
     */
    private $posted_at;

    /**
     * @ORM\Column(type="string", nullable=true, length=64)
     * @var string
     */
    private $socketId;

    /**
     * @ORM\Column(type="string", nullable=true, length=255)
     */
    private $status;

    /**
     * @Assert\Image(
     *     minWidth = 200,
     *     maxWidth = 400,
     *     minHeight = 200,
     *     maxHeight = 400
     * )
     * @ORM\Column(nullable=true)
     */
    protected $img;

    /**
     * @var string
     * @ORM\Column(name="online", nullable=true, length=64)
     */
    private $online;


    /**
     * Get userId.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set username.
     *
     * @param string $username
     *
     * @return Users
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password.
     *
     * @param string|null $password
     *
     * @return Users
     */
    public function setPassword($password = null)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password.
     *
     * @return string|null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email.
     *
     * @param string|null $email
     *
     * @return Users
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set socketId.
     *
     * @param string|null $socketId
     *
     * @return Users
     */
    public function setSocketId($socketId = null)
    {
        $this->socketId = $socketId;

        return $this;
    }

    /**
     * Get socketId.
     *
     * @return string|null
     */
    public function getSocketId()
    {
        return $this->socketId;
    }

    /**
     * Set status.
     *
     * @param string|null $status
     *
     * @return Users
     */
    public function setStatus($status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set online.
     *
     * @param string|null $online
     *
     * @return Users
     */
    public function setOnline($online = null)
    {
        $this->online = $online;

        return $this;
    }

    /**
     * Get online.
     *
     * @return string|null
     */
    public function getOnline()
    {
        return $this->online;
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
            'userId'   => $this->userId,
            'username' => $this->username,
            'email'    => $this->email,
        ];
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * User constructor.
     */
    public function __construct()
    {

    }


    /**
     * @return Collection
     */
    public function getAccounts()
    {
        // TODO: Implement getAccounts() method.
    }



    /**
     * Set img.
     *
     * @param string|null $img
     *
     * @return Users
     */
    public function setImg($img = null)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img.
     *
     * @return string|null
     */
    public function getImg()
    {
        return $this->img;
    }

}
