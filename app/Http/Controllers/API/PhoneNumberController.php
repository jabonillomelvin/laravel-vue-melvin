<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PhoneNumber;
use Illuminate\Http\Request;
use Validator;

class PhoneNumberController extends Controller
{
    public function index()
    {
        $phoneNumbers = PhoneNumber::orderBy('created_at', 'desc')->get();

        return $phoneNumbers;
    }

    public function submit(Request $request)
    {
        if (!empty($request->input('phoneNumberID'))) {
            $post = PhoneNumber::find($request->input('phoneNumberID'));
        } else {
            $post = new PhoneNumber();
        }

        $post->name = $request->input('name');
        $post->number = $request->input('number');
        $post->save();

        return response()->json('The phone number successfully added');
    }

    public function edit($id)
    {
        $post = PhoneNumber::find($id);

        return response()->json($post);
    }

    // delete post
    public function delete($id)
    {
        $post = PhoneNumber::find($id);
        $post->delete();

        return response()->json('The post successfully deleted');
    }
}