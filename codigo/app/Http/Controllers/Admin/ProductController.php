<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Models\Category, App\Http\Models\Product, App\Http\Models\PGallery, App\Http\Models\Inventory, App\Http\Models\Variant;
use Validator, Str, Config, Image;

class ProductController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getProducts($status){
        switch ($status) {
            case '0':
                $products = Product::with(['cat', 'getSubCategory'])->where('status', '0')->orderBy('id', 'desc')->paginate(25);
                break;
            case '1':
                $products = Product::with(['cat', 'getSubCategory'])->where('status', '1')->orderBy('id', 'desc')->paginate(25);
                break;
            case 'all':
                $products = Product::with(['cat','getSubCategory'])->orderBy('id', 'desc')->paginate(25);
                break;
            case 'trash':
                $products = Product::with(['cat','getSubCategory'])->onlyTrashed()->orderBy('id', 'desc')->paginate(25);
                break;
        }
        
        $data = ['products' => $products];
    	return view('admin.products.home', $data);
    }

    public function getProductAdd(){
        $cats = Category::where('module', '0')->where('parent', '0')->pluck('name', 'id');
        $data = ['cats' => $cats];
    	return view('admin.products.add', $data);
    }

    public function postProductAdd(Request $request){
        $rules = [
            'name' => 'required',
            'img' => 'required',
            'content' => 'required'
        ];

        $messages = [
            'name.required' => 'Se requiere un nombre para el producto.',
            'img.required' => 'Se require una imagen destacada para el producto.',
            'img.image' => 'El archivo seleccionado debe ser una imagen.',
            'content.required' => 'Se require un contenido o descripción para el producto.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')
            ->with('typealert', 'danger')->withInput();
        else:
            $p = new Product;
            $p->status =  '0';
            $p->code =  e($request->input('code'));
            $p->name = e($request->input('name'));
            $p->slug = Str::slug($request->input('name'));
            $p->category_id = $request->input('category');            
            $p->subcategory_id = $request->input('subcategory');
            $p->image = $p->image = $this->postFileUpload('img', $request, [[256, 256, '256x256']]);
            $p->in_discount = $request->input('indiscount');
            $p->discount = $request->input('discount');
            $p->content = e($request->input('content'));

            if($p->save()):
                
                return redirect('/admin/product/'.$p->id.'/edit')->with('messages', 'Creado y guardado con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getProductEdit($id){
        $p = Product::findOrFail($id);
        $cats = Category::where('module','0')->where('parent', '0')->pluck('name','id');
        $data = ['cats' => $cats, 'p' => $p];

        return view('admin.products.edit', $data);
    }

    public function postProductEdit(Request $request, $id){
        $rules = [
            'name' => 'required',
            'img' => 'image',
            'content' => 'required'
        ];

        $messages = [
            'name.required' => 'Se requiere un nombre para el producto.',
            'img.image' => 'El archivo seleccionado debe ser una imagen.',
            'content.required' => 'Se require un contenido o descripción para el producto.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')
            ->with('typealert', 'danger')->withInput();
        else:
            $p = Product::findOrFail($id);
            $ipp = $p->file_path;
            $ip = $p->image;
            $p->status =  $request->input('status');
            $p->code = e($request->input('code'));
            $p->name = e($request->input('name'));
            $p->category_id = $request->input('category');
            $p->subcategory_id = $request->input('subcategory'); 

            if($request->hasFile('img')):
                $actual_image =  $p->image;                 
                if(!is_null($p->image)):
                    $this->getFileDelete('uploads', $actual_image, [256, 256, '256x256']);
                endif;
                $p->image = $this->postFileUpload('img', $request, [[256, 256, '256x256']]);
            endif;

            $p->in_discount = $request->input('indiscount');
            $p->discount = $request->input('discount');
            $p->discount_until_date = $request->input('discount_until_date');
            $p->content = e($request->input('content'));

            if($p->save()):
                $this->getUpdateMinPrice($p->id);

                
                return back()->with('messages', 'Actualizado y guardado con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }    

    public function postProductGalleryAdd(Request $request, $id){
        $rules = [
            'file_image' => 'required',
        ];

        $messages = [
            'file_image.required' => 'Seleccione una imagen.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')
            ->with('typealert', 'danger')->withInput();
        else:
            
            if($request->hasFile('file_image')):

                $g = new PGallery;
                $g->product_id = $id;
                $g->file_name = $this->postFileUpload('file_image', $request, [[256, 256, '256x256']]);

                if($g->save()):
                    
                    return back()->with('messages', 'Imagen subida con exito!.')
                        ->with('typealert', 'success');
                endif;

            endif;
        endif;

    }

    public function getProductGalleryDelete($id, $gid){
        $g = PGallery::findOrFail($gid);
        if($g->product_id != $id):
            return back()->with('messages', 'La imagen no se puede eliminar.')
                        ->with('typealert', 'danger');
        else:
            if($g->delete()):                
                return back()->with('messages', 'Imagen borrada con exito!.')
                        ->with('typealert', 'success');
            endif;
        endif;
    }

    public function postProductSearch(Request $request){
        $rules = [
            'search' => 'required'
        ];

        $messages = [
            'search.required' => 'El campo consulta es requerido.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return redirect('/admin/products/1')->withErrors($validator)->with('messages', 'Se ha producido un error.')
            ->with('typealert', 'danger')->withInput();
        else:
            switch($request->input('filter')):
                case '0':
                    $products = Product::with(['cat'])->where('name','LIKE', '%'.$request->input('search').'%')->where('status',$request->input('status'))->orderBy('id','desc')->get();
                break;

                case '1':
                    $products = Product::with(['cat'])->where('code',$request->input('search'))->orderBy('id','desc')->get();
                break;
            endswitch;

        $data = ['products' => $products];

        return view('admin.products.search', $data);
        
        endif;
    }

    public function getProductDelete($id){
        $p = Product::findOrFail($id);

        if($p->delete()):
            return back()->with('messages', 'Producto enviado a la papelera de reciclaje.')
                    ->with('typealert', 'success');
        endif;
    }

    public function getProductRestore($id){
        $p = Product::onlyTrashed()->where('id',$id)->first();
        if($p->restore()):
            $p->status = "0";
            $p->save();
            return redirect('admin/product/'.$p->id.'/edit')->with('messages', 'Este producto se restauro con éxito!.')
                    ->with('typealert', 'success');
        endif;
    }

    public function getProductInventory($id){
        $product = Product::findOrFail($id);

        $data = [ 
            'product' => $product
        ];

        return view('admin.products.inventory', $data);
    }

    public function postProductInventory($id, Request $request){
        $rules = [
            'name' => 'required',
            'price' => 'required'
        ];

        $messages = [
            'name.required' => 'Se requiere un nombre para el inventario.',
            'price.required' => 'Se require un precio para el inventario.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')
            ->with('typealert', 'danger')->withInput();
        else:
            $inventory = new Inventory;
            $inventory->product_id = $id;
            $inventory->name = e($request->input('name'));
            $inventory->quantity = $request->input('inventory');
            $inventory->price = $request->input('price');
            $inventory->limited = $request->input('limited');
            $inventory->minium = $request->input('minium');

            if($inventory->save()):
                $this->getUpdateMinPrice($inventory->product_id);

                return back()->with('messages', '¡Inventario guardado con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;

    }

    public function getInventoryEdit($id){
        $inventory = Inventory::findOrFail($id);

        $data = [ 
            'inventory' => $inventory
        ];

        return view('admin.products.inventory_edit', $data);
    }

    public function postInventoryEdit($id, Request $request){
        $rules = [
            'name' => 'required',
            'price' => 'required'
        ];

        $messages = [
            'name.required' => 'Se requiere un nombre para el inventario.',
            'price.required' => 'Se require un precio para el inventario.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')
            ->with('typealert', 'danger')->withInput();
        else:
            $inventory = Inventory::find($id);
            $inventory->name = e($request->input('name'));
            $inventory->quantity = $request->input('inventory');
            $inventory->price = $request->input('price');
            $inventory->limited = $request->input('limited');
            $inventory->minium = $request->input('minium');

            if($inventory->save()):
                $this->getUpdateMinPrice($inventory->product_id);

                return back()->with('messages', '¡Inventario actualizado con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;

    }

    public function getInventoryDelete($id){
        $inventory = Inventory::findOrFail($id);

        if($inventory->delete()):
            $this->getUpdateMinPrice($inventory->product_id);

            return back()->with('messages', '¿Inventario eliminado!.')
                    ->with('typealert', 'success');
        endif;
    }

    public function postInventoryVariantAdd($id, Request $request){
        $rules = [
            'name' => 'required',
        ];

        $messages = [
            'name.required' => 'Se requiere un nombre para la variante.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')
            ->with('typealert', 'danger')->withInput();
        else:
            $inventory = Inventory::findOrFail($id);

            $variant = new Variant;
            $variant->product_id = $inventory->product_id;
            $variant->inventory_id = $id;
            $variant->name = e($request->input('name'));

            if($variant->save()):
                
                return back()->with('messages', '¡Variante guardada con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getInventoryVariantDelete($id){
        $variant = Variant::findOrFail($id);

        if($variant->delete()):
            return back()->with('messages', '¡Variante eliminada!.')
                    ->with('typealert', 'success');
        endif;
    }

    public function getUpdateMinPrice($id){
        $product = Product::find($id);
        $price = $product->getPrice->min('price');

        $product->price = $price;
        $product->save();
    }
}
