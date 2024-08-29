<?php
 
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Feature;
use App\Models\Blog;
use App\Models\PricingPlan;
use App\Models\Product;
use App\Models\Testimonial;

class MainController extends Controller
{
    public function index()
    {
        // Fetching key features, latest blogs, and pricing plans
        $features = Feature::take(4)->get(); // Get the first 4 features
        $blogs = Blog::latest()->take(3)->get(); // Get the latest 3 blogs
        $plans = PricingPlan::with('features')->get();
        $testimonials = Testimonial::take(3)->get(); // Get 3 testimonials
        $products = Product::with('variants')->take(6)->get();

        return view('main.index', compact('products', 'features', 'blogs', 'plans', 'testimonials'));
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
