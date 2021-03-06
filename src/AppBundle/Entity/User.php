<?php
// src/Acme/UserBundle/Entity/User.php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserRepository")
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\OneToMany(targetEntity="Tweet", mappedBy="user")
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    protected $tweets;

    /**
     * @ORM\manyToMany(targetEntity="User", inversedBy="followed")
     * @ORM\JoinTable(name="follow_user",
     *      joinColumns={@ORM\joinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\joinColumn(name="following_id", referencedColumnName="id")}
     * )
     */
    protected $following;

    /**
     * @ORM\manyToMany(targetEntity="User", mappedBy="following")
     */
    protected $followed;

    protected $isFollowedByMe;



    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public $request;


    public function __construct()
    {
        parent::__construct();

        $this->tweets = new ArrayCollection();
        $this->following = new ArrayCollection();
        $this->followed = new ArrayCollection();
        $this->isFollowedByMe = new ArrayCollection();

    }

    /**
     * Add tweets
     *
     * @param \AppBundle\Entity\Tweet $tweets
     * @return User
     */
    public function addTweet(\AppBundle\Entity\Tweet $tweets)
    {
        $this->tweets[] = $tweets;

        return $this;
    }

    /**
     * Remove tweets
     *
     * @param \AppBundle\Entity\Tweet $tweets
     */
    public function removeTweet(\AppBundle\Entity\Tweet $tweets)
    {
        $this->tweets->removeElement($tweets);
    }

    /**
     * Get tweets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTweets()
    {
        return $this->tweets;
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
     * Add followed
     *
     * @param \AppBundle\Entity\User $followed
     * @return User
     */
    public function addFollowed(\AppBundle\Entity\User $followed)
    {
        $this->followed[] = $followed;

        return $this;
    }

    /**
     * Remove followed
     *
     * @param \AppBundle\Entity\User $followed
     */
    public function removeFollowed(\AppBundle\Entity\User $followed)
    {
        $this->followed->removeElement($followed);
    }

    /**
     * Get followed
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFollowed()
    {
        return $this->followed;
    }

    /**
     * Add following
     *
     * @param \AppBundle\Entity\User $following
     * @return User
     */
    public function addFollowing(\AppBundle\Entity\User $following)
    {
        $this->following[] = $following;

        return $this;
    }

    /**
     * Remove following
     *
     * @param \AppBundle\Entity\User $following
     */
    public function removeFollowing(\AppBundle\Entity\User $following)
    {
        $this->following->removeElement($following);
    }

    /**
     * Get following
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFollowing()
    {
        return $this->following;
    }


    /**
     * Determine if a User is followed by the current user.
     *
     * @param $currentUserId
     * @return bool
     */
    public function isFollowedByMe($currentUserId)
    {
        $followedUsers = $this->getFollowed();

        foreach ($followedUsers as $followedUser) {
            if ( $followedUser->getId() == $currentUserId ) {
                return true;
            }
        }
        return false;

    }

}
