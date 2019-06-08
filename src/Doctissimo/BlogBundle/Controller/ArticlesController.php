<?php

namespace Doctissimo\BlogBundle\Controller;

use Doctissimo\APIBundle\Manager\APIArticlesManager;
use Doctissimo\BlogBundle\Entity\Articles;
use Doctissimo\BlogBundle\Forms\ArticlesType;
use Doctissimo\BlogBundle\Helper\PaginatorHelper;
use Doctissimo\BlogBundle\Manager\ArticlesManager;
use Doctissimo\BlogBundle\Forms\Models\ArticlesModels;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticlesController extends Controller
{

    /**
     * List of all articles
     *
     * @param $page
     * @param ArticlesManager $articlesManager
     * @param APIArticlesManager $APIArticlesManager
     *
     * @return Response
     * @internal param LoggerInterface $logger
     * @internal param ArticlesManager $articlesManager
     */
    public function showAction(
        $page,
        ArticlesManager $articlesManager,
        APIArticlesManager $APIArticlesManager
    ) {

        $articles =  $articlesManager->getArticlesByPage($page);
        $countArticles =  $articlesManager->countAllArticles();

        $articlesJson = $APIArticlesManager->getArticlesJson($articles);

        $data = json_decode($articlesJson->getContent());

        $paginator = new PaginatorHelper($page);
        $paginator->setItemsByPage(PaginatorHelper::GENERIC_ITEM_PAGE);
        $paginator->setMaxItems($countArticles);

        return $this->render('blog/articles.html.twig', [
            "articles" => $data,
            "paginator" => $paginator
        ]);
    }

    /**
     * View item details
     *
     * @param Articles $articleId
     * @param APIArticlesManager $APIArticlesManager
     *
     * @return Response
     */
    public function detailsAction(
        Articles $articleId,
        APIArticlesManager $APIArticlesManager
    ) {
        $articlesJson = $APIArticlesManager->getArticleByIdJSON($articleId);

        $data = json_decode($articlesJson->getContent());

        return $this->render('blog/article-details.html.twig', [
            "articleInformation" => $data
        ]);


    }

    /**
     * Create new article
     *
     * @param Request $request
     * @param ArticlesManager $articlesManager
     *
     * @return Response
     * @internal param ArticlesManager $articlesManager
     */
    public function createAction(
        Request $request,
        ArticlesManager $articlesManager
    ){
        $articleModel = new ArticlesModels();
        $articleForm = $this->createForm(ArticlesType::class, $articleModel);

        $articleForm->handleRequest($request);

        if($articleForm->isSubmitted() && $articleForm->isValid()){

            $articlesManager->addArticle($articleModel);

            return $this->redirectToRoute("doctissimo_blog_homepage");
        }


        return $this->render('blog/create-article.html.twig', [
            "articleForm" => $articleForm->createView()
        ]);

    }
}
