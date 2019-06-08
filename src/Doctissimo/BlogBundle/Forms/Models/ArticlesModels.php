<?php

/**
 * Created by PhpStorm.
 * User: Kamel
 * Date: 02/06/2019
 * Time: 18:40
 */

namespace Doctissimo\BlogBundle\Forms\Models;

use Doctissimo\BlogBundle\Entity\Articles;
use Symfony\Component\Validator\Constraints as Assert;

class ArticlesModels
{

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="5")
     * @var string $title
     */
    private $title;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="15")
     * @var string $description
     */
    private $description;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function populate(Articles $article){
        $this->setTitle($article->getTitle());
        $this->setDescription($article->getDescription());
    }
}