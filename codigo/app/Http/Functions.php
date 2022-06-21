<?php
    function getModulesArray(){
        $a = [
            '0' => 'Productos',
            '1' => 'Usuarios'
        ];

        return $a;
    }

    function getRoleUserArray($mode, $id){
        $roles = [
            '0' => 'Usuario',
            '1' => 'Administrador'
        ];

        if(!is_null($mode)):
            return $roles;
        else:
            return $roles[$id];
        endif;
    }

    function getUserStatusArray($mode, $id){
        $status = [
            '0' => 'Registrado',
            '1' => 'Verificado',
            '100' => 'Baneado'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    //Key Value From JSON
    function kvfj($json, $key){
        if($json == null):
            return null;
        else:
            $json = $json;
            $json = json_decode($json, true);

            if(array_key_exists($key, $json)):
                return $json[$key];
            else:
                return null;
            endif;
        endif;
    }

    function user_permissions(){
        $p = [
            'home' => [
                'icon' => '<i class="fas fa-house-user"></i> ',
                'title' => 'Modulo de Inicio',
                'keys' => [
                    'home' => 'Puede ver y regresar al apartado publico ó home.'
                ]
            ],
            'dashboard' => [
                'icon' => '<i class="fas fa-tachometer-alt"></i>',
                'title' => 'Modulo Dashboard',
                'keys' => [
                    'dashboard' => 'Puede ver el dashboard.',
                    'dashboard_small_stats' => 'Puede ver las estadísticas rápidas.',
                    'dashboard_sell_today' => 'Puede ver lo facturado hoy.'
                ]
            ],
            'categories' => [
                'icon' => '<i class="fas fa-tags"></i>',
                'title' => 'Modulo Categorias',
                'keys' => [
                    'categories' => 'Puede ver el listado de categorias.',
                    'category_add' => 'Puede agregar nuevas categorias.',
                    'category_edit' => 'Puede editar categorias.',
                    'category_delete' => 'Puede eliminar categorias.'
                ]
            ],
            'products' => [
                'icon' => '<i class="fas fa-boxes"></i> ',
                'title' => 'Modulo Productos',
                'keys' => [
                    'products' => 'Puede ver el listado de productos.',
                    'product_add' => 'Puede agregar nuevos productos.',
                    'product_edit' => 'Puede editar productos.',
                    'product_delete' => 'Puede eliminar productos.',
                    'product_search' => 'Puede buscar productos.',
                    'product_gallery_add' => 'Puede agregar imágenes a la galería.',
                    'product_gallery_delete' => 'Puede eliminar imágenes de la galería.',
                    'product_inventory' => 'Puede administrar el inventario de los productos.'
                ]
            ],
            'users' => [
                'icon' => '<i class="fas fa-user-lock"></i> ',
                'title' => 'Modulo Usuarios',
                'keys' => [
                    'user_list' => 'Puede ver el listado de usuarios.',
                    'user_view' => 'Puede ver el perfil del usuario.',
                    'user_edit' => 'Puede editar usuarios.',
                    'user_banned' => 'Puede banear usuarios.',
                    'user_permissions' => 'Puede administrar permisos de usuarios.'
                ]
            ],
            'sliders' => [
                'icon' => '<i class="fas fa-images"></i> ',
                'title' => 'Modulo de Sliders',
                'keys' => [
                    'sliders_list' => 'Puede ver la lista de Sliders.',
                    'sliders_add' => 'Puede agregar nuevos Sliders.',
                    'sliders_edit' => 'Puede editar sliders.',
                    'sliders_delete' => 'Puede eliminar sliders.'
                ]
            ],
            'settings' => [
                'icon' => '<i class="fas fa-cogs"></i> ',
                'title' => 'Modulo de Configuraciones',
                'keys' => [
                    'settings' => 'Puede modicar la configuración.'
                ]
            ],
            'orders' => [
                'icon' => '<i class="fas fa-clipboard-list"></i> ',
                'title' => 'Modulo de Ordenes',
                'keys' => [
                    'orders_list' => 'Puede ver el listado de ordenes.',
                    'order_view'  => 'Puede ver el detalle de una orden .',
                    'order_change_status'  => 'Puede cambiar el estado de una orden.'
                ]
            ],
            'coverage' => [
                'icon' => '<i class="fas fa-shipping-fastt"></i> ',
                'title' => 'Cobertura de envios',
                'keys' => [
                    'coverage_list' => 'Puede ver la lista de cobertura de envios.',
                    'coverage_add' => 'Puede agregar departamentos para envios.',
                    'coverage_edit' => 'Puede editar departamentos para envios.',
                    'coverage_delete' => 'Puede eliminar departamentos para envios.'
                ]
            ]

        ];

        return $p;
    }

    function getUserYears(){
        $ya = date('Y');
        $ym = $ya - 18;
        $yo = $ym - 62;

        return [$ym, $yo];
    }

    function getMonths($mode, $key){
        $m = [
            '01' => 'Enero',
            '02' => 'Febrero',
            '03' => 'Marzo',
            '04' => 'Abril',
            '05' => 'Mayo',
            '06' => 'Junio',
            '07' => 'Julio',
            '08' => 'Agosto',
            '09' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre'
        ];

        if($mode == "list"){
            return $m;
        }else{
            return $m[$key];
        }
    }

    function getShippingMethod($method = null){
        $status = [
            '0' => 'Gratis',
            '1' => 'Perimetro de San Marcos y San Pedro',
            '2' => 'A otros departamentos',
            '3' => 'Envió gratis por monto mínimo'
        ];

        if(is_null($method)):
            return $status;
        else:
            return $status[$method];
        endif;
    }

    function getCoverageType($type = null){
        $status = [
            '0' => 'Departamento',
            '1' => 'Municipio'
        ];

        if(is_null($type)):
            return $status;
        else:
            return $status[$type];
        endif;
    }

    function getCoverageStatus($status = null){
        $list = [
            '0' => 'Inactiva',
            '1' => 'Activa'
        ];

        if(is_null($status)):
            return $list;
        else:
            return $list[$status];
        endif;
    }

    function getEnableorNot($status = null){
        $list = [
            '0' => 'Inactivo',
            '1' => 'Activo'
        ];

        if(is_null($status)):
            return $list;
        else:
            return $list[$status];
        endif;
    }

    function getPaymentsMethods($method = null){
        $list = [
            '0' => 'Pago en Efectivo',
            '1' => 'Transferencia ó Deposito',
            '2' => 'Paypal',
            '3' => 'Tarjeta de Crédito / Debito'
        ];

        if(is_null($method)):
            return $list;
        else:
            return $list[$method];
        endif;
    }

    function getOrderStatus($method = null){
        $list = [
            '0' => 'En Proceso',
            '1' => 'Pago Pendiente de Confirmación',
            '2' => 'Pago Recibido',
            '3' => 'Procesando Orden',
            '4' => 'Orden Enviada',
            '5' => 'Lista Para Recoger',
            '6' => 'Orden Entregada',
            '100' => 'Orden Rechazada'
        ];

        if(is_null($method)):
            return $list;
        else:
            return $list[$method];
        endif;
    }

    function getOrderType($method = null){
        $list = [
            '0' => 'Entrega a Domicilio',
            '1' => 'Pasa a Recoger'
        ];

        if(is_null($method)):
            return $list;
        else:
            return $list[$method];
        endif;
    }

    function number($number){
        return config('cms.currency').' '.number_format($number, 2, '.', ',' );
    }

    function getUrlFileFromUploads($file, $size = null){
        if(!is_null($file)):
            $file = json_decode($file, true);
            if($size):
                return url('/uploads/'.$file['path'].'/'.$size.'_'.$file['final_name']);
            else:
                return url('/uploads/'.$file['path'].'/'.$file['final_name']);
            endif;
        endif;        
    }
?>