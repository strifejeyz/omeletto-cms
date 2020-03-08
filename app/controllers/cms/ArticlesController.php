<?php

use Kernel\Format;
use App\Models\User;
use App\Models\Article;
use Kernel\Requests\HTTPRequest;
use App\Requests\CreateArticleRequest;

class ArticlesController extends Auth
{
    /**
     * Controller Index
     *
     * @return mixed
     **/
    public function index()
    {
        return render('backend/articles/index');
    }


    /**
     * Controller Index
     *
     * @return mixed
     **/
    public function fetch()
    {
        $res = new HTTPRequest;

        if (empty($res->get('query'))) {
            $articles = Article::order($res->get('sort_by'), $res->get('order'))
                ->limit(!is_numeric($res->get('limit')) ? false : $res->get('limit'))
                ->get();
        } else {
            $check = Article::where('id', $res->get('query'))->get();
            if (is_numeric($res->get('query')) && !empty($check)) {
                $articles = ($check);
            } else {
                $articles = Article::where('title', 'like', "%{$res->get('query')}%")
                    ->orWhere('published', 'like', "%{$res->get('query')}%")
                    ->orWhere('content', 'like', "%{$res->get('query')}%")
                    ->orWhere('date_published', 'like', "%{$res->get('query')}%")
                    ->order($res->get('sort_by'), $res->get('order'))
                    ->limit(!is_numeric($res->get('limit')) ? false : $res->get('limit'))
                    ->get();
            }
        }

        echo <<<EOF
        <table id="table" class="table table-sm display">
            <thead>
            <tr>
                <th>ID</th>
                <th>Author</th>
                <th>Title</th>
                <th>Date Published</th>
                <th>Date Created</th>
                <th>Published</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
EOF;

        foreach ($articles as $article):
            $author = User::find($article->user_id);
            $published = $article->published == 'no' ? 'Publish' : 'Unpublish';
            $route = r('cms.articles.publish', $article->slug);
            $badge = $article->published == 'no' ? 'warning' : 'primary';

            echo "
            <tr>
                <td>{$article->id}</td>
                <td>{$author->firstname} {$author->lastname}</td>
                <td>" . Format::fold($article->title, 50) . "</td>
                <td>{$article->date_published}</td>
                <td>" . date('F j, Y', $article->created) . "</td>
                <td>
                    <span class='badge badge-{$badge}'>$article->published</span>
                </td>
                <td>
                    <a href='" . r('cms.articles.edit', $article->slug) . "'>Edit</a> |
                    <a href='#' onclick=\"toggle('{$route}')\">{$published}</a>
                </td>
            </tr>";
        endforeach;
        echo "</tbody></table>";
    }

    /**
     * Controller Create
     *
     * @return mixed
     **/
    public function create()
    {
        return render('backend/articles/create');
    }


    /**
     * Controller Store
     *
     * @return mixed
     **/
    public function store()
    {
        $request = new CreateArticleRequest;
        if ($request->validate()) {

            if (Article::where('slug', Format::slug($request->get('title')))->exists()) {
                set_form_error('title', "this title is already used.");
                $request->retain();
            } else {
                Article::insert([
                    'user_id' => Session::user()->id,
                    'title' => $request->get('title'),
                    'slug' => Format::slug($request->get('title')),
                    'keywords' => $request->get('keywords'),
                    'description' => $request->get('description'),
                    'tags' => $request->get('tags'),
                    'content' => $request->raw()['content'],
                    'published' => 'yes',
                    'date_published' => date('F j, Y', time()),
                    'created' => time(),
                    'updated' => time(),
                ]);

                setflash("message", "<i class='text-success'>Successfully published article.</i>");
            }
        }

        return redirect($request->origin());
    }


    /**
     * Controller Edit
     *
     * @param $id
     * @return mixed
     **/
    public function edit($slug)
    {
        $article = Article::whereSlug($slug)->first();

        if (!$article) {
            return redirect(r('cms.articles.index'));
        }

        return render('backend/articles/edit', compact('article'));
    }


    /**
     * Controller Update
     *
     * @return mixed
     **/
    public function update()
    {
        $request = new CreateArticleRequest;
        if ($request->validate()) {
            $article = Article::find($request->get('id'));

            $article->keywords = $request->get('keywords');
            $article->description = $request->get('description');
            $article->content = $request->raw()['content'];
            $article->tags = $request->get('tags');
            $article->updated = time();

            if ($article->slug != Format::slug($request->get('title'))) {
                $slug = Format::slug($request->get('title'));
                if (Article::where('slug', $slug)->exists()) {
                    set_form_error('title', "'{$request->get('title')}' is already used.");
                } else {
                    $article->title = $request->get('title');
                    $article->slug = $slug;
                }
            }

            $article->save();
            setflash("message", "<i class='text-success'>Article successfully updated.</i>");
        }
        return redirect($request->origin());
    }


    /**
     * Controller Publish
     *
     * @return mixed
     **/
    public function publish($slug)
    {
        $article = Article::whereSlug($slug)->first();
        if ($article->published == 'yes') {
            $article->published = 'no';
        } else {
            $article->published = 'yes';
        }

        if ($article->save()) {
            echo 1;
        } else {
            echo 0;
        }

    }

}
