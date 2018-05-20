<?php

Route::group(['namespace' => 'Client'], function() {
    Route::get('/', 'HomeController@Index');

    //Begin BAIVIET CLIENT
    Route::get('/post/{id}', 'BaiVietController@index');

    #End BAIVIET

    //Begin GioiThieu du an CLIENT
    Route::get('/duan/{id}', 'DuAnController@Index');
    Route::get('/duan', 'DuAnController@Home');
    #End GioiThieu du an

    // Đăng Email
    Route::post('/dangkyemail', 'HomeController@Email');
    #End Email
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {

    Route::get('dangnhap', 'UserController@Login');
    Route::post('truycap', 'UserController@Sigin');
    Route::get('dangxuat', 'UserController@Logout');

    Route::group(['middleware' => 'adminLogin'], function() {
        Route::get('/', 'AdminController@Index');

        Route::group(['prefix' => 'baiviet'], function() {
            // Begin BaiViet
            Route::get('create/{id}', 'PostController@Create');
            Route::get('{idchude}', 'PostController@Index');
            Route::get('reload/{id}', 'PostController@Reload');
            Route::post('store', 'PostController@Store');
            Route::get('edit/{id}', 'PostController@Edit');
            Route::post('update', 'PostController@Update');
            Route::get('delete/{id}', 'PostController@Delete');
            Route::get('destroy/{id}', 'PostController@Destroy');
            // End BaiViet
        });

        Route::group(['prefix' => 'album'], function() {
            // Begin Album
            Route::get('/', 'AlbumController@Index');
            Route::get('import', 'AlbumController@Import');
            Route::post('save', 'AlbumController@Save');
            Route::get('create', 'AlbumController@Create');
            Route::post('store', 'AlbumController@Store');
            Route::get('show/{id}', 'AlbumController@Show');
            Route::get('reload', 'AlbumController@Reload');
            Route::get('edit/{id}', 'AlbumController@Edit');
            Route::post('update', 'AlbumController@Update');
            Route::get('destroy/{id}', 'AlbumController@Destroy');
            // End Album
        });

        Route::group(['prefix' => 'banner'], function() {
            // Begin Banner
            Route::get('/', 'BannerController@Index');
            Route::get('create', 'BannerController@Create');
            Route::post('store', 'BannerController@Store');
            Route::get('show/{id}', 'BannerController@Show');
            Route::get('reload', 'BannerController@Reload');
            Route::get('edit/{id}', 'BannerController@Edit');
            Route::post('update', 'BannerController@Update');
            Route::get('destroy/{id}', 'BannerController@Destroy');
            // End Banner
        });

        Route::group(['prefix' => 'blockcontent'], function(){
            // Begin BlockContent
            Route::get('/{idduan}', 'BlockContentController@Index');
            Route::get('reload/{id}', 'BlockContentController@Reload');
            Route::get('show/{id}', 'BlockContentController@Show');
            Route::get('edit/{id}', 'BlockContentController@Edit');
            Route::post('update', 'BlockContentController@Update');
            // End BlockContent
        });

        Route::group(['prefix' => 'hinhanh'], function(){
            // Begin HinhAnh
//            Route::get('/{idblock}', 'HinhAnhController@Index');
            Route::get('create/{idblock}', 'HinhAnhController@Create');
            Route::post('store', 'HinhAnhController@Store');
            Route::get('show/{id}', 'HinhAnhController@Show');
            Route::get('reload/{idblock}', 'HinhAnhController@Reload');
            Route::get('edit/{id}', 'HinhAnhController@Edit');
            Route::post('update', 'HinhAnhController@Update');
            Route::get('destroy/{id}', 'HinhAnhController@Destroy');
            // End HinhAnh
        });

        Route::group(['prefix' => 'chude'], function() {
            //Begin CHUDE
            Route::get('/', 'ChuDeController@Index');
            Route::get('create', 'ChuDeController@Create');
            Route::post('search', 'ChuDeController@Search');
            Route::get('reload', 'ChuDeController@Reload');
            Route::post('store', 'ChuDeController@Store');
            Route::get('edit/{id}', 'ChuDeController@Edit');
            Route::post('update', 'ChuDeController@Update');
            Route::get('destroy/{id}', 'ChuDeController@Destroy');
            //End CHUDE
        });

        Route::group(['prefix' => 'nguoidung'], function() {
            //Begin USER
            Route::get('/', 'UserController@Index');
            Route::get('create', 'UserController@Create');
            Route::post('create', 'UserController@SaveCreate');
            Route::post('checkexist', 'UserController@CheckExist');
            Route::post('reload', 'UserController@Reload');
            Route::get('edit/{id}', 'UserController@Edit');
            Route::post('edit', 'UserController@SaveEdit');
            Route::get('delete/{id}', 'UserController@Delete');
            Route::post('delete', 'UserController@Remove');
            //End USER
        });

        Route::group(['prefix' => 'slide'], function(){
            // Begin Slide
            Route::get('/', 'SlideController@Index');
            Route::get('create', 'SlideController@Create');
            Route::post('store', 'SlideController@Store');
            Route::get('show/{id}', 'SlideController@Show');
            Route::get('reload', 'SlideController@Reload');
            Route::get('edit/{id}', 'SlideController@Edit');
            Route::post('update', 'SlideController@Update');
            Route::get('destroy/{id}', 'SlideController@Destroy');
            // End Slide
        });

        Route::group(['prefix' => 'tailieu'], function() {
            // Begin TaiLieu
            Route::post('store', 'TaiLieuController@Store');
            Route::get('{idduan}', 'TaiLieuController@Index');
            Route::get('create/{idduan}', 'TaiLieuController@Create');
            Route::get('show/{id}', 'TaiLieuController@Show');
            Route::get('reload/{id}', 'TaiLieuController@Reload');
            Route::get('edit/{id}', 'TaiLieuController@Edit');
            Route::post('update', 'TaiLieuController@Update');
            Route::get('destroy/{id}', 'TaiLieuController@Destroy');
            // End TaiLieu
        });

        Route::group(['prefix' => 'lienhe'], function () {
            // Begin LienHe
            Route::get('/', 'LienHeController@Index');
            Route::get('reload', 'LienHeController@Reload');
            Route::get('destroy/{id}', 'LienHeController@Destroy');
            // End LienHe
        });

        Route::group(['prefix' => 'ghim'], function() {
           // Begin Ghim
            Route::get('/', 'GhimController@Index');
            Route::get('create', 'GhimController@Create');
            Route::post('search', 'GhimController@Search');
            Route::get('reload', 'GhimController@Reload');
            Route::post('store', 'GhimController@Store');
            Route::get('edit/{id}', 'GhimController@Edit');
            Route::post('update', 'GhimController@Update');
            Route::get('destroy/{id}', 'GhimController@Destroy');
            // End Ghim
        });
    });
});
