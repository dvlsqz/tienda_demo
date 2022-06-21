<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator, Str, Config;

use App\Http\Models\Category;

class CategoriesController extends Controller
{
    public function __Construct(){
    	$this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getHome($module){
    	$cats = Category::where('module', $module)->where('parent', '0')->orderBy('order', 'Asc')->get();
    	$data = ['cats' => $cats, 'module' => $module];
    	return view('admin.categories.home', $data);
    }

    public function postCategoryAdd(Request $request, $module){
    	$rules = [
    		'name' => 'required',
    		'icon' => 'required',
    	];
    	$messagess = [
    		'name.required' => 'Se requiere un nombre para la categoría.',
            'icon.required' => 'Se require un ícono para la categoría.'
    	];

    	$validator = Validator::make($request->all(), $rules, $messagess);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            
            /*$upload_icon = $this->postFileUpload('icon', $request);
            $icon = json_decode($upload_icon, true);
            if($icon['upload'] == "error"):
                return back()->with('messages', '¡No se pudo subir el archivo!.')
                    ->with('typealert', 'danger');
            endif;*/
    		$c = new Category;
    		$c->module = $module;
            $c->parent = $request->input('parent');
    		$c->name = e($request->input('name'));
            $c->slug = Str::slug($request->input('name'));
            $c->icon = $this->postFileUpload('icon', $request);
            
            if($c->save()):
                return back()->with('messages', '¡Creado y guardado con exito!.')
                    ->with('typealert', 'success');
    		endif;
    	endif;
    }

    public function getCategoryEdit($id){
        $cat = Category::find($id);
        $data = ['cat' => $cat];
        return view('admin.categories.edit', $data);
    }

    public function postCategoryEdit(Request $request, $id){
        $rules = [
            'name' => 'required',
        ];
        $messagess = [
            'name.required' => 'Se requiere un nombre para la categoría.'
        ];

        $validator = Validator::make($request->all(), $rules, $messagess);
        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')
                ->with('typealert', 'danger');
        else:
            

            $c = Category::find($id);
            $c->name = e($request->input('name'));
            $c->slug = Str::slug($request->input('name'));
            if($request->hasFile('icon')):
                $actual_icon =  $c->icon;                 
                if(!is_null($c->icon)):
                    $this->getFileDelete('uploads', $actual_icon);
                endif;
                $c->icon = $this->postFileUpload('icon', $request);
            endif;
            $c->order = $request->input('order');
            if($c->save()):

                return back()->with('messages', 'Actualizado y guardado con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getSubCategories($id){
        $cat = Category::findOrFail($id);

        $data = ['cat' => $cat];
    	return view('admin.categories.subs_categories', $data);
    }

    public function getCategoryDelete($id){
        $c = Category::find($id);
        if($c->delete()):
            return back()->with('messages', 'Borrado con exito!.')
                ->with('typealert', 'success');
        endif;
    }
}
