<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Slider;
use Validator, Auth, Config, Str;

class SliderController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getHome(){
        $sliders = Slider::orderBy('sorder', 'Asc')->get();
        $data = ['sliders' => $sliders];

        return view('admin.slider.home', $data);
    }

    public function postSliderAdd(Request $request){
        $rules = [
    		'name' => 'required',
            'image' => 'required',
            'content' => 'required',
            'sorder' => 'required'
    	];
    	$messagess = [
    		'name.required' => 'Se requiere un nombre para el slider.',
            'image.required' => 'Se require una imagen para el slider.',            
            'content.required' => 'Se require un contenido para el slider.',
            'sorder.required' => 'Se require derfinir un orden de aparición para el slider.'
    	];

    	$validator = Validator::make($request->all(), $rules, $messagess);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $path = '/'.date('Y-m-d');
            $fileExt = trim($request->file('image')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt, ' ',$request->file('image')->getClientOriginalName()));
            $filename = rand(1,999).'-'.$name.'.'.$fileExt;

            $slider = new Slider;
            $slider->user_id = Auth::id();
            $slider->status = $request->input('visible');
            $slider->name = e($request->input('name'));
            $slider->file_path = date('Y-m-d');
            $slider->file_name = $filename;
            $slider->content = e($request->input('content'));
            $slider->sorder = e($request->input('sorder'));

            if($slider->save()):
                if($request->hasFile('image')):
                    $fl = $request->image->storeAs($path, $filename, 'uploads');
                endif;

                return back()->with('messages', 'Creado y guardado con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getSliderEdit($id){
        $slider = Slider::findOrFail($id);
        $data = ['slider' => $slider];

        return view('admin.slider.edit', $data);
    }

    public function postSliderEdit(Request $request, $id){
        $rules = [
    		'name' => 'required',
            'content' => 'required',
            'sorder' => 'required'
    	];
    	$messagess = [
    		'name.required' => 'Se requiere un nombre para el slider.',
            'content.required' => 'Se require un contenido para el slider.',
            'sorder.required' => 'Se require derfinir un orden de aparición para el slider.'
    	];

    	$validator = Validator::make($request->all(), $rules, $messagess);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else:
            $slider = Slider::find($id);
            $slider->status = $request->input('visible');
            $slider->name = e($request->input('name'));
            $slider->content = e($request->input('content'));
            $slider->sorder = e($request->input('sorder'));

            if($slider->save()):
                return back()->with('messages', 'Creado y guardado con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getSliderDelete($id){
        $slider = Slider::findOrFail($id);

        if($slider->delete()):
            return back()->with('messages', 'El Slider fue eliminado correctamente!.')
                    ->with('typealert', 'success');
        endif;
    }
}
