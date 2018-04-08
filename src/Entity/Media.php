<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Media
 *
 * @ORM\Table(name="media")
 * @ORM\Entity
 */
class Media
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=45, nullable=true)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="srcType", type="string", length=45, nullable=true)
     */
    private $srctype;

    /**
     * @var string|null
     *
     * @ORM\Column(name="srcLocation", type="string", length=45, nullable=true)
     */
    private $srclocation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="srcName", type="string", length=45, nullable=true)
     */
    private $srcname;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updateTime", type="date", nullable=true)
     */
    private $updatetime;

    /**
     * @var string|null
     *
     * @ORM\Column(name="format", type="string", length=45, nullable=true)
     */
    private $format;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mimeType", type="string", length=45, nullable=true)
     */
    private $mimetype;

    /**
     * @var string|null
     *
     * @ORM\Column(name="compressionType", type="string", length=45, nullable=true)
     */
    private $compressiontype;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Gallery", mappedBy="media")
     */
    private $gallery;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->gallery = new \Doctrine\Common\Collections\ArrayCollection();
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
    public function getSrctype(): ?string
    {
        return $this->srctype;
    }

    /**
     * @param null|string $srctype
     */
    public function setSrctype(?string $srctype): void
    {
        $this->srctype = $srctype;
    }

    /**
     * @return null|string
     */
    public function getSrclocation(): ?string
    {
        return $this->srclocation;
    }

    /**
     * @param null|string $srclocation
     */
    public function setSrclocation(?string $srclocation): void
    {
        $this->srclocation = $srclocation;
    }

    /**
     * @return null|string
     */
    public function getSrcname(): ?string
    {
        return $this->srcname;
    }

    /**
     * @param null|string $srcname
     */
    public function setSrcname(?string $srcname): void
    {
        $this->srcname = $srcname;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatetime(): ?\DateTime
    {
        return $this->updatetime;
    }

    /**
     * @param \DateTime|null $updatetime
     */
    public function setUpdatetime(?\DateTime $updatetime): void
    {
        $this->updatetime = $updatetime;
    }

    /**
     * @return null|string
     */
    public function getFormat(): ?string
    {
        return $this->format;
    }

    /**
     * @param null|string $format
     */
    public function setFormat(?string $format): void
    {
        $this->format = $format;
    }

    /**
     * @return null|string
     */
    public function getMimetype(): ?string
    {
        return $this->mimetype;
    }

    /**
     * @param null|string $mimetype
     */
    public function setMimetype(?string $mimetype): void
    {
        $this->mimetype = $mimetype;
    }

    /**
     * @return null|string
     */
    public function getCompressiontype(): ?string
    {
        return $this->compressiontype;
    }

    /**
     * @param null|string $compressiontype
     */
    public function setCompressiontype(?string $compressiontype): void
    {
        $this->compressiontype = $compressiontype;
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
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGallery(): \Doctrine\Common\Collections\Collection
    {
        return $this->gallery;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $gallery
     */
    public function setGallery(\Doctrine\Common\Collections\Collection $gallery): void
    {
        $this->gallery = $gallery;
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
