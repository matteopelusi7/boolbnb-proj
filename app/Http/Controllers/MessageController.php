<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Apartment $apartment)
    {
        // $apartments = Apartment::where('user_id', Auth::id())->get();

        // $apartments_id = [];
        // $messages = [];

        // foreach ($apartments as $apartment) {
        //     $apartment_id = $apartment['id'];

        //     array_push($apartments_id, $apartment_id);
        //     $tests = Message::where('apartment_id', $apartment_id)->orderBy('created_at', 'desc')->get();

        //     foreach ($tests as $test) {
        //         if ($test != null) {
        //             array_push($messages, $test);
        //         }
        //     }
        // }
        $apartments = Apartment::where('user_id', Auth::id())->get();
        $apartments_id = $apartments->pluck('id'); 
        $messages = Message::whereIn('apartment_id', $apartments_id)->orderBy('created_at', 'desc')->get();

        return view('admin.messages.index', compact('messages', 'apartment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
