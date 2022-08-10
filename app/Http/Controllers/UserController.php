<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Artikel;
class UserController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }
    public function user()
    {
        $course = Course::select("courses.*","admin_users.name as name_mentor")
        ->join('admin_users', "courses.idMentor", "=", "admin_users.id")
        ->orderByDesc("courses.created_at")
        ->limit(3)
        ->get();  

        $artikel = Artikel::orderByDesc("created_at")
        ->limit(3)
        ->get();  

        if(!empty($course)){
            foreach($course as $key => $value){
                $course[$key]->embed_video = $this->getYoutubeEmbedUrl($value->video);
            }
        }

        return view('user', compact('course','artikel'));
    }
    public function course()
    {
        $course = Course::select("courses.*","admin_users.name as name_mentor")
        ->join('admin_users', "courses.idMentor", "=", "admin_users.id")
        ->get();    

        if(!empty($course)){
            foreach($course as $key => $value){
                $course[$key]->embed_video = $this->getYoutubeEmbedUrl($value->video);
            }
        }
        return view('course', compact("course"));
    }
    public function artikel()
    {
        $artikel = Artikel::orderByDesc("created_at")
        ->get();  
        return view('artikel', compact("artikel"));
    }

    function getYoutubeEmbedUrl($url)
    {
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
        $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

        if (preg_match($longUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }

        if (preg_match($shortUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }
        return 'https://www.youtube.com/embed/' . $youtube_id;
    }
    public function detailArtikel()
    {
        $detailArtikel = Artikel::orderByDesc("created_at")
        ->get();  
        return view('detailArtikel', compact("detailArtikel"));
    }
    public function detailCourse($id)
    {
        $detailCourse = Course::select("courses.*","admin_users.name as name_mentor")
        ->join('admin_users', "courses.idMentor", "=", "admin_users.id")
        ->where("courses.id", $id)
        ->first();    

        if(!empty($detailCourse)){
            $embed_video = $this->getYoutubeEmbedUrl($detailCourse->video);
            return view('detailCourse', compact("detailCourse","embed_video"));
        }else{
            return abort(404);
        }
        
    }
}
