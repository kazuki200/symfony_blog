<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column]
    private ?int $status = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $post_date = null;

    #[ORM\Column(length: 255)]
    private ?string $thumbnail = null;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: Comment::class)]
    private Collection $comments;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    private ?Category $category = null;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'posts')]
    private Collection $tags;

    #[ORM\Column(length: 255)]
    private ?string $summary = null;

#[ORM\OneToMany(mappedBy: 'post', targetEntity: PostChild::class, cascade: ["persist"])]
    private Collection $postChildren;

#[ORM\Column]
private ?int $view_count = null;


    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->postChildren = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getPostDate(): ?\DateTimeInterface
    {
        return $this->post_date;
    }

    public function setPostDate(\DateTimeInterface $post_date): static
    {
        $this->post_date = $post_date;

        return $this;
    }

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(string $thumbnail): static
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setPost($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPost() === $this) {
                $comment->setPost(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): static
    {
        $this->summary = $summary;

        return $this;
    }

   
    public function getThumbnailUrl(): ?string
    {
        return 'images/' . $this->thumbnail;
    }

    /**
     * @return Collection<int, PostChild>
     */
    public function getPostChildren(): Collection
    {
        return $this->postChildren;
    }

    public function addPostChild(PostChild $postChild): static
    {
        if (!$this->postChildren->contains($postChild)) {
            $this->postChildren->add($postChild);
            $postChild->setPost($this);
        }

        return $this;
    }

    public function removePostChild(PostChild $postChild): static
    {
        if ($this->postChildren->removeElement($postChild)) {
            // set the owning side to null (unless already changed)
            if ($postChild->getPost() === $this) {
                $postChild->setPost(null);
            }
        }

        return $this;
    }


    public function __toString(): string
    {
        return $this->title; // 例として、タイトルを文字列として返す
    }

    public function __clone()
{
    if ($this->postChildren) {
        $clonedChildren = new ArrayCollection();
        foreach ($this->postChildren as $child) {
            $clonedChild = clone $child;
            $clonedChild->setPost($this); // 新しいPostへの参照をセット
            $clonedChildren->add($clonedChild);
        }
        $this->postChildren = $clonedChildren;
    }
}

    public function getViewCount(): ?int
    {
        return $this->view_count;
    }

    public function setViewCount(int $view_count): static
    {
        $this->view_count = $view_count;

        return $this;
    }

     public function incrementViewCount(): self
    {
        $this->view_count++;
        return $this;
    }
}
