<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {

        $return = Contact::index($request);

        return response()->json($return);
    }

    public function store(Request $request)
    {
        $return = Contact::store($request);

        return response()->json($return, $return['success'] ? 200 : 400);
    }

    public function getbyid($id)
    {

        $return = Contact::getbyid($id);

        return response()->json($return);

    }

    public function update(Request $request)
    {
        $return = Contact::edit($request);

        return response()->json($return);
    }

    public function destroy(Request $request)
    {
        $return = Contact::remove($request);

        return response()->json($return);
    }

}
