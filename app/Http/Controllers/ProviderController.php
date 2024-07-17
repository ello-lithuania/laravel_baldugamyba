<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Provider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;

class ProviderController extends Controller
{
    public function orderDone($id) {
        $order = Order::findOrFail($id);
        if($order->status == 0){
            $order->status = 1;
            $order->save();

            $provider = Provider::where('id', $order->provider_id);

            $number = auth()->user()->credits;
            $count = $number + $order->credits;

            $user = Auth::user();
            $user->credits = $count;
            $user->save();
        }
        return to_route('dashboard')->with('success', 'Mokėjimas atliktas sėkmingai');
    }
    public function orderDone2() {
        return 'OK';
    }
    public function orderCancel() {
        return to_route('dashboard')->with('success', 'Užsakymas atšauktas sėkmingai');
    }

    public function index() {
        $categories = Category::all('name','id');

        return view('provider.index', compact('categories'));
    }

    public function store(Request $request): RedirectResponse {
        //dd($request);
        $request->validate([
            'title' => 'required|string|max:105',
            'description' => 'required|string|max:455',
            'email' => 'required|string|lowercase|email|max:255|unique:'.Provider::class,
            'website' => 'nullable|string|max:255',
            'phone' => 'required|string|max:255|regex:/^(\+\d{1,3}[- ]?)?/',
            'thumbnail' =>'required|file|mimes:jpg,png,gif,jpeg,svg,webp|max:2048',
            'city' => 'required',
            'categories' => 'required',
        ]);

        $path2 = $request->thumbnail;
        // Handle the file upload
        if ($request->file('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('uploads', $imageName);

            $imageManager = new ImageManager(new Driver());
            $thumbImage = $imageManager->read('uploads/'.$imageName);

            //resize
            $watermarkImg = $imageManager->read('assets/images/watermark.png');
            $watermarkImg->resize(150,78);

            $thumbImage->place( $watermarkImg , 'bottom-right',20,20,90);

            //store
            $thumbImage->save(public_path('uploads/thumbnails/' . $imageName));
            $delete_img_old = public_path('uploads/'.$imageName);
            if(file_exists($delete_img_old)) {
                unlink($delete_img_old);
            }
            $path2 = $imageName;
        }

        $profile = new \App\Models\Provider();
        $profile->title = $request->title;
        $profile->description = $request->description;
        $profile->email = $request->email;
        $profile->website = $request->website;
        $profile->phone = $request->phone;
        $profile->city = $request->city;
        $profile->thumbnail = $path2;
        $profile->title = $request->title;
        $user = Auth::user();
        $user->provider_profile()->save($profile);

        foreach($request->categories as $category) {
            $profile->categories()->attach($category);
        }

        return redirect(route('dashboard', absolute: false));
    }

    public function update(Request $request, Provider $provider): RedirectResponse {
        $thumbnail = null;
        if($request->thumbnail == null) {
            $thumbnail = $provider->thumbnail;
        }
        $request->validate([
            'title' => 'required|string|max:105',
            'description' => 'required|string|max:455',
            'email' => 'required|string|lowercase|email|max:255',
            'website' => 'nullable|string|max:255',
            'phone' => 'required|string|max:255|regex:/^(\+\d{1,3}[- ]?)?/',
            'thumbnail' =>'file|mimes:jpg,png,gif,jpeg,svg,webp|max:4096',
            'city' => 'required',
            'categories' => 'required',
        ]);

        $path2 = null;
        // Handle the file upload
        if ($request->file('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('uploads', $imageName);

            $imageManager = new ImageManager(new Driver());
            $thumbImage = $imageManager->read('uploads/'.$imageName);

            //resize
            $watermarkImg = $imageManager->read('assets/images/watermark.png');
            $watermarkImg->resize(150,78);

            $thumbImage->place( $watermarkImg , 'bottom-right',20,20,90);

            //store
            $thumbImage->save(public_path('uploads/thumbnails/' . $imageName));
            $delete_img_old = public_path('uploads/'.$imageName);
            if(file_exists($delete_img_old)) {
                unlink($delete_img_old);
            }
            $path2 = $imageName;
        }
        $provider->update($request->all());

        if($request->thumbnail == null) {
            $provider->thumbnail = $thumbnail;
            $provider->save();
        } else {
            $delete_img_old = public_path('uploads/thumbnails/'.$provider->thumbnail);
            unlink($delete_img_old);
            $provider->thumbnail = $path2;
            $provider->save();
        }

        $provider->categories()->detach();

        foreach($request->categories as $category) {
            $provider->categories()->attach($category);
        }

        return redirect(route('dashboard', absolute: false));
    }

    public function watch(Provider $provider) {
        $galleries = null;
        $providers = Provider::latest()->orderBy('upgrade', 'desc')->paginate(8);
        $now = Carbon::now();
        if($provider->galleries()) {
            $galleries = Gallery::where('provider_id', $provider->id)->with('images')->get();
        }
        return view('provider.show', compact('provider', 'galleries','providers','now'));
    }
    public function search(Request $request) {
        $searchTerm = $request->input('paieska');

        $posts = Provider::where('title', 'like', "%$searchTerm%")
        ->orWhere('description', 'like', "%$searchTerm%")
        ->get();

        return view('provider.search', compact('posts', 'searchTerm'));
    }
    public function edit() {
        $categories = Category::all('name','id');

        return view('provider.edit', compact('categories'));
    }

    public function creditAdd() {
        return view('provider.credits');
    }

    public function creditAdd2($id, Request $request) {
        //dd($request);
        $request->validate([
            'credits' => 'required',
        ]);

        $price = 0;

        if($request->input('credits') == 100) {$price = 100;}
        if($request->input('credits') == 500) {$price = 400;}
        if($request->input('credits') == 700) {$price = 600;}
        if($request->input('credits') == 1000) {$price = 700;}
        if($request->input('credits') == 2000) {$price = 1400;}
        if($request->input('credits') == 5000) {$price = 3000;}

        $order = Order::create([
            'credits' => $request->input('credits'),
            'price' => $price,
            'provider_id' => $id
        ]);

        $data_array = [
            'projectid' => env('PAYSERA_USER'),
            'orderid' => $order->id,
            'accepturl' => route('order-accept', $order->id),
            'cancelurl' => route('order-cancel', $order->id),
            'callbackurl' => route('order-accept2'),
            'amount' => $price,
            'currency' => 'EUR'
        ];
        $data_build = http_build_query($data_array);
        $data_coded = base64_encode($data_build);
        $result = str_replace('/', '_', $data_coded);
        $result2 = str_replace('+', '-', $result);
        $address =  md5($result2 . env('PAYSERA_PASS'));

        dd('https://www.paysera.com/pay/?data=' . $result2 . '&sign=' . $address);

        //return redirect('https://www.paysera.com/pay/?data=' . $result2 . '&sign=' . $address);

        //return to_route('dashboard')->with('success', 'Kreditai pridėti');
    }

    public function upgrade($credits) {

        if($credits == 1 && auth()->user()->credits >= 100) {
            $number = auth()->user()->credits;
            $count = $number - 100;
            $now2 = Carbon::now();
            if(auth()->user()->provider_profile->upgrade >= $now2) {
                $now = auth()->user()->provider_profile->upgrade;
            } else {
                $now = Carbon::now();
            }
            $tomorrow = $now->addDays(2);

            $user = Provider::findOrFail(auth()->user()->provider_profile->id);
            $user->upgrade = $tomorrow;
            $user->save();

            $user2 = User::findOrFail(auth()->user()->id);
            $user2->credits = $count;
            $user2->save();

            return to_route('dashboard')->with('success', 'Skelbimas sėkmingai iškeltas');
        }
        if($credits == 3 && auth()->user()->credits >= 260) {
            $number = auth()->user()->credits;
            $count = $number - 260;
            $now2 = Carbon::now();
            if(auth()->user()->provider_profile->upgrade >= $now2) {
                $now = auth()->user()->provider_profile->upgrade;
            } else {
                $now = Carbon::now();
            }
            $tomorrow = $now->addDays(4);

            $user = Provider::findOrFail(auth()->user()->provider_profile->id);
            $user->upgrade = $tomorrow;
            $user->save();

            $user2 = User::findOrFail(auth()->user()->id);
            $user2->credits = $count;
            $user2->save();

            return to_route('dashboard')->with('success', 'Skelbimas sėkmingai iškeltas');
        }
        if($credits == 7 && auth()->user()->credits >= 600) {
            $number = auth()->user()->credits;
            $count = $number - 600;
            $now2 = Carbon::now();
            if(auth()->user()->provider_profile->upgrade >= $now2) {
                $now = auth()->user()->provider_profile->upgrade;
            } else {
                $now = Carbon::now();
            }
            $tomorrow = $now->addDays(8);

            $user = Provider::findOrFail(auth()->user()->provider_profile->id);
            $user->upgrade = $tomorrow;
            $user->save();

            $user2 = User::findOrFail(auth()->user()->id);
            $user2->credits = $count;
            $user2->save();

            return to_route('dashboard')->with('success', 'Skelbimas sėkmingai iškeltas');
        }

        if($credits == 30 && auth()->user()->credits >= 2000) {
            $number = auth()->user()->credits;
            $count = $number - 2000;
            $now2 = Carbon::now();
            if(auth()->user()->provider_profile->upgrade >= $now2) {
                $now = auth()->user()->provider_profile->upgrade;
            } else {
                $now = Carbon::now();
            }
            $tomorrow = $now->addDays(31);

            $user = Provider::findOrFail(auth()->user()->provider_profile->id);
            $user->upgrade = $tomorrow;
            $user->save();

            $user2 = User::findOrFail(auth()->user()->id);
            $user2->credits = $count;
            $user2->save();

            return to_route('dashboard')->with('success', 'Skelbimas sėkmingai iškeltas');
        }

        return to_route('dashboard')->with('error', 'Įvyko klaida');
    }

}
