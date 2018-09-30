<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"book_read", "editor_read"}},
 *     denormalizationContext={"groups"={"book_write"}}
 * )
 * @ORM\Entity
 */
class Book
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"book_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank
     * @Assert\Length(max=255)
     * @Groups({"book_read", "book_write"})
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="Editor", inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull
     * @Groups({"book_read", "book_write"})
     */
    private $editor;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Book
    {
        $this->title = $title;
        return $this;
    }

    public function getEditor(): Editor
    {
        return $this->editor;
    }

    public function setEditor(Editor $editor): Book
    {
        $this->editor = $editor;
        return $this;
    }

}