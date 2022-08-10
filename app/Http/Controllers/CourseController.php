<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Course;
use App\Models\Auth\Administrator;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
class CourseController extends AdminController
{
    protected $courses;
    protected $title = "Course";

    public function __construct(){
        $this->courses = new Course();
    }

    protected function grid()
    {
        $grid = new Grid($this->courses);

        $grid->id('ID')->sortable();
        $grid->namaCourse()->ucfirst()->limit(30);
        $grid->filter(function ($filter) {
            $filter->like('namaCourse');
            $filter->between('updated_at')->datetime();
        });
        if(Admin::user()->isRole('administrator')){
            $grid->disableCreateButton();
            $grid->disableActions();

        }
        
        $grid->disableExport();


        return $grid;
    }



    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        $mentor = Administrator::whereHas('roles', function($q){
            $q->where('id', '!=', '1');
        })->get()->pluck("name","id");

        $form = new Form($this->courses);

        $form->display('id', 'ID');
        $form->text('namaCourse',trans('Nama Kursus'))->rules('required');
        $form->text('video',trans('Link Video'))->rules('required');
        $form->textarea('deskripsi',trans('Deskripsi Kursus'))->rules("required");
        $form->select('idMentor',trans('Mentor'))->options($mentor)->rules("required");

        return $form;
    }
    public function detail($id) {
        $show = new Show($this->courses->findOrFail($id));
        $show->field('namaCourse', "Nama Course");
        $show->field('video', "Link Video");
        $show->field('deskripsi', 'Deskripsi Course');
        return $show;
    }
}