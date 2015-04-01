<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Tweet
 *
 * @ORM\Entity(repositoryClass="AppBundle\Entity\TweetRepository")
 * @ORM\Table(name="tweets")
 */
class Tweet
{

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="tweets")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;


    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=160)
     * @Assert\Length(max=160)
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;


    /**
     * sets created_at and updated_at
     */
    public function __construct() {
        $this->setCreatedAt();
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
     * Set userId
     *
     * @param integer $userId
     * @return Tweet
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Tweet
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
     * Set text
     *
     * @param string $text
     * @return Tweet
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Tweet
     */
    public function setCreatedAt($createdAt = null)
    {
        if ($createdAt == null) {
            $this->createdAt = new \DateTime();
            $this->updatedAt = new \DateTime();

            return $this;
        }
        $this->createdAt = $createdAt;
        $this->updatedAt = new \DateTime();

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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Tweet
     */
    public function setUpdatedAt($updatedAt = null)
    {
        if ($updatedAt == null) {
            $this->updatedAt = new \DateTime();
            return $this;
        }

        $this->updatedAt = $updatedAt;


        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return Tweet
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
