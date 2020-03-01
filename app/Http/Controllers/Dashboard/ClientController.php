<?php

namespace App\Http\Controllers\Dashboard;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clients = Client::when($request->search, function ($query) use ($request) {

                return $query->where('name','like','%'. $request->search .'%')
                ->orWhere('phone','like','%'. $request->search .'%')
                ->orWhere('address','like','%'. $request->search .'%');

        })->latest()->paginate(3);
    
        return view('dashboard.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('dashboard.clients.create');
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|min:8|numeric',
        ]);

        $request_data = $request->all();

        Client::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.clients.index');

    }//end of store
    



    public function edit(Client $client)
    {
        return view('dashboard.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {

        
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|min:8|numeric',
        ]);


        $client->update($request->all());

        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.clients.index');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.clients.index');

    }
}
