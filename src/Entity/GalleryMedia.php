<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GalleryAttribut
 *
 * @ORM\Table(name="gallery_media", indexes={@ORM\Index(name="fk_gallery_media_gallery1_idx", columns={"gallery_id"}), @ORM\Index(name="fk_gallery_media_media1_idx", columns={"media_id"})})
 * @ORM\Entity
 */
class GalleryMedia
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
     * @var \App\Entity\Media
     *
     *
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="App\Entity\Media")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="media_id", referencedColumnName="id")
     * })
     */
    private $media;

    /**
     * @var \App\Entity\Product
     *
     *
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="App\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gallery_id", referencedColumnName="id")
     * })
     */
    private $gallery;

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
     * @return Media
     */
    public function getMedia(): Media
    {
        return $this->media;
    }

    /**
     * @param Media $media
     */
    public function setMedia(Media $media): void
    {
        $this->media = $media;
    }

    /**
     * @return \App\Entity\Product
     */
    public function getGallery(): \App\Entity\Product
    {
        return $this->gallery;
    }

    /**
     * @param \App\Entity\Product $gallery
     */
    public function setGallery(\App\Entity\Product $gallery): void
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
