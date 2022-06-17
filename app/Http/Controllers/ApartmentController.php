<?php

namespace App\Http\Controllers;

use App\Add;
use App\Apartment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Apartment $apartment)
    {
        $apartments = Apartment::where('user_id', Auth::id())->orderBy('created_at','asc')->get();
        $adds = Add::where('pivot->apartment_id', $apartment->id);

        return view('admin.apartments.index', compact(['apartments', 'adds']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $adds = Add::all();

        return view('admin.apartments.create', compact('adds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:7|max:200',
            'number_of_room' => 'required|numeric|max:10',
            'number_of_bedroom' => 'required|numeric|max:10',
            'number_of_bathroom' => 'required|numeric|max:10',
            'sqm' => 'required|string|max:100',
            'address' => 'required|string|max:200',
            'cover' => 'file|mimes:jpg,jpeg,gif,png,svg|nullable',
            'visible' => 'boolean',
            'adds' => ['exists:adds,id','required'],
            'user_id' => 'numeric'
        ]);

        $data = $request->all();

        if(array_key_exists('cover', $data)) {
            $cover_path = Storage::put('uploads', $data['cover']);
            $data['cover'] = str_replace('uploads/', 'storage/uploads/', $cover_path);
        };

        $slug = Apartment::getUniqueSlug($data['title']);

        $apartments = new Apartment();
        $apartments->fill($data);
        $apartments->slug = $slug;
        $apartments->user_id = Auth::id();

        $apartments->save();
        $apartments->adds()->sync($data['adds']); 

        return redirect()->route('admin.apartments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $user = Auth::user();
        $adds = Add::all();

        return view('admin.apartments.edit', compact('apartment','user', 'adds',));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        $request->validate([
            'title' => 'required|string|min:7|max:200',
            'number_of_room' => 'required|numeric|max:10',
            'number_of_bedroom' => 'required|numeric|max:10',
            'number_of_bathroom' => 'required|numeric|max:10',
            'sqm' => 'required|string|max:100',
            'address' => 'required|string|max:200',
            'cover' => 'file|mimes:jpg,jpeg,gif,png,svg|nullable',
            'adds' => ['exists:adds,id','required'],
            'visible' => 'boolean',
        ]);

        $data = $request->all();

        if( $apartment->title != $data['title'] ){
            $slug = Apartment::getUniqueSlug($data['title']);
            $data['slug'] = $slug;
        };

        if(array_key_exists('cover', $data)) {
            $cover_path = Storage::put('uploads', $data['cover']);
            $data['cover'] = $cover_path;
        };
        
        $apartment->update($data);
        $apartment->adds()->sync($data['adds']); 
        return redirect()->route('admin.apartments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();

        return redirect()->route('admin.apartments.index');
    }
}
