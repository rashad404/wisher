<?php
 
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Feature;
use App\Models\Blog;
use App\Models\PricingPlan;
use App\Models\Testimonial;

class MainController extends Controller
{
    public function index()
    {
        // Fetching key features, latest blogs, and pricing plans
        // $features = Feature::take(4)->get(); // Get the first 4 features
        $blogs = Blog::latest()->take(3)->get(); // Get the latest 3 blogs
        $plans = PricingPlan::where('is_active', 1)->take(3)->get(); // Get 3 active pricing plans
        // $testimonials = Testimonial::take(3)->get(); // Get 3 testimonials

        return view('main.index', compact('blogs', 'plans'));
        // return view('main.index', compact('features', 'blogs', 'plans', 'testimonials'));
    }

    public function about()
    {
        return view('main.about');
    }

    public function howItWorks()
    {
        return view('main.howItWorks');
    }
}
