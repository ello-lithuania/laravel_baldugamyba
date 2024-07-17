<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientRequest;
use App\Models\Provider;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClientRequestCreated;

class ClientRequestsController extends Controller
{
    public function show()
    {
        $client = ClientRequest::with('user')->latest()->get();
        return view('requests.show', compact('client'));
    }
    public function create()
    {
        return view('requests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:105',
            'description' => 'required|string|max:455',
            'phone' => 'required|string|max:255|regex:/^(\+\d{1,3}[- ]?)?/',
            'city' => 'required',
            'price' => 'required',
            'deadline' => 'required',
        ]);
        $client = ClientRequest::create($request->all());

        $providers = Provider::all('email');

        foreach($providers as $provider) {
            //Mail::to($provider->email)->queue(new ClientRequestCreated($client));
        }

        auth()->user()->clientRequests()->save($client);

        return to_route('dashboard')->with('success', 'Sukurta užklausa sėkmingai');
    }

    public function edit(ClientRequest $client)
    {
        return view('requests.edit', compact('client'));
    }
    public function update(ClientRequest $client, Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:105',
            'description' => 'required|string|max:455',
            'phone' => 'required|string|max:255|regex:/^(\+\d{1,3}[- ]?)?/',
            'city' => 'required',
            'price' => 'required',
            'deadline' => 'required',
            'status' => 'nullable'
        ]);

        $data = $request->all();

        if($request->input('status') == 'on') {
            $data['status'] = 'active';
        } else {
            $data['status'] = 'inactive';
        }

        $client->update($data);

        return to_route('dashboard')->with('success', 'Sukurta užklausa sėkmingai');
    }
    public function destroy(ClientRequest $client)
    {
        if($client->user->id == auth()->user()->id){
            $client->delete();
            return to_route('dashboard')->with('success', 'Užklausa ištrinta sėkmingai');
        } else {
            return back();
        }
    }
}
