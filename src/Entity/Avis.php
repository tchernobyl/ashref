<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avis
 *
 * @ORM\Table(name="avis", indexes={@ORM\Index(name="fk_avis_user1_idx", columns={"user_id1"})})
 * @ORM\Entity
 */
class Avis
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="message", type="string", length=45, nullable=true)
     */
    private $message;

    /**
     * @var string|null
     *
     * @ORM\Column(name="smile", type="string", length=45, nullable=true)
     */
    private $smile;

    /**
     * @var float|null
     *
     * @ORM\Column(name="star", type="float", precision=10, scale=0, nullable=true)
     */
    private $star;

    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idUser;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $userId;

    /**
     * @var \App\Entity\User
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id1", referencedColumnName="id")
     * })
     */
    private $user1;

    /**
     * @return null|string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param null|string $message
     */
    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return null|string
     */
    public function getSmile(): ?string
    {
        return $this->smile;
    }

    /**
     * @param null|string $smile
     */
    public function setSmile(?string $smile): void
    {
        $this->smile = $smile;
    }

    /**
     * @return float|null
     */
    public function getStar(): ?float
    {
        return $this->star;
    }

    /**
     * @param float|null $star
     */
    public function setStar(?float $star): void
    {
        $this->star = $star;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->idUser;
    }

    /**
     * @param int $idUser
     */
    public function setIdUser(int $idUser): void
    {
        $this->idUser = $idUser;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
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
