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

    public function __construct()
    {
        parent::__construct();
//        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }

}