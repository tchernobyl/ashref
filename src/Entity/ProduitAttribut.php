<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProduitAttribut
 *
 * @ORM\Table(name="produit_attribut", indexes={@ORM\Index(name="fk_produit_attribut_produit1_idx", columns={"produit_id"}), @ORM\Index(name="fk_produit_attribut_attribute1_idx", columns={"attribute_id"})})
 * @ORM\Entity
 */
class ProduitAttribut
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="value", type="text", nullable=true)
     */
    private $value;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @var \App\Entity\Attribute
     *
     *
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="App\Entity\Attribute")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="attribute_id", referencedColumnName="id")
     * })
     */
    private $attribute;

    /**
     * @var \App\Entity\Product
     *
     *
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="App\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="produit_id", referencedColumnName="id")
     * })
     */
    private $produit;

    /**
     * @return null|string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param null|string $value
     */
    public function setValue(?string $value): void
    {
        $this->value = $value;
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
     * @return Attribute
     */
    public function getAttribute(): Attribute
    {
        return $this->attribute;
    }

    /**
     * @param Attribute $attribute
     */
    public function setAttribute(Attribute $attribute): void
    {
        $this->attribute = $attribute;
    }

    /**
     * @return \App\Entity\Product
     */
    public function getProduit(): \App\Entity\Product
    {
        return $this->produit;
    }

    /**
     * @param \App\Entity\Product $produit
     */
    public function setProduit(\App\Entity\Product $produit): void
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
