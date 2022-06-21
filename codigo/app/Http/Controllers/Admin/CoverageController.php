<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator, Str, Config;
use App\Http\Models\Coverage;

class CoverageController extends Controller
{
    public function __Construct(){
    	$this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getList(){
        $states = Coverage::where('ctype', 0)->get();

        $data = [
            'states' => $states
        ];

        return view('admin.coverage.list', $data);
    }

    public function postCoverageStateAdd(Request $request){
        $rules = [
    		'name' => 'required',
            'days' => 'required'
    	];
    	$messagess = [
    		'name.required' => 'Se requiere un nombre para la cobertura.',
            'days' => 'Se requiere los días de entrega para esta cobertura'
    	];

        $validator = Validator::make($request->all(), $rules, $messagess);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $coverage = new Coverage;
            $coverage->ctype = '0';
            $coverage->state_id = '0';
            $coverage->name = e($request->input('name'));
            $coverage->price = '0';
            $coverage->days = $request->input('days');

            if($coverage->save()):

                return back()->with('messages', 'Creada y guardada con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getCoverageStateEdit($id){
        $coverage = Coverage::findOrFail($id);

        $data = [
            'coverage' => $coverage
        ];

        return view('admin.coverage.edit', $data);
    }

    public function postCoverageStateEdit(Request $request, $id){
        $rules = [
    		'name' => 'required',
            'days' => 'required'
    	];
    	$messagess = [
    		'name.required' => 'Se requiere un nombre para la cobertura.',
            'days' => 'Se requiere los días de entrega para esta cobertura'
    	];

        $validator = Validator::make($request->all(), $rules, $messagess);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $coverage = Coverage::find($id);
            $coverage->name = e($request->input('name'));
            $coverage->days = $request->input('days');
            $coverage->status = $request->input('status');

            if($coverage->save()):

                return back()->with('messages', 'Actualizada y guardada con exito!.')
                    ->with('typealert', 'success');
    		endif;

        endif;
    }

    public function getCoverageCities($id){
        $state = Coverage::findOrFail($id);
        $cities = Coverage::where('state_id', $id)->get();

        $data = [
            'cities' => $cities,
            'state' => $state,
            'id' => $id
        ];

        return view('admin.coverage.cities', $data);
    }

    public function postCoverageCityAdd(Request $request){
        $rules = [
    		'name' => 'required',
            'shipping_value' => 'required',
            'days' => 'required'
    	];
    	$messagess = [
    		'name.required' => 'Se requiere un nombre para la cobertura.',
            'shipping_value.required' => 'Se requiere un precio de envió para la cobertura.',
            'days' => 'Se requiere los días de entrega para esta cobertura'
    	];

        $validator = Validator::make($request->all(), $rules, $messagess);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            
            $coverage = new Coverage;
            $coverage->ctype = '1';
            $coverage->state_id = $request->input('state_id');
            $coverage->name = e($request->input('name'));
            $coverage->price = $request->input('shipping_value');
            $coverage->days = $request->input('days');

            if($coverage->save()):

                return back()->with('messages', 'Creada y guardada con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getCoverageCityEdit($id){
        $coverage = Coverage::findOrFail($id);

        $data = [
            'coverage' => $coverage
        ];

        return view('admin.coverage.edit_city', $data);
    }

    public function postCoverageCityEdit(Request $request, $id){
        $rules = [
    		'name' => 'required',
            'shipping_value' => 'required',
            'days' => 'required'
    	];
    	$messagess = [
    		'name.required' => 'Se requiere un nombre para la cobertura.',
            'shipping_value.required' => 'Se requiere un precio de envió para la cobertura.',
            'days' => 'Se requiere los días de entrega para esta cobertura'
    	];

        $validator = Validator::make($request->all(), $rules, $messagess);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $coverage = Coverage::find($id);
            $coverage->name = e($request->input('name'));            
            $coverage->price = $request->input('shipping_value');
            $coverage->days = $request->input('days');
            $coverage->status = $request->input('status');

            if($coverage->save()):

                return back()->with('messages', 'Actualizada y guardada con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getCoverageDelete($id){
        $coverage = Coverage::findOrFail($id);

        if($coverage->delete()):

            return back()->with('messages', 'Eliminado con exito!.')
                ->with('typealert', 'success');
        endif;
    }
}
