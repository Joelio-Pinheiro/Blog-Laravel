<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostView;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home(): View
    {
        //Ultimas Postagens
        $latestPost = Post::where('active', '=', 1)
        ->whereDate('published_at', '<', Carbon::now())
        ->orderBy('published_at', 'desc')
        ->limit(1)
        ->first();

        // Os 3 posts mais populares com base em upvotes
        $popularPosts = Post::query()
        ->leftJoin('upvote_downvotes', 'posts.id', '=', 'upvote_downvotes.post_id')
        ->select('posts.*', DB::raw('COUNT(upvote_downvotes.id) as upvote_count'))
        ->where(function($query){
            $query->whereNull('upvote_downvotes.is_upvote')
            ->orWhere('upvote_downvotes.is_upvote', '=', 1);
        })
        ->where('active', '=', 1)
        ->whereDate('published_at', '<', Carbon::now())
        ->orderByDesc('upvote_count')
        ->groupBy('posts.id')
        ->limit(3)
        ->get();

        // Se usuario autorizado - Mostre posts recomendados com base nos upVotes do User

        // Se não autorizado - Mostre posts recomendados com base nas views

        // Mostre as categorias recentes com base nos ultimos posts

        return view('home', compact('latestPost', 'popularPosts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post, Request $request)
    {

        if (!$post->active || $post->published_at > Carbon::now()) {
            throw new NotFoundHttpException();
        }

        $next = Post::query()
            ->where('active', true)
            ->where('published_at', '<=', Carbon::now())
            ->where('published_at', '<', $post->published_at)
            ->orderBy('published_at', 'desc')
            ->limit(1)
            ->first();
        $prev = Post::query()
            ->where('active', true)
            ->where('published_at', '<=', Carbon::now())
            ->where('published_at', '>', $post->published_at)
            ->orderBy('published_at', 'asc')
            ->limit(1)
            ->first();

        $user = $request->user();
        $token = ($post->id);
        $cookieValue = $request->cookie($token);

        if (!$cookieValue) {
            PostView::create([
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'post_id' => $post->id,
                'user_id' => $user?->id,
            ]);

            $cookieValue = $post->id;
            Cookie::queue($token, $cookieValue, 5);
        }

        return view('post.view', compact('post', 'prev', 'next'));
    }

    function byCategory(Category $category)
    {
        $posts = Post::query()
            ->join('category_post', 'posts.id', '=', 'category_post.post_id')
            ->where('category_post.category_id', '=', $category->id)
            ->where('active', '=', true)
            ->whereDate('published_at', '<=', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('post.index', compact('posts', 'category'));
    }
}
