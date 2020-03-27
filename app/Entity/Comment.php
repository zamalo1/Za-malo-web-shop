<?php


namespace App\Entity;


class Comment
{
    private $id;
    private $username;
    private $date;
    private $text;
    private $likes;
    private $dislikes;
    private $userLikedThisComment=false;
    private $userUnlikedThisComment=false;

    public function __construct($commentArray)
    {
        $this->id=$commentArray['id'];
        $this->username=$commentArray['username'];
        $this->date=$commentArray['date'];
        $this->text=$commentArray['text'];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getLikes()
    {
        return $this->likes;
    }


    /**
     * @return mixed
     */
    public function getDislikes()
    {
        return $this->dislikes;
    }

    /**
     * @param mixed $dislikes
     */
    public function setDislikes($dislikes): void
    {
        $this->dislikes = $dislikes;
    }

    /**
     * @param mixed $likes
     */
    public function setLikes($likes): void
    {
        $this->likes = $likes;
    }

    public function setUserLikedThisComment($expression)
    {
        $this->userLikedThisComment=$expression;
    }

    /**
     * @return bool
     */
    public function isUserLikedThisComment(): bool
    {
        return $this->userLikedThisComment;
    }
    public function setUserUnlikedThisComment($expression)
    {
        $this->userUnlikedThisComment=$expression;
    }

    /**
     * @return bool
     */
    public function isUserUnlikedThisComment(): bool
    {
        return $this->userUnlikedThisComment;
    }


}