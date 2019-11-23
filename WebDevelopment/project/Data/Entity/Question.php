<?php

namespace Data\Entity;

use DateTime;

class Question
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $body;

    /**
     * @var \DateTime
     */
    private $created_on;

    /**
     * @var User
     */
    private $author;

    /**
     * @var Answer[]
     */
    private $answers;

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
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    /**
     * @return DateTime
     */
    public function getCreatedOn(): DateTime
    {
        return new DateTime($this->created_on);
    }

    /**
     * @param DateTime $created_on
     */
    public function setCreatedOn(string $createdOn): void
    {
        $this->created_on = $createdOn;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @param User $author
     */
    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }

    /**
     * @return Answer[]|\Generator
     */
    public function getAnswers(): \Generator
    {
        return $this->answers;
    }

    /**
     * @param Answer[] $answers
     */
    public function setAnswers($answers): void
    {
        $this->answers = $answers;
    }
}