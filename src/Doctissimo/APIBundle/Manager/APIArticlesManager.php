<?php

/**
 * Created by PhpStorm.
 * User: Kamel
 * Date: 01/06/2019
 * Time: 14:13
 */
namespace Doctissimo\APIBundle\Manager;

use Doctissimo\BlogBundle\Entity\Articles;
use Doctissimo\BlogBundle\Forms\Models\ArticlesModels;
use Doctissimo\BlogBundle\Manager\ArticlesManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerInterface;
use JMS\SerializerBundle\DependencyInjection\JMSSerializerExtension;
use JMS\SerializerBundle\JMSSerializerBundle;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class APIArticlesManager
{
    /** @var EntityManagerInterface $entityManager */
    private $entityManager;
    /** @var ContainerInterface  */
    private $container;
    /** @var SerializerInterface  */
    private $serializer;

    /**
     * ArticlesManager constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param ContainerInterface $containerInterface
     * @param SerializerInterface $serializer
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        ContainerInterface $containerInterface,
        SerializerInterface $serializer
    ) {
        $this->entityManager = $entityManager;
        $this->container = $containerInterface;
        $this->serializer = $serializer;
    }

    /**
     *
     */
    public function databaseConnection(){
        $conn = $this->entityManager
            ->getConnection();

        return $conn;
    }

    /**
     * @param $articleId
     * @return mixed
     * @internal param JMSSerializerExtension $JMSSerializerExtension
     *
     */
    public function getArticleByIdJSON(
        $articleId
    ){
        $data = $this->serializer->serialize($articleId, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getArticlesJson($articles)
    {
        $data = $this->serializer->serialize($articles, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }


    public function addArticleJSON(
        Request $request,
        ArticlesManager $articlesManager
    ) {
        $data = [];

        $data["title"] = $request->get("title");
        $data["description"] = $request->get("description");

        $article = $this->serializer->deserialize(json_encode($data), Articles::class, 'json');

        $articlesModel = new ArticlesModels();
        $articlesModel->populate($article);

        $articlesManager->addArticle($articlesModel);

        return new Response('', Response::HTTP_CREATED);
    }
}