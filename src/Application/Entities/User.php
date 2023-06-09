<?php

namespace Application\Entities;

use Doctrine\ORM\Mapping\{Column, Entity, GeneratedValue, Id, OneToMany, Table};
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @Entity(repositoryClass="Application\Repositories\UserRepository")
 * @Table(name="users")
 */
class User
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    protected int $id;

    /**
     * @Column(type="string")
     * @var string
     */
    protected string $username;

    /**
     * @Column(type="string")
     * @var string
     */
    protected string $password;

    /**
     * @Column(type="string")
     * @var string
     */
    protected string $email;

    /**
     * @Column(type="datetime")
     * @var \DateTime
     */
    protected \DateTime $created;

    /**
     * @OneToMany(targetEntity="Post", mappedBy="user", cascade={"persist", "remove"})
     * @var Collection
     */
    protected Collection $posts;

    public function __construct()
    {
        $this->created = new \DateTime('now');
        $this->posts = new ArrayCollection;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    /**
     * @return Collection
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

}
