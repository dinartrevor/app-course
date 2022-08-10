<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ArtikelController extends AdminController
{
    protected $articles;
    protected $title = "Artikel";

    public function __construct(){
        $this->articles = new Artikel();
    }

    protected function grid()
    {
        $grid = new Grid($this->articles);

        $grid->id('ID')->sortable();
        $grid->judulArtikel()->ucfirst()->limit(30);
        $grid->tanggalPembuatan();
        $grid->filter(function ($filter) {
            $filter->like('judulArtikel');
            // $filter->between('updated_at')->datetime();
        });

        $grid->disableExport();
        if(Admin::user()->isRole('mentor')){
            $grid->disableCreateButton();
            $grid->disableActions();

        }


        return $grid;
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        $form = new Form($this->articles);

        $form->display('id', 'ID');

        $form->text('judulArtikel',trans('Judul Artikel'))->rules('required');
        $form->textarea('isiArtikel',trans('Deskripsi Artikel'))->rules("required");
        $form->date('tanggalPembuatan', trans('Tanggal Pembuatan'))->rules("required");

        return $form;
    }
    public function detail($id) {
        $show = new Show($this->articles->findOrFail($id));
        $show->field('judulArtikel', "Judul Artikel");
        $show->field('isiArtikel', "Deskripsi Artikel");
        $show->field('tanggalPembuatan', 'Tanggal Pembuatan');
        return $show;
    }
}
