<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Artikel;
use App\Models\Auth\Administrator;
use Encore\Admin\Facades\Admin;
use Session;

class UserController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function insertLogin(Request $request){
        

        $credentials = $request->only(['email', 'password']);
        $admin = Administrator::where('email', $request->email)->first();
        if(empty($admin)){
            return redirect('/')->with(['success' => 'Email atau password salah']);
        }else{
            if (Admin::guard()->attempt($credentials)) {
               
                return redirect('/user')->with(['success' => 'Login Berhasil']);
                
            }
        }
    }

    public function getLogout(Request $request)
    {
        Admin::guard()->logout();
        $request->session()->invalidate();
        return redirect("/");
    }


    public function register()
    {
        return view('register');
    }

    public function insertRegister(Request $request){
       $data = $request->all();
       if(!empty($data)){
        // type user
        $data['type'] = 2; 
        $data['password'] = bcrypt($request->password); 
        $data['username'] = $request->name; 
        if(Administrator::create($data)){
            return redirect("/")->with("login", "Berhasil Register");
        }
       }else{
        return abort(500);
       }
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

        if(!$this->isUser()){
            return redirect("/");
        }
        return view('user', compact('course','artikel'));
    }
    public function course()
    {
        if(!$this->isUser()){
            return redirect("/");
        }
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
        if(!$this->isUser()){
            return redirect("/");
        }

        $artikel = Artikel::orderByDesc("created_at")
        ->get();  
        return view('artikel', compact("artikel"));
    }
   
    public function detailArtikel($id)
    {
        if(!$this->isUser()){
            return redirect("/");
        }
        $detailArtikel = Artikel::orderByDesc("created_at")
        ->where("id", $id)
        ->first();
        
        if(!empty($detailArtikel)){
            return view('detailArtikel', compact("detailArtikel"));
        }else{
            return abort(404);
        }
    }
    public function detailCourse($id)
    {   
        if(!$this->isUser()){
            return redirect("/");
        }
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

    private function getYoutubeEmbedUrl($url)
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

    private function isUser(){
        
        if(empty(Admin::user())){
            return false;
        }

        return true;
    }
}
