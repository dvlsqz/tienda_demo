<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Image, Auth, Config, Str, Hash;
use App\Models\User, App\Http\Models\Coverage, App\Http\Models\UserAddress;

class UserController extends Controller
{
    public function __Construct(){
    	$this->middleware('auth');
    }

    public function getAccountEdit(){
        $birthday = (is_null(Auth::user()->birthday)) ? [null,null,null] : explode('-', Auth::user()->birthday);
        $data = ['birthday' => $birthday];
        return view('user.account_edit', $data);
    }

    public function postAccountAvatar(Request $request){
        $rules = [
            'avatar' => 'required',
        ];

        $messages = [
            'avatar.required' => 'Seleccione una imagen.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')
            ->with('typealert', 'danger')->withInput();
        else:
            
            if($request->hasFile('avatar')):
                $u = User::find(Auth::id());
                $u->avatar = $this->postFileUpload('avatar', $request, [[64, 64, '64x64']]);

                if($u->save()):
                    
                    return back()->with('messages', 'Avatar actualizado con exito!.')
                        ->with('typealert', 'success');
                endif;

            endif;
        endif;
    }

    public function postAccountPassword(Request $request){
        $rules = [
            'apassword' => 'required|min:8',
            'password' => 'required|min:8',
            'cpassword' => 'required|min:8|same:password'
            
        ];

        $messages = [
            'apassword.required' => 'Escriba su contraseña actual.',
            'apassword.min' => 'La contraseña actual debe de tener al menos 8 caracteres',
            'password.required' => 'Escriba su nueva contraseña .',
            'password.min' => 'Su nueva contraseña debe de tener al menos 8 caracteres',
            'cpassword.required' => 'Confirme su nueva contraseña .',
            'cpassword.min' => 'SLa confirmación de la nueva contraseña debe de tener al menos 8 caracteres',
            'cpassword.same' => 'Las contraseñas no coinciden'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')
            ->with('typealert', 'danger')->withInput();
        else:
            $u = User::find(Auth::id());

            if(Hash::check($request->input('apassword'), $u->password)):
                $u->password = Hash::make($request->input('password'));

                if($u->save()):
                    return back()->with('messages', 'La contraseña se actualizo con exito!.')
                        ->with('typealert', 'success');
                endif;
            else:
                return back()->with('messages', 'Su contraseña actual es errónea, verifiquela por favor.')
                ->with('typealert', 'danger');
            endif;           
        endif;
    }

    public function postAccountInfo(Request $request){
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'phone' => 'required|min:8',
            'year' => 'required',
            'day' => 'required'
            
        ];

        $messages = [
            'name.required' => 'Su nombre es requerido.',
            'lastname.required' => 'Su apellido es requerido.',
            'phone.required' => 'El numero de telefono es requerido.',
            'phone.min' => 'El numero de telefono debe de tener al menos 8 digitos.',
            'year.required' => 'El año de nacimiento es requerido.',
            'day.required' => 'El día de nacimiento es requerido.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')
            ->with('typealert', 'danger')->withInput();
        else:
            $date = $request->input('year').'-'.$request->input('month').'-'.$request->input('day');
            $u = User::find(Auth::id());
            $u->name = e($request->input('name'));
            $u->lastname = e($request->input('lastname'));
            $u->phone = e($request->input('phone'));
            $u->birthday = date("Y-m-d", strtotime($date));
            $u->gender = e($request->input('gender'));

            if($u->save()):
                return back()->with('messages', 'Su información se actualizo con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getAccountAddress(){
        $states = Coverage::where('ctype', '0')->pluck('name', 'id');

        $data = [
            'states' => $states
        ];

        return view('user.account_address', $data);
    }

    public function postAccountAddressAdd(Request $request){
        $rules = [
            'name' => 'required',
            'state' => 'required',
            'city' => 'required',
            'add1' => 'required',
            'add2' => 'required'
            
        ];

        $messages = [
            'name.required' => 'El nombre es requerido.',
            'state.required' => 'Seleccione un departamento.',
            'city.required' => 'Seleccione un municipio.',
            'add1.required' => 'Ingrese la direccion de envio.',
            'add2.required' => 'Ingrese la zona de su direccion.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')
            ->with('typealert', 'danger')->withInput();
        else:
            $address = new UserAddress;
            $address->name = $request->input('name');
            $address->user_id = Auth::id();
            $address->state_id = $request->input('state');
            $address->city_id = $request->input('city');
            $info = [
                'add1' => e($request->input('add1')),
                'add2' => e($request->input('add2')),
                'add3' => e($request->input('add3')),
                'add4' => e($request->input('add4'))
            ];
            $address->addr_info = json_encode($info);

            if(count(collect(Auth::user()->getAddress)) == "0" ):
                $address->default = "1";
            endif;

            if($address->save()):
                return back()->with('messages', '¡Direccion de envio, guardada con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getAccountAddressSetDefault(UserAddress $address){
        if(Auth::id() != $address->user_id):
            return back()->with('messages', '¡No puede editar esta dirección de entrega!.')
                    ->with('typealert', 'danger');
        else:
            // remove default prew address
            //$default = Auth::user()->getAddressDefault->id;
            $default = UserAddress::find(Auth::user()->getAddressDefault->id);
            $default->default = "0";
            $default->save();

            //new default address
            $address->default = "1";
            if($address->save()):
                return back()->with('messages', '¡Asignación de dirección principal con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getAccountAddressDelete(UserAddress $address){
        if(Auth::id() != $address->user_id):
            return back()->with('messages', '¡No puede eliminar esta dirección de entrega!.')
                    ->with('typealert', 'danger');
        else:
            if($address->default == "0"):
                if($address->delete()):
                    return back()->with('messages', '¡Eliminación de dirección principal con exito!.')
                        ->with('typealert', 'success');
                endif;
            else:
                return back()->with('messages', '¡No puede eliminar una dirección principal!.')
                    ->with('typealert', 'danger');
            endif;
        endif;
    }
}

