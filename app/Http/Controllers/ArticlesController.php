<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use File;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::with('sub_category')->get();
        return view('layout.articles.show-articles', compact('articles'));
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {

            $rules = [
                'title' => 'required|min:3|max:30',
                'title_ar' => 'required|min:3|max:30|regex:/(^[\s\p{Arabic}])/u',
                'description' => 'required|min:5|max:500',
                'description_ar' => 'required|min:5|max:500|regex:/(^[\s\p{Arabic}])/u',
                'sub_category' => 'required|numeric',
                'image' => 'required|mimes:jpeg,jpg,png|max:500'
            ];

            $messages = [
                'image.max' => 'Restaurant Logo Maximum Picture size is 500 KB'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'result' => 'false',
                    'errors' => $validator->errors(),
                ]);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $article = Article::create([
                'title' => $request->title,
                'title_ar' => $request->title_ar,
                'description' => $request->description,
                'description_ar' => $request->description_ar,
                'sub_category_id' => $request->sub_category,
                'image_path' => $imageName
            ]);

            if ($article) {
                File::makeDirectory($article->store_path(), $mode = 0777, true, true);
                $image = $request->file('image');
                $input['imagename'] = time() . '.' . $image->extension();
                $img = Image::make($image->path());
                $img->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($article->store_path() . '/' . $input['imagename']);

                return response()->json([
                    'result' => true,
                ]);
            }
        }
        return view('layout.articles.store-article');
    }


    public function destroy(Article $article): JsonResponse
    {
        $FileSystem = new Filesystem();
        if ($FileSystem->exists($article->store_path())) {
            $files = $FileSystem->files($article->store_path());
            if (!empty($files)) {
                $FileSystem->deleteDirectory($article->store_path());
            }
        }
        $article->delete();

        return response()->json([
            'status' => true,
            'message' => 'article has been deleted'
        ]);
    }

    public function update(Article $article, Request $request)
    {
        if ($request->isMethod('PATCH')) {

            $rules = [
                'title' => 'required|min:3|max:30',
                'title_ar' => 'required|min:3|max:30|regex:/(^[\s\p{Arabic}])/u',
                'description' => 'required|min:5|max:500',
                'description_ar' => 'required|min:5|max:500|regex:/(^[\s\p{Arabic}])/u',
                'sub_category' => 'required|numeric',
            ];

            $messages = [
                'image.max' => 'Restaurant Logo Maximum Picture size is 500 KB'
            ];

            if ($request->file('image')) {
                $rules['image'] = 'mimes:jpeg,jpg,png|max:500';
            }

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'result' => 'false',
                    'errors' => $validator->errors(),
                ]);
            }


            $article->update([
                'title' => $request->title,
                'title_ar' => $request->title_ar,
                'description' => $request->description,
                'description_ar' => $request->description_ar,
                'sub_category_id' => $request->sub_category,
            ]);

            if ($request->file('image')) {
                $FileSystem = new Filesystem();
                if ($FileSystem->exists($article->store_path())) {
                    // Get all files in this directory.
                    $files = $FileSystem->files($article->store_path());
                    // Check if directory is empty.
                    if (!empty($files)) {
                        $FileSystem->delete($files);
                    }
                    $image = $request->file('image');
                    $input['imagename'] = time() . '.' . $image->extension();
                    $img = Image::make($image->path());
                    $img->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($article->store_path() . '/' . $input['imagename']);
                }else{
                    File::makeDirectory($article->store_path(), $mode = 0777, true, true);
                    $image = $request->file('image');
                    $input['imagename'] = time() . '.' . $image->extension();
                    $img = Image::make($image->path());
                    $img->resize(400, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($article->store_path() . '/' . $input['imagename']);
                }
                $article->image_path = $input['imagename'];
                $article->save();
            }
            return response()->json([
                'result' => true,
            ]);
        }
        return view('layout.articles.update-article', compact('article'));
    }
}
