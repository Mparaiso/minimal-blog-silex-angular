<?php

namespace Model;

use Mparaiso\SimpleRest\Model\AbstractModel;

class Comment extends AbstractModel
{
    protected $id;
    protected $title;
    protected $content;
    protected $author_name;
    protected $post_id;

    function __toString()
    {
        return $this->title;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getAuthorName()
    {
        return $this->author_name;
    }

    public function setAuthorName($author_name)
    {
        $this->author_name = $author_name;
    }

    public function getPostId()
    {
        return $this->post_id;
    }

    public function setPostId($post_id)
    {
        $this->post_id = $post_id;
    }
}

