<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

use App\User;
use App\Models\Roles;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('rol_id', '<>', 2)->latest()->paginate(10);
        return view('admin.users.index', ["users" => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Roles::where('status', 1)->get();
        return view('admin.users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'first_last_name' => 'required|string|max:255',
            'second_last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'rol_id' => 'required|numeric',
            'password' => 'required|string|min:6|confirmed',
        ];

        $messages = [
            'name.required' => 'El campo nombre es requerido',
            'name.max:255' => 'El campo nombre solo permite 255 caracteres',
            'name.string' => 'El campo nombre debe ser texto',
            'first_last_name.required' => 'El campo apellido paterno es requerido',
            'first_last_name.required' => 'El campo apellido paterno solo permite 255 caracteres',
            'first_last_name.required' => 'El campo apellido paterno debe ser texto',
            'second_last_name.required' => 'El campo apellido materno es requerido',
            'second_last_name.max:255' => 'El campo apellido materno solo permite 255 caracteres',
            'second_last_name.string' => 'El campo apellido materno debe ser texto',
            'email.required' => 'El campo email es requerido',
            'email.email' => 'El campo email no es válido',
            'email.max:255' => 'El campo email solo permite 255 caracteres',
            'email.string' => 'El campo email debe ser texto',
            'email.unique' => 'El email que ingreso ya se encuentra registrado',
            'rol_id.required' => 'El campo rol es requerido',
            'rol_id.numeric' => 'Debe seleccionar un rol correcto',
            'password.required' => 'El campo contraseña es requerido',
            'password.min:6' => 'El campo contraseña debe contener al menos 6 caracteres',
            'password.string' => 'El campo contraseña debe ser texto',
            'password.confirmed' => 'Debe confirmar la contraseña correctamente',
        ];

        $this->validate($request, $rules, $messages);

        try {

            $user = new User();
            $user->name = $request->name;
            $user->first_last_name = $request->first_last_name;
            $user->second_last_name = $request->second_last_name;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->rol_id = $request->rol_id;

            if ($user->save()) {
                //Mail::to($request->email)->send(new RegisterUserMail($user));

                return redirect()->route('users.index');
            }

            return back()->with('error', 'Por el momento no se puede realizar la acción solicitada.');
        } catch (QueryException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.users.show', ["user" => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('roles')->where('id', $id)->first();
        return view('admin.users.edit', ["user" => $user]);
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
        $rules = [
            'name' => 'required|string|max:255',
            'first_last_name' => 'required|string|max:255',
            'second_last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'rol_id' => 'required|numeric'
        ];

        $messages = [
            'name.required' => 'El campo nombre es requerido',
            'name.max:255' => 'El campo nombre solo permite 255 caracteres',
            'name.string' => 'El campo nombre debe ser texto',
            'first_last_name.required' => 'El campo apellido paterno es requerido',
            'first_last_name.required' => 'El campo apellido paterno solo permite 255 caracteres',
            'first_last_name.required' => 'El campo apellido paterno debe ser texto',
            'second_last_name.required' => 'El campo apellido materno es requerido',
            'second_last_name.max:255' => 'El campo apellido materno solo permite 255 caracteres',
            'second_last_name.string' => 'El campo apellido materno debe ser texto',
            'email.required' => 'El campo email es requerido',
            'email.email' => 'El campo email no es válido',
            'email.max:255' => 'El campo email solo permite 255 caracteres',
            'email.string' => 'El campo email debe ser texto',
            'email.unique' => 'El email que ingreso ya se encuentra registrado',
            'rol_id.required' => 'El campo rol es requerido',
            'rol_id.numeric' => 'Debe seleccionar un rol correcto'
        ];

        $this->validate($request, $rules, $messages);

        try {

            $user = User::where('id', $id)->first();
            $user->name = $request->name;
            $user->first_last_name = $request->first_last_name;
            $user->second_last_name = $request->second_last_name;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->rol_id = $request->rol_id;

            if ($user->save()) {
                //Mail::to($request->email)->send(new UpdateUserMail($user));
                Auth::logout();

                return redirect()->route('login');
            }

            return back()->with('error', 'Por el momento no se puede realizar la acción solicitada.');
        } catch (QueryException $e) {
            return back()->with('error', $e->getMessage());
        }
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

    /**
     * update status the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        try {

            $user = User::where('id', '<>', $id)->first();

            if ($user) {

                try {
                    $user = User::where('id', $id)->first();

                    if ($user->status == 1) {
                        $user->status = 0;
                    } else {
                        $user->status = 1;
                    }

                    if ($user->save()) {
                        //Mail::to($user->email)->send(new StatusUserMail($user));

                        return redirect()->route('users.index');
                    }

                    return back()->with('error', 'Por el momento no se puede realizar la acción solicitada.');
                } catch (QueryException $e) {
                    return back()->with('error', $e->getMessage());
                }
            } else {
                return redirect()->back()->withErrors('No se puede cambiar el estatus de este usuario.');
            }
        } catch (QueryException $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
