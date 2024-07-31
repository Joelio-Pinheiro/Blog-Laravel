<?php

namespace App\Http\Controllers;

use App\Models\TextWidget;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class SiteController extends Controller
{
    public function about(): View{
        $widget = TextWidget::query()
        ->where('key', '=', 'about_page')
        ->where('active', '=', true)
        ->first();
        if (!$widget) {
            throw new NotFoundResourceException();
        }

        return view('about', compact('widget'));
    }
}
