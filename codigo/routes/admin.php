<?php

    Route::prefix('/admin')->group(function(){

        //Dashboard
        Route::get('/','Admin\DashboardController@getDashboard')->name('dashboard');

        //Categories
        Route::get('/categories/{module}', 'Admin\CategoriesController@getHome')->name('categories'); 
        Route::post('/category/add/{module}', 'Admin\CategoriesController@postCategoryAdd')->name('category_add');
        Route::get('/category/{id}/edit', 'Admin\CategoriesController@getCategoryEdit')->name('category_edit');
        Route::post('/category/{id}/edit', 'Admin\CategoriesController@postCategoryEdit')->name('category_edit');
        Route::get('/category/{id}/subs', 'Admin\CategoriesController@getSubCategories')->name('category_edit');
        Route::get('/category/{id}/delete', 'Admin\CategoriesController@getCategoryDelete')->name('category_delete');

        //Request Ajax
        Route::get('/md/api/load/subcategories/{parent}', 'Admin\ApiController@getSubCategories');

        //Products        
        Route::get('/products/add', 'Admin\ProductController@getProductAdd')->name('product_add');
        Route::post('/products/add', 'Admin\ProductController@postProductAdd')->name('product_add');
        Route::get('/products/{status}', 'Admin\ProductController@getProducts')->name('products');
        Route::post('/product/search', 'Admin\ProductController@postProductSearch')->name('product_search');
        Route::get('/product/{id}/edit', 'Admin\ProductController@getProductEdit')->name('product_edit');
        Route::post('/product/{id}/edit', 'Admin\ProductController@postProductEdit')->name('product_edit');
        Route::get('/product/{id}/delete', 'Admin\ProductController@getProductDelete')->name('product_delete');
        Route::get('/product/{id}/restore', 'Admin\ProductController@getProductRestore')->name('product_delete');
        Route::get('/product/{id}/inventory', 'Admin\ProductController@getProductInventory')->name('product_inventory');        
        Route::post('/product/{id}/inventory', 'Admin\ProductController@postProductInventory')->name('product_inventory');
        Route::post('/product/{id}/gallery/add', 'Admin\ProductController@postProductGalleryAdd')->name('product_gallery_add');
        Route::get('/product/{id}/gallery/{gid}/delete', 'Admin\ProductController@getProductGalleryDelete')->name('product_gallery_delete');

        //Inventory Product
        Route::get('/product/inventory/{id}/edit', 'Admin\ProductController@getInventoryEdit')->name('product_inventory');
        Route::post('/product/inventory/{id}/edit', 'Admin\ProductController@postInventoryEdit')->name('product_inventory');
        Route::post('/product/inventory/{id}/variant', 'Admin\ProductController@postInventoryVariantAdd')->name('product_inventory');
        Route::get('/product/inventory/{id}/delete', 'Admin\ProductController@getInventoryDelete')->name('product_inventory');
        Route::get('/product/variant/{id}/delete', 'Admin\ProductController@getInventoryVariantDelete')->name('product_inventory');

        //Users
        Route::get('/users/{status}', 'Admin\UserController@getUsers')->name('user_list');
        Route::get('/user/{id}/view', 'Admin\UserController@getUserView')->name('user_view');
        Route::post('/user/{id}/edit', 'Admin\UserController@postUserEdit')->name('user_edit');
        Route::get('/user/{id}/banned', 'Admin\UserController@getUserBanned')->name('user_banned');
        Route::get('/user/{id}/permissions', 'Admin\UserController@getUserPermissions')->name('user_permissions');
        Route::post('/user/{id}/permissions', 'Admin\UserController@postUserPermissions')->name('user_permissions');

        //Coverage
        Route::get('/coverage','Admin\CoverageController@getList')->name('coverage_list');
        Route::post('/coverage/state/add','Admin\CoverageController@postCoverageStateAdd')->name('coverage_add');
        Route::post('/coverage/city/add','Admin\CoverageController@postCoverageCityAdd')->name('coverage_add');
        Route::get('/coverage/state/{id}/edit','Admin\CoverageController@getCoverageStateEdit')->name('coverage_edit');
        Route::post('/coverage/state/{id}/edit','Admin\CoverageController@postCoverageStateEdit')->name('coverage_edit');
        Route::get('/coverage/city/{id}/edit','Admin\CoverageController@getCoverageCityEdit')->name('coverage_edit');
        Route::post('/coverage/city/{id}/edit','Admin\CoverageController@postCoverageCityEdit')->name('coverage_edit');
        Route::get('/coverage/{id}/cities','Admin\CoverageController@getCoverageCities')->name('coverage_edit');
        Route::get('/coverage/{id}/delete','Admin\CoverageController@getCoverageDelete')->name('coverage_delete');

        //Sliders
        Route::get('/sliders','Admin\SliderController@getHome')->name('sliders_list');
        Route::post('/slider/add','Admin\SliderController@postSliderAdd')->name('sliders_add');
        Route::get('/slider/{id}/edit','Admin\SliderController@getSliderEdit')->name('sliders_edit');
        Route::post('/slider/{id}/edit','Admin\SliderController@postSliderEdit')->name('sliders_edit');
        Route::get('/slider/{id}/delete','Admin\SliderController@getSliderDelete')->name('sliders_delete');

        //Settings
        Route::get('/settings','Admin\SettingsController@getHome')->name('settings');
        Route::post('/settings','Admin\SettingsController@postHome')->name('settings'); 

        //Orders
        Route::get('/orders/{status}/{type}', 'Admin\OrderController@getList')->name('orders_list');
        Route::get('/order/{order}/view', 'Admin\OrderController@getOrder')->name('order_view');
        Route::post('/order/{order}/view', 'Admin\OrderController@postOrderStatusUpdate')->name('order_view');

        
    });