<?php

/**
 * Created by PhpStorm.
 * User: Kamel
 * Date: 01/06/2019
 * Time: 14:13
 */
namespace Doctissimo\BlogBundle\Manager;

use Doctissimo\BlogBundle\Entity\Articles;
use Doctissimo\BlogBundle\Forms\Models\ArticlesModels;
use Doctrine\ORM\EntityManagerInterface;
use PDO;

/**
 * ArticlesManager
 *
 */
class ArticlesManager
{

    /** @var EntityManagerInterface  */
    private $entityManager;

    /**
     * ArticlesManager constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function databaseConnection(){
        $conn = $this->entityManager
            ->getConnection();

        return $conn;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getArticleById($id){
        return $this->getRepository()->getArticleById($id);
    }

    /**
     * @return mixed
     */
    public function getArticles()
    {
        return $this->getRepository()->getArticles();
    }

    /**
     * @return mixed
     */
    public function getArticlesByPage($page)
    {
        return $this->getRepository()->getArticlesByPage($page);
    }


    /**
     * @param Articles|ArticlesModels $article
     * @return mixed
     * @throws \Doctrine\DBAL\DBALException
     */
    public function addArticle(ArticlesModels $article)
    {
        $conn = $this->databaseConnection();

        $values = ['title'=>$article->getTitle(), 'description'=>$article->getDescription()];

        $query = 'INSERT INTO articles (title, description)
                 VALUES (:title, :description)';

        $prepared_query = $conn->prepare($query);

        $prepared_query->execute($values);
    }

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getRepository(){
        return $this->entityManager->getRepository(Articles::class);
    }

    /**
     * @return mixed
     */
    public function countAllArticles()
    {
        return $this->getRepository()->countAllArticles();
    }
}