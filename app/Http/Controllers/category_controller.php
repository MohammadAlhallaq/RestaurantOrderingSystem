<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use File;

class category_controller extends Controller
{
    //
    function add_restaurant_category(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'categoryName' => 'required|string|min:3|max:255',
                'categoryNameAr' => 'required|string|min:3|max:255|regex:/(^[\s\p{Arabic}])/u',
                'catPhoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg,jfif',
                'sort_number' => 'required'
            ]);
            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            } else {

                $categoryName = $request->input('categoryName');
                $categoryNameAr = $request->input('categoryNameAr');
                $sort_number = $request->input('sort_number');
                $catPhoto = $request->file('catPhoto')->getClientOriginalName();
                $catPhoto = str_replace(" ", "", $catPhoto);
                $category_model = new Category();
                $category_model->category_name = $categoryName;
                $category_model->sort_id = $sort_number;
                $category_model->category_name_ar = $categoryNameAr;
                $category_model->category_photo = $catPhoto;
                $category_model->save();
                $cat_id = $category_model->id;

                $filename = $cat_id;

                $folder = public_path() . '/cat_main/' . $filename . '/';
                $path = $folder;
                if (!File::exists($path)) {
                    //   File::makeDirectory($path,0777,true);
                    /*dd('fff');*/
                    File::makeDirectory($path, $mode = 0777, true, true);
                    $file = $request->file('catPhoto');
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
                        $file = $request->file('catPhoto');
                        $originalFile = $file->getClientOriginalName();
                        $file->move($path, $originalFile);
                    }
                }
                return redirect('show-category')->with('status', "Insert successfully");// go to show categoryController

            }
        }
        return view('layout/restaurant-category/add-restaurant-category');
    }

    function show_restaurant_category()
    {
        $category_model = new Category();
        $cat = $category_model::all();

        return view('layout/restaurant-category/show-restaurant-category', ['cat' => $cat]);

    }

    function edit_category($category_id, Request $request)
    {

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'categoryName' => 'required|string|min:3|max:255',
                'categoryNameAr' => 'required|string|min:3|max:255|regex:/(^[\s\p{Arabic}])/u',
                'catPhoto' => 'image|mimes:jpeg,png,jpg,gif,svg,jfif',
                'sort_number' => 'required'
            ]);
            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            } else {
                $categoryName = $request->input('categoryName');
                $categoryNameAr = $request->input('categoryNameAr');
                $sort_number = $request->input('sort_number');
                if ($request->file('catPhoto') != null) {
                    $catPhoto = $request->file('catPhoto')->getClientOriginalName();
                    $catPhoto = str_replace(" ", "", $catPhoto);
                }
//dd($catPhoto);
                $category_model = new Category();
                $category_model->exists = true;
                $category_model->id = $category_id; //already exists in database.
                $category_model->sort_id = $sort_number;
                $category_model->category_name = $categoryName;
                $category_model->category_name_ar = $categoryNameAr;
                if ($request->file('catPhoto') != null)
                    $category_model->category_photo = $catPhoto;
                $category_model->save();;

                $filename = $category_id;
                if ($request->file('catPhoto') != null) {
                    // $folder = storage_path('/app/items/' . $filename . '/');
                    $filename = str_replace(" ", "", $filename);
                    $folder = public_path() . '/cat_main/' . $filename . '/';
                    $path = $folder;
                    if (!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true, true);
                        $file = $request->file('catPhoto');
                        $originalFile = $file->getClientOriginalName();
                        $originalFile = str_replace(" ", "", $originalFile);
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
                            $file = $request->file('catPhoto');
                            $originalFile = $file->getClientOriginalName();
                            $originalFile = str_replace(" ", "", $originalFile);
                            $file->move($path, $originalFile);
                        }
                    }
                }

                return redirect('show-category')->with('status', "edit successfully");// go to show categoryController

            }

        }
        $category_model = new Category();
        $cat = $category_model::find($category_id);
        $cat->cat_url = 'cat_main/' . $category_id . '/' . $cat->category_photo;
        return view('layout/restaurant-category/edit-restaurant-category', ['cat' => $cat]);

    }
}
