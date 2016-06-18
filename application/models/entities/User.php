<?php
namespace Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity(repositoryClass="Repositories\UserRepository")
 * @Table(name="users")
 */
class User
{
    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     **/
    protected $id;

    /**
     * @Column(type="string")
     * @var string
     **/
    protected $username;

    /**
     * @Column(type="string")
     * @var string
     **/
    protected $email;

    /**
     * @Column(type="string")
     * @var string
     **/
    protected $password;

    /**
     * @Column(type="datetime")
     **/
    protected $created;

    /**
     * @OneToMany(targetEntity="Post", mappedBy="user", cascade={"persist", "remove"})
     * @var Post[]
     */
    protected $posts;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->created = new \DateTime("now");
        $this->posts = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return array
     */
    public function getPosts()
    {
        return $this->posts->toArray();
    }
}