<div class="sidebar shadow">
    <div class="section-top">
        <div class="logo">
            <img src="{{url('static/imagenes/Blanco-Pantalla.png')}}" class="img-fluid">
        </div>

        <div class="user">
            <span class="subtitle">Hola</span>
            <div class="name">
                {{ Auth::user()->name }} {{ Auth::user()->lastname }}
                <a href="{{url('/logout')}}" data-toogle="tooltrip" data-placement="top" title="Salir">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
            <div class="email">
                {{ Auth::user()->email }}
            </div>
        </div>
    </div>

    <div class="main">
        <ul>
            @if(kvfj(Auth::user()->permissions, 'home'))
                <li>
                    <a href="{{ url('/') }}" class="lk-home"><i class="fas fa-house-user"></i> Inicio</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'dashboard'))
                <li>
                    <a href="{{ url('/admin') }}" class="lk-dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'categories'))
                <li>
                    <a href="{{ url('/admin/categories/0') }}" class="lk-categories lk-category_add lk-category_edit lk-category_delete"><i class="fas fa-tags"></i> Categorías</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'products'))
                <li>
                    <a href="{{ url('/admin/products/1') }}" class="lk-products lk-product_add lk-product_search lk-product_edit lk-product_gallery_add lk-product_inventory"><i class="fas fa-boxes"></i> Productos</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'orders_list'))
                <li>
                    <a href="{{ url('/admin/orders/all/all') }}" class="lk-orders_list lk-order_view"><i class="fas fa-clipboard-list"></i> Ordenes</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'user_list'))
                <li>
                    <a href="{{ url('/admin/users/all') }}" class="lk-user_list lk-user_view lk-user_permissions"><i class="fas fa-user-lock"></i> Usuarios</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'coverage_list'))
                <li>
                    <a href="{{ url('/admin/coverage') }}" class="lk-coverage_list lk-coverage_edit"><i class="fas fa-shipping-fast"></i> Cobertura de envios</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'sliders_list'))
                <li>
                    <a href="{{ url('/admin/sliders') }}" class="lk-sliders_list lk-sliders_edit"><i class="fas fa-images"></i> Sliders</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'settings'))
                <li>
                    <a href="{{ url('/admin/settings') }}" class="lk-settings"><i class="fas fa-cogs"></i> Configuraciones</a>
                </li>
            @endif
        </ul>
    </div>

</div>