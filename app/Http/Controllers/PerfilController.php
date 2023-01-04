<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;


class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        return view('perfil.index');
    }

    public function store(Request $request){
        
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required',  'unique:users,username,' . auth()->user()->id, 'min:3', 'max:30', 'not_in:editar-perfil'],
            'email' => ['min:10', 'email', 'unique:users,email,' . auth()->user()->id]
        
        ]);

        
        if ($request->imagen) {
        
            $imagen = $request->file('imagen');
        
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
        
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);
        
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }
        
        //guardar cambios
        
        $usuario = User::find(auth()->user()->id);
        
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? '';
        $usuario->save();

                // Cambiar la contraseña
                if ($request->password) {

                    if(Hash::check($request->password, $usuario->password)){
                        $usuario->password = Hash::make($request->new_password);
                        $usuario->save();
                    } else {
                        return back()->with('error', 'El password antiguo no coincide.');
                    }
                }
        
        return redirect()->route('posts.index', $usuario->username);



        
    }
}
