<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/15
 * Time: 下午9:14
 */

namespace App\Http\Controllers\Front;


use App\Repositories\ArticleRepository;

class BlogController extends FrontController
{

    protected $article;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->article = $articleRepository;
    }

    public function index()
    {
        $articles = $this->article->paginate();

        return view('front.blog.index', compact($articles));
    }

    public function show($slug)
    {
        $article = $this->article->getBySlug($slug);

        return view('front.blog.detail', compact($article));
    }
}
