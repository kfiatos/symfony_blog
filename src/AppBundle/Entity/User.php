<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")\
 *
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

//    /**
//     * @var \Doctrine\Common\Collections\ArrayCollection
//     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Post", mappedBy="author")
//     */
//    private $posts;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $facebookId;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $facebookToken;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fbTokenExpireTime;

    public function __construct()
    {
        parent::__construct();
//        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * @param mixed $facebookId
     * @return User
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFacebookToken()
    {
        return $this->facebookToken;
    }

    /**
     * @param mixed $facebookToken
     * @return User
     */
    public function setFacebookToken($facebookToken)
    {
        $this->facebookToken = $facebookToken;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFbTokenExpireTime()
    {
        return $this->fbTokenExpireTime;
    }

    /**
     * @param mixed $fbTokenExpireTime
     * @return User
     */
    public function setFbTokenExpireTime($fbTokenExpireTime)
    {
        $this->fbTokenExpireTime = $fbTokenExpireTime;
        return $this;
    }
}