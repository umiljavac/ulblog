<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 * @Vich\Uploadable()
 * @ORM\HasLifecycleCallbacks()
 */
class Project
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $shortDescription;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="boolean")
     */
    private $submited;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $github;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mainImage;

    /**
     * @var File
     * @Vich\UploadableField(mapping="project_images", fileNameProperty="mainImage")
     */
    private $mainImageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mainImageAlt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mainImageDescription;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="project", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $images;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Techno", inversedBy="projects")
     */
    private $technos;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", inversedBy="projects")
     */
    private $tags;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;


    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->technos = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getSubmited(): ?bool
    {
        return $this->submited;
    }

    public function setSubmited(bool $submited): self
    {
        $this->submited = $submited;

        return $this;
    }

    public function getGithub(): ?string
    {
        return $this->github;
    }

    public function setGithub(?string $github): self
    {
        $this->github = $github;

        return $this;
    }

    public function getMainImage(): ?string
    {
        return $this->mainImage;
    }

    public function setMainImage(?string $mainImage): self
    {
        $this->mainImage = $mainImage;

        return $this;
    }

    public function setMainImageFile(File $image = null): self
    {
        $this->mainImageFile = $image;
        if($image) {
            $this->setUpdatedAt();
        }

        return $this;
    }

    public function getMainImageFile()
    {
        return $this->mainImageFile;
    }

    /**
     * @return mixed
     */
    public function getMainImageAlt()
    {
        return $this->mainImageAlt;
    }

    /**
     * @param mixed $mainImageAlt
     */
    public function setMainImageAlt($mainImageAlt): void
    {
        $this->mainImageAlt = $mainImageAlt;
    }

    /**
     * @return mixed
     */
    public function getMainImageDescription()
    {
        return $this->mainImageDescription;
    }

    /**
     * @param mixed $mainImageTitle
     */
    public function setMainImageDescription($mainImageDescription): void
    {
        $this->mainImageDescription = $mainImageDescription;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setProject($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getProject() === $this) {
                $image->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Techno[]
     */
    public function getTechnos(): Collection
    {
        return $this->technos;
    }

    public function addTechno(Techno $techno): self
    {
        if (!$this->technos->contains($techno)) {
            $this->technos[] = $techno;
            $techno->addProject($this);
        }

        return $this;
    }

    public function removeTechno(Techno $techno): self
    {
        if ($this->technos->contains($techno)) {
            $this->technos->removeElement($techno);
            $techno->removeProject($this);
        }

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addProject($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
            $tag->removeProject($this);
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function setUpdatedAt(): self
    {
        $this->updatedAt = new \DateTime('now');

        return $this;
    }

    public function __toString()
    {
        return (string) $this->id;
    }
}
