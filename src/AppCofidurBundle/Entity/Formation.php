<?php

namespace AppCofidurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DoctrineCommonCollectionsArrayCollection;

/**
 * Formation
 *
 * @ORM\Table(name="formation")
 * @ORM\Entity(repositoryClass="AppCofidurBundle\Repository\FormationRepository")
 */
class Formation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="criticality", type="integer")
     */
    private $criticality;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="goal", type="string", length=255)
     */
    private $goal;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="teachingAids", type="string", length=255)
     */
    private $teachingAids;

    /**
     * @var string
     *
     * @ORM\Column(name="placesMaterialRessources", type="string", length=255)
     */
    private $placesMaterialRessources;

     /**
     * @var ArrayCollection $categories
     *
     * @ORM\OneToMany(targetEntity="Category", mappedBy="formation", cascade={"remove"})
     * @ORM\OrderBy({"ordre" = "ASC"})
     */
    private $categories;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set criticality
     *
     * @param integer $criticality
     *
     * @return Formation
     */
    public function setCriticality($criticality)
    {
        $this->criticality = $criticality;

        return $this;
    }

    /**
     * Get criticality
     *
     * @return integer
     */
    public function getCriticality()
    {
        return $this->criticality;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Formation
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set goal
     *
     * @param string $goal
     *
     * @return Formation
     */
    public function setGoal($goal)
    {
        $this->goal = $goal;

        return $this;
    }

    /**
     * Get goal
     *
     * @return string
     */
    public function getGoal()
    {
        return $this->goal;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Formation
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set teachingAids
     *
     * @param string $teachingAids
     *
     * @return Formation
     */
    public function setTeachingAids($teachingAids)
    {
        $this->teachingAids = $teachingAids;

        return $this;
    }

    /**
     * Get teachingAids
     *
     * @return string
     */
    public function getTeachingAids()
    {
        return $this->teachingAids;
    }

    /**
     * Set placesMaterialRessources
     *
     * @param string $placesMaterialRessources
     *
     * @return Formation
     */
    public function setPlacesMaterialRessources($placesMaterialRessources)
    {
        $this->placesMaterialRessources = $placesMaterialRessources;

        return $this;
    }

    /**
     * Get placesMaterialRessources
     *
     * @return string
     */
    public function getPlacesMaterialRessources()
    {
        return $this->placesMaterialRessources;
    }

    /**
     * Add category
     *
     * @param \AppCofidurBundle\Entity\Category $category
     *
     * @return Formation
     */
    public function addCategory(\AppCofidurBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \AppCofidurBundle\Entity\Category $category
     */
    public function removeCategory(\AppCofidurBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
