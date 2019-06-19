<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/15
 * Time: 下午9:14
 */

namespace App\Http\Controllers\Front;

use App\Repositories\ArticleRepository;
use Illuminate\Support\Facades\Validator;

class BlogController extends FrontController
{

    protected $article;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->article = $articleRepository;

        if (! cache('blog_archives')) {
            $temp = $this->article->archives();
            cache(['blog_archives' => $temp], 1440);
        }
        if (! cache('blog_archives_other_web')) {
            $temp1 = config('app.14k.other_web');
            cache(['blog_archives_other_web' => $temp1], 1440);
        }
    }

    public function index($month = null)
    {
        if ($month !== null) {
            $validator = Validator::make(['month'=>$month], [
                'month' => 'date_format:"Y-m"',
            ]);
            if ($validator->fails()) {
                // 格式不正确 置空
                $month = null;
            }
        }

        $articles = $this->article->pageList($month);
        $archives = cache('blog_archives');
        $elsewhere = cache('blog_archives_other_web');

        return view('front.blog.index', compact('articles', 'archives', 'elsewhere'));
    }

    public function show($slug)
    {
        $article = $this->article->getBySlug($slug);
        $archives = cache('blog_archives');
        $elsewhere = cache('blog_archives_other_web');

        return view('front.blog.detail', compact('article', 'archives', 'elsewhere'));
    }
}
