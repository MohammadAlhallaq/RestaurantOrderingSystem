<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\SubCategory;
use File;
use DB;

class sub_category extends Controller
{
    //

    function add_sub_category(Request $request)
    {
//dd($request->file('menuPhoto'));
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'categoryName' => 'required|string|min:3|max:255',
                'categoryNameAr' => 'required|string|min:3|max:255|regex:/(^[\s\p{Arabic}])/u',
                'menuPhoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg,jfif',
                'parent_cat'=>'required|numeric'
            ]);
            if ($validator->fails()) {
                return redirect('add-sub-category')
                    ->withInput()
                    ->withErrors($validator);
            } else {
                $categoryName = $request->input('categoryName');
                $categoryNameAr = $request->input('categoryNameAr');
                $parent_cat = $request->input('parent_cat');
                $menuPhoto = $request->file('menuPhoto')->getClientOriginalName();
                $category_model = new SubCategory();
                $category_model->sub_category_name = $categoryName;
                $category_model->sub_category_name_ar = $categoryNameAr;
                $category_model->main_photo = $menuPhoto;
                $category_model->parent_cat_id = $parent_cat;
                $category_model->save();
                $cat_id = $category_model->id;

                $filename = $cat_id;

                $folder = public_path() . '/sub_cat_main/' . $filename . '/';

                $path = $folder;
                if (!File::exists($path)) {
                    //   File::makeDirectory($path,0777,true);
                    /*dd('fff');*/
                    File::makeDirectory($path, $mode = 0777, true, true);
                    $file = $request->file('menuPhoto');
                    $originalFile = $file->getClientOriginalName();
//                    dD($originalFile);
                    $file->move($path, $originalFile);
                } else {
                    $FileSystem = new Filesystem();
                    $directory = $folder;

                    if ($FileSystem->exists($directory)) {
                        // Get all files in this directory.
                        $files = $FileSystem->files($directory);
                        // Check if directory is empty.
                        if (!empty($files)) {
                            $FileSystem->delete($files);
                        }
                        $file = $request->file('menuPhoto');
                        $originalFile = $file->getClientOriginalName();
                        $file->move($path, $originalFile);
                    }
                }
                return redirect('show-sub-category')->with('status', "Insert successfully");// go to show categoryController

            }
        }
        $parent_cat=DB::table('parent_sub_category')->get();
//        dd($parent_cat);
        return view('layout/restaurant-sub-category/add-sub-category',['parent_cat'=>$parent_cat]);
    }


    function show_sub_category()
    {
        $category_model = new SubCategory();
        $cat = $category_model::all();
        return view('layout/restaurant-sub-category/show-sub-category', ['cat' => $cat]);

    }


    function edit_sub_category($category_id, Request $request)
    {

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'categoryName' => 'required|string|min:3|max:255',
                'categoryNameAr' => 'required|string|min:3|max:255|regex:/(^[\s\p{Arabic}])/u',
                'menuPhoto' => 'image|mimes:jpeg,png,jpg,gif,svg,jfif',
                'parent_cat'=>'required|numeric'
            ]);
            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            } else {
                $parent_cat = $request->input('parent_cat');
                $categoryName = $request->input('categoryName');
                $categoryNameAr = $request->input('categoryNameAr');
                if ($request->file('menuPhoto') != null)
                    $menuPhoto = $request->file('menuPhoto')->getClientOriginalName();

                $category_model = new SubCategory();;
                $category_model->exists = true;
                $category_model->id = $category_id; //already exists in database.
                $category_model->sub_category_name = $categoryName;
                $category_model->sub_category_name_ar = $categoryNameAr;
                $category_model->parent_cat_id = $parent_cat;
                if ($request->file('menuPhoto') != null)
                    $category_model->main_photo = $menuPhoto;
                $category_model->save();;

                $filename = $category_id;
                if ($request->file('menuPhoto') != null) {
                    // $folder = storage_path('/app/items/' . $filename . '/');

                    $folder = public_path() . '/sub_cat_main/' . $filename . '/';
                    $path = $folder;
                    if (!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true, true);
                        $file = $request->file('menuPhoto');
                        $originalFile = $file->getClientOriginalName();
                        $file->move($path, $originalFile);
                    } else {
                        $FileSystem = new Filesystem();
                        $directory = $folder;

                        if ($FileSystem->exists($directory)) {
                            // Get all files in this directory.
                            $files = $FileSystem->files($directory);
                            // Check if directory is empty.
                            if (!empty($files)) {
                                $FileSystem->delete($files);
                            }
                            $file = $request->file('menuPhoto');
                            $originalFile = $file->getClientOriginalName();
                            $file->move($path, $originalFile);
                        }
                    }
                }


                return redirect('show-sub-category')->with('status', "edit successfully");// go to show categoryController

            }

        }
        $category_model = new SubCategory();
        $cat = $category_model::find($category_id);
        $cat->cat_url = 'sub_cat_main/' . $category_id . '/' . $cat->main_photo;
        $parent_cat=DB::table('parent_sub_category')->get();
        return view('layout/restaurant-sub-category/edit-sub-category', ['cat' => $cat,'parent_cat'=>$parent_cat]);

    }
}
