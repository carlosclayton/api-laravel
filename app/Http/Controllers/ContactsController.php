<?php

namespace ApiVue\Http\Controllers;

use ApiVue\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index(){
        return Contact::all();
    }


    public function store(Request $request){
        Contact::create(['name' => $request->get('name')]);
        return 'Contact created with sucess';
    }

}
