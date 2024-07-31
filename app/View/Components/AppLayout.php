<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Doctrine\DBAL\Query;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class Applayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $query = Category::query()
        ->join('category_post', 'categories.id', '=', 'category_post.category_id')
        ->select('categories.title', 'categories.slug', DB::raw('count(*) as total'))
        ->groupBy('categories.id')
        ->orderByDesc('total')
        ->limit(5);

        $categories = $query
        ->get();

        return view('layouts.app', compact('categories'));
    }
}
