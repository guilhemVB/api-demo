<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"editor_read"}},
 *     denormalizationContext={"groups"={"editor_write"}}
 * )
 * @ORM\Entity
 */
class Editor
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"editor_read"})
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Groups({"editor_read", "editor_write"})
     */
    private $name;

    /**
     * @var ArrayCollection|Book[]
     * @ORM\OneToMany(targetEntity="Book", mappedBy="editor")
     * @ApiSubresource()
     */
    private $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Editor
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Book[]|ArrayCollection
     */
    public function getBooks()
    {
        return $this->books;
    }

    /**
     * @param Book[]|ArrayCollection $books
     * @return Editor
     */
    public function setBooks($books): Editor
    {
        $this->books = $books;
        return $this;
    }
}