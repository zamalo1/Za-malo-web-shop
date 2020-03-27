<?php


namespace App\Entity;


class Product
{
    private $id;
    private $name;
    private $price;
    private $images;
    private $quantity=1;
    private $userLikeThisProduct=false;
    private $userDislikeThisProduct=false;
    private $likes;
    private $dislikes;

    public function __construct($productArray)
    {
        $this->id=$productArray['id'];
        $this->name=$productArray['name'];
        $this->price=$productArray['price'];
        $this->images=$productArray['images'];
    }

    /**
     * @return bool
     */
    public function isUserLikeThisProduct(): bool
    {
        return $this->userLikeThisProduct;
    }

    /**
     * @param bool $userLikeThisProduct
     */
    public function setUserLikeThisProduct(bool $userLikeThisProduct): void
    {
        $this->userLikeThisProduct = $userLikeThisProduct;
    }

    /**
     * @return bool
     */
    public function isUserDislikeThisProduct(): bool
    {
        return $this->userDislikeThisProduct;
    }

    /**
     * @param bool $userDislikeThisProduct
     */
    public function setUserDislikeThisProduct(bool $userDislikeThisProduct): void
    {
        $this->userDislikeThisProduct = $userDislikeThisProduct;
    }

    /**
     * @return mixed
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @param mixed $likes
     */
    public function setLikes($likes): void
    {
        $this->likes = $likes;
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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }
}