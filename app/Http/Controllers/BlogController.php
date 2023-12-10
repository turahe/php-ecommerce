<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Turahe\SEOTools\Contracts\Tools;

class BlogController extends Controller
{
    public function __construct(private Tools $meta)
    {
    }

    public function index()
    {

        $this->meta->setTitle('Blogs');

        return Post::where('type', 'blog')->get();

    }
}
