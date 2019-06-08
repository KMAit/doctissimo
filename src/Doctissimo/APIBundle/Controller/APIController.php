<?php

/**
 * Created by PhpStorm.
 * User: Malek
 * Date: 02/06/2019
 * Time: 15:56
 */

namespace Doctissimo\APIBundle\Controller;

use Doctissimo\APIBundle\Manager\APIArticlesManager;
use Doctissimo\BlogBundle\Entity\Articles;
use Doctissimo\BlogBundle\Manager\ArticlesManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class APIController extends Controller
{

    /**
     * @param ArticlesManager $articlesManager
     * @param APIArticlesManager $APIArticlesManager
     *
     * @return Response
     * @internal param LoggerInterface $logger
     * @internal param ArticlesManager $articlesManager
     */
    public function showAction(
        ArticlesManager $articlesManager,
        APIArticlesManager $APIArticlesManager
    ) {
        $articles =  $articlesManager->getArticles();

        return $APIArticlesManager->getArticlesJson($articles);
    }

    /**
     * @param Articles $articleId
     *
     * @param APIArticlesManager $APIArticlesManager
     * @return Response
     */
    public function detailsAction(
        Articles $articleId,
        APIArticlesManager $APIArticlesManager
    ) {
        return $APIArticlesManager->getArticleByIdJSON($articleId);

    }

    /**
     * @param Request $request
     *
     * @param APIArticlesManager $APIArticlesManager
     * @return Response
     */
    public function createAction(
        Request $request,
        APIArticlesManager $APIArticlesManager
    ){

        if($request->getMethod() === "POST") {
            return $APIArticlesManager->addArticleJSON($request);
        }

        return $this->redirectToRoute("doctissimo_blog_homepage");
    }
}
