<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class ContactController extends Controller
{

     public function index()
    {
         $perPage = Request::input('perPage')? : 5;
        
      
        return Inertia::render("Admin/Users/Index", [      
           
            'contacts' => Persona::query()->when(Request::input('search'), function ($query, $search)
                                {
                                    $query->where('first_name', 'like', "%{$search}%");
                                })
                                ->latest('id')
                                ->paginate($perPage)
                                ->withQueryString()
                                ->through(function($contact){
                                    return [
                                       'id' => $contact->id,
                                       'first_name' => $contact->first_name,
                                       'last_name' => $contact->last_name,
                                       'dni' => $contact->dni,
                                       'direccion' => $contact->direccion,
                                                                                      
                                    ];
                        }),

             'filters' => Request::only(['search', 'perPage']),
            
        ]);
        
    }

    
     public function create()
    {
        $persona = Persona::all();
        return Inertia::render('Admin/Users/Create', [
            'persona' => $persona,
        ]);
    }


        public function store()
    {
         Request::validate([
            'firstname' => "required",
            'lastname' => "required",   
            'dni' => "required|between:8,8",
            'direction' => "required",
            'medidor_id' => "required",
        ]);

       Persona::create([
            'first_name' => Request::input('firstname'),
            'last_name' => Request::input('lastname'),
            'dni' => Request::input('dni'),
            'corte'=>'2001-01-01',
            'reconection'=>false,
            'direccion' => Request::input('direction'),
            'medidor_id' => Request::input('medidor_id'),
            'user_id' => auth()->id(),
        ]);
  
        // return Redirect::route("admin.contact.index")->with('flash.banner', 'Exito!! Usuario Creado');
        return Redirect::route("admin.contacts.show")->with('flash.banner', 'Exito!! Usuario Creado');
    }

      public function edit(Persona $persona)
    {
        return Inertia::render('Admin/Users/Edit', [
              'persona' => $persona,
        ]);
    }
    

    public function update(Persona $persona)
    {
         Request::validate([
                'firstname' => "required",
                'lastname' => "required",  
                'dni' => "required",
                'direccion' => "required",
                'medidor_id' => "required"
               
        ]);


      $persona->update([
            'first_name' => Request::input('firstname'),
            'last_name' => Request::input('lastname'),
            
            'dni' => Request::input('dni'),
            'direccion' => Request::input('direccion'),
            'medidor_id' => Request::input('medidor_id'),
            'user_id' => auth()->id(),
         
         ]);
 

           return Redirect::route('admin.contacts.index')->with('flash.banner', 'Exito!! Usuario Actualizado');
    }


       public function destroy(Persona $persona)
    {
        $persona->delete();

         return Redirect::route('admin.contacts.index')->with('flash.banner', 'Usuario Eliminado.')->with('flash.bannerStyle', 'danger');
    }


    public function show()
    {

        $persona = Persona::latest('id')->first();
        return Inertia::render('Admin/Users/UserDeuda', [
            'persona' => $persona,
        ]);
    }
}
