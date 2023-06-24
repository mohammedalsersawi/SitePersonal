<?php

namespace App\Http\Controllers\site;

use App\Models\Job;
use App\Models\Fact;
use App\Models\About;
use App\Models\Skill;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Social;

class MainController extends Controller
{
    public function index()
    {

        $data_about = About::first();
         $my_name = About::with('image')->select('id','name')->first();
        $data_fact = Fact::where('status', 1)->take(4)->get();
        $skills = Skill::where('status', 1)->get();
        $services = Service::where('status', 1)->take(6)->get();
        $jobs = Job::where('status', 1)->select('name')->get();
        $about_job = Job::where('status', 1)->select('name')->take(2)->get();
        $social = Social::where('status', 1)->take(5)->get();
        return view('portal.site.index', compact('data_about', 'social', 'data_fact', 'skills', 'about_job','services', 'my_name' ,'jobs'));
    }
}
