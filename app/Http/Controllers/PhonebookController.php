<?php

namespace App\Http\Controllers;

use App\Models\Phonebook;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class PhonebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $phonebooks = Phonebook::query();

        if ($request->has('search_key')) {
            $phonebooks->where('first_name', 'like', '%' . $request->input('search_key') . '%')
                ->orWhere('last_name', 'like', '%' . $request->input('search_key') . '%');
        }

        $phonebooks=$phonebooks->get();
        
        return view('phonebook.index', compact('phonebooks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('phonebook.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:200',
            'last_name' => 'nullable|max:200',
            'phone_number' => 'required|min:11|max:15',
            'email' => 'nullable|email|max:200',
            'image_url' => 'nullable|mimes:png,jpeg,jpg|max:500',
        ]);

        Phonebook::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'image_url' => $request->image_url ? $request->file('image_url')->store('public/phonebook') : null,
        ]);

        Toastr::success('Phonebook created successfully.', '', ["positionClass" => "toast-top-center"]);
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Phonebook $phonebook)
    {
        return view('phonebook.edit', compact('phonebook'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Phonebook $phonebook)
    {
        $request->validate([
            'first_name' => 'required|max:200',
            'last_name' => 'nullable|max:200',
            'phone_number' => 'required|min:11|max:15',
            'email' => 'nullable|email|max:200',
            'image_url' => 'nullable|mimes:png,jpeg,jpg|max:500',
        ]);


        $phonebook->first_name = $request->first_name;
        $phonebook->last_name = $request->last_name;
        $phonebook->phone_number = $request->phone_number;
        $phonebook->email = $request->email;

        if ($request->image_url) {
            \Storage::delete($phonebook->image_url);
            $phonebook->image_url = $request->file('image_url')->store('public/phonebook');
        }

        $phonebook->save();

        Toastr::success('Phonebook updated successfully.', '', ["positionClass" => "toast-top-center"]);
        return redirect()->route('phonebook.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phonebook $phonebook)
    {

        if ($phonebook->image_url) {
            \Storage::delete($phonebook->image_url);
        }

        $phonebook->delete();
        Toastr::success('Phonebook deleted successfully.', '', ["positionClass" => "toast-top-center"]);
        return redirect()->route('phonebook.index');
    }
}
