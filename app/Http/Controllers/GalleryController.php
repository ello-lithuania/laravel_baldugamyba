<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class GalleryController extends Controller
{
    public function add() {
        return view('provider.gallery.add');
    }

    public function store(Request $request) {
        //dd($request);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file.*' => 'required|file|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $gallery = Gallery::create([
            'title' => $request->title,
            'description' => $request->description
        ]);
        foreach($request->file('file') as $image) {
            $rand = rand(1,1000);
            $imageName = time() . $rand . '.' . $image->getClientOriginalExtension();
            $image->move('uploads', $imageName);

            $imageManager = new ImageManager(new Driver());
            $thumbImage = $imageManager->read('uploads/'.$imageName);

            //resize
            $watermarkImg = $imageManager->read('assets/images/watermark.png');
            $watermarkImg->resize(150,78);

            $thumbImage->place( $watermarkImg , 'bottom-right',20,20,90);

            //store
            $thumbImage->save(public_path('uploads/gallery/' . $imageName));
            $delete_img_old = public_path('uploads/'.$imageName);
            if(file_exists($delete_img_old)) {
                unlink($delete_img_old);
            }

            $gallery->images()->create(['file_path' => $imageName]);
        }

        return redirect()->route('dashboard')->with('success', 'Galerija sukurta sėkmingai');
    }

    public function edit(Gallery $gallery) {
        return view('provider.gallery.edit', compact('gallery'));
    }
    public function watch(Gallery $gallery) {
        $public = asset('uploads/gallery/');
        return view('provider.gallery.watch', compact('gallery','public'));
    }

    public function update(Request $request, Gallery $gallery) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file.*' => 'file|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $gallery->update($request->all());

        //dd($request->input('removed_images'));

        $existingImages = $request->input('existing_images', []);
        $removedImages = $request->input('removed_images', []);

                // Remove deleted images from the database
                foreach($removedImages as $item) {
                    $old_item = GalleryImage::where('id', $item)->first();
                    $delete_img_old = public_path('uploads/gallery/'.$old_item->file_path);
                    unlink($delete_img_old);
                    $old_item->delete();
                }
                // Handle the file uploads
                if ($request->hasfile('file')) {
                    foreach($request->file('file') as $image) {
                        $rand = rand(1,1000);
                        $imageName = time() . $rand . '.' . $image->getClientOriginalExtension();
                        $image->move('uploads', $imageName);

                        $imageManager = new ImageManager(new Driver());
                        $thumbImage = $imageManager->read('uploads/'.$imageName);

                        //resize
                        $watermarkImg = $imageManager->read('assets/images/watermark.png');
                        $watermarkImg->resize(150,78);

                        $thumbImage->place( $watermarkImg , 'bottom-right',20,20,90);

                        //store
                        $thumbImage->save(public_path('uploads/gallery/' . $imageName));
                        $delete_img_old = public_path('uploads/'.$imageName);
                        if(file_exists($delete_img_old)) {
                            unlink($delete_img_old);
                        }

                        $gallery->images()->create(['file_path' => $imageName]);
                    }
                }

        return back()->with('success', 'Galerija atnaujinta');
    }

    public function destroy(Gallery $gallery) {

        foreach($gallery->images as $image) {
            $delete_img_old = public_path('uploads/gallery/'.$image->file_path);
            unlink($delete_img_old);
        }

        $gallery->delete();
        return to_route('dashboard')->with('success', 'Galerija ištrinta');
    }

}
