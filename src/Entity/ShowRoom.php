<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShowRoom
 *
 * @ORM\Table(name="show_room", indexes={@ORM\Index(name="fk_show_room_user_idx", columns={"user_id1"})})
 * @ORM\Entity
 */
class ShowRoom
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string", length=45, nullable=true)
     */
    private $city;

    /**
     * @var string|null
     *
     * @ORM\Column(name="address", type="string", length=150, nullable=true)
     */
    private $address;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=150, nullable=true)
     */
    private $description;


    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=150, nullable=true)
     */
    private $name;


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \App\Entity\User
     *
     *
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id1", referencedColumnName="id")
     * })
     */
    private $user1;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Product", inversedBy="showRoom")
     * @ORM\JoinTable(name="product_show_room",
     *   joinColumns={
     *     @ORM\JoinColumn(name="show_room_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="produit_id", referencedColumnName="id")
     *   }
     * )
     */
    private $produit;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->produit = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return null|string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param null|string $city
     */
    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return null|string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param null|string $address
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }


    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return User
     */
    public function getUser1(): User
    {
        return $this->user1;
    }

    /**
     * @param User $user1
     */
    public function setUser1(User $user1): void
    {
        $this->user1 = $user1;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProduit(): \Doctrine\Common\Collections\Collection
    {
        return $this->produit;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $produit
     */
    public function setProduit(\Doctrine\Common\Collections\Collection $produit): void
    {
        $this->produit = $produit;
    }

    public function setOptions(array $options)
    {
        $_classMethods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($options[0]);
            if (in_array($method, $_classMethods)) {
                $this->$method($value);
            }
        }
        return $this;
    }
    public function setOption($key, $value){
        return $this->setOptions(array($key, $value));
    }
}
