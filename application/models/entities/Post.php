<?php
namespace Entities;

/**
 * @Entity(repositoryClass="Repositories\PostRepository")
 * @Table(name="posts")
 */
class Post
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
    protected $title;

    /**
     * @Column(type="string")
     * @var string
     **/
    protected $body;

    /**
     * @Column(type="datetime")
     **/
    protected $created;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="posts")
     * @var user
     */
    private $user;

    /**
     * Post constructor.
     */
    public function __construct()
    {
        $this->created = new \DateTime("now");
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }
}