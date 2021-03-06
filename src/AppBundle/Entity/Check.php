<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`check`")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CheckRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Check
{
   /**
    * @var int
    *
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="check")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Bar", inversedBy="check")
     * @ORM\JoinColumn(name="bar_id", referencedColumnName="id")
     */
    private $bar;

    /**
     * @var integer
     *
     * @ORM\Column(name="total", type="decimal", precision=10, scale=2)
     */
    private $total;


    /**
     * @ORM\OneToMany(targetEntity="Bin", mappedBy="check", cascade={"persist", "remove"})
     */
    private $bin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set total
     *
     * @param integer $total
     *
     * @return Check
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return integer
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Check
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

    /**
     * Add bin
     *
     * @param \AppBundle\Entity\Bin $bin
     *
     * @return Check
     */
    public function addBin(\AppBundle\Entity\Bin $bin)
    {
        $this->bin[] = $bin;

        return $this;
    }

    /**
     * Remove bin
     *
     * @param \AppBundle\Entity\Bin $bin
     */
    public function removeBin(\AppBundle\Entity\Bin $bin)
    {
        $this->bin->removeElement($bin);
    }

    /**
     * Get bin
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBin()
    {
        return $this->bin;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreated()
    {
        $this->created = new \DateTime();

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdated()
    {
        $this->updated = new \DateTime();

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }


    /**
     * Set bar
     *
     * @param \AppBundle\Entity\Bar $bar
     *
     * @return Check
     */
    public function setBar(\AppBundle\Entity\Bar $bar = null)
    {
        $this->bar = $bar;

        return $this;
    }

    /**
     * Get bar
     *
     * @return \AppBundle\Entity\Bar
     */
    public function getBar()
    {
        return $this->bar;
    }
}
