<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Artikel;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use View;

class HomeController extends Controller
{
    public function index(Content $content)
    {

        $course_count  = Course::get()->count();
        $artikel_count = Artikel::get()->count();
        $courses       = Course::orderByDesc("created_at")->limit(10)->get();
        $data = [
            "total_course"  => $course_count,
            "total_artikel" => $artikel_count,
            "courses"       => $courses
        ];
        
        $page = View::make('dashboard', $data);
        $content->body($page);
        return $content
        ->title('Dashboard')
        ->description('Description...');
    }   
}
