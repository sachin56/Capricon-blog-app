<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\post;
use App\Models\category;
use App\Models\User;

class WebsiteController extends Controller
{
    public function home(){
        $posts = Post::with('category', 'user')->orderBy('created_at', 'DESC')->take(5)->get();
        $firstPosts2 = $posts->splice(0, 1);
        $middlePost = $posts->splice(0, 1);
        $lastPosts = $posts->splice(0,1);
        $lastPosts1 = $posts->splice(0,1);

        $footerPosts = Post::with('category', 'user')->inRandomOrder()->limit(4)->get();
        $firstFooterPost = $footerPosts->splice(0, 1);
        $firstfooterPosts2 = $footerPosts->splice(0, 2);
        $lastFooterPost = $footerPosts->splice(0, 1);

        $categories = Category::all();

        $recentPosts = Post::with('category', 'user')->orderBy('created_at', 'DESC')->paginate(9);
        
        return view('website.index', compact(['posts', 'recentPosts', 'firstPosts2', 'middlePost', 'lastPosts','lastPosts1', 'firstFooterPost', 'firstfooterPosts2', 'lastFooterPost','categories']));
    }

    public function post($slug){
        $post = Post::with('category', 'user')->where('slug', $slug)->first();
        $posts = Post::with('category', 'user')->inRandomOrder()->limit(3)->get();

        // More related posts
        $relatedPosts = Post::orderBy('category_id', 'desc')->inRandomOrder()->take(4)->get();
        $firstRelatedPost = $relatedPosts->splice(0, 1);
        $firstRelatedPosts2 = $relatedPosts->splice(0, 2);
        $lastRelatedPost = $relatedPosts->splice(0, 1);

        $categories = Category::all();

        if($post){
            return view('website.post', compact(['post', 'posts', 'categories', 'firstRelatedPost', 'firstRelatedPosts2', 'lastRelatedPost']));
        }else {
            return redirect('/');
        }
    }

    public function category($slug){
        $categories = Category::all();
        $category = Category::where('slug', $slug)->first();
        if($category){
            $posts = Post::where('category_id', $category->id)->paginate(9);

            return view('website.category', compact(['category', 'posts','categories']));
        }else {
            return redirect()->route('website');
        }
    }

    public function about(){
        $user = User::first();
        $categories = Category::all();
        return view('website.about', compact('user','categories'));
    }
}
