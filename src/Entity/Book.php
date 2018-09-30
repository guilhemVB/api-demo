<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource
 * @ORM\Entity
 */
class Book
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var Editor
     *
     * @ORM\ManyToOne(targetEntity="Editor", inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
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