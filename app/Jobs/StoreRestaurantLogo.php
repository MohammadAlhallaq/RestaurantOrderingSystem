<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class StoreRestaurantLogo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $id, $imageName, $extension;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $extension, $imageName)
    {
        $this->id = $id;
        $this->imageName = $imageName;
        $this->extension = $extension;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $imageName = $this->imageName . '.' . $this->extension;

        $imagePath = public_path() . '/restaurants/temporary_logos/' . $this->imageName;

        $path = public_path() . '/restaurants/logo/' . $this->id;
        if (!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
            $img = Image::make($imagePath);
            $img->resize(100, 250, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path . '/' . $imageName);
        } else {
            $FileSystem = new Filesystem();
            $directory = public_path() . '/restaurants/logo/' . $this->id;
            if ($FileSystem->exists($directory)) {
                // Get all files in this directory.
                $files = $FileSystem->files($directory);
                // Check if directory is empty.
                if (!empty($files)) {
                    $FileSystem->delete($files);
                }
                $img = Image::make($imagePath);
                $img->resize(100, 250, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($directory . '/' . $imageName);
            }
        }
        File::delete($imagePath);
    }
}
