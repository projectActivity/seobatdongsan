<?php

Route::group(['namespace' => 'Client'], function() {
    Route::get('/', [
        'as' => 'home',
        'uses' => 'HomeController@Index'
    ]);

    //Begin BAIVIET CLIENT
    Route::get('/post/{id?}', [
        'as' => 'baiviet.chitietbaiviet',
        'uses' => 'BaiVietController@index'
    ]);

    #End BAIVIET

    //Begin GioiThieu du an CLIENT
    Route::get('/duan/{id}', [
        'as' => 'duan.chitietduan',
        'uses' => 'DuAnController@Index'
    ]);
    Route::get('/duan', [
        'as' => 'duan.danhsachduan',
        'uses' => 'DuAnController@Home'
    ]);
    #End GioiThieu du an

    // Đăng Email
    Route::post('/dangkyemail', [
        'as' => 'dangkyemail',
        'uses' => 'HomeController@Email'
    ]);
    #End Email
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {

    Route::get('dangnhap', [
        'as' => 'dangnhap',
        'uses' => 'UserController@Login'
    ]);
    Route::post('truycap', [
        'as' => 'truycap',
        'uses' => 'UserController@Sigin'
    ]);
    Route::get('dangxuat', [
        'as' => 'dangxuat',
        'uses' => 'UserController@Logout'
    ]);

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
            Route::get('/', [
                'as' => 'admin.album.index',
                'uses' => 'AlbumController@Index'
            ]);
            Route::get('import', [
                'as' => 'admin.album.import',
                'uses' => 'AlbumController@Import'
            ]);
            Route::post('save', [
                'as' => 'admin.album.save',
                'uses' => 'AlbumController@Save'
            ]);
            Route::get('create', [
                'as' => 'admin.album.create',
                'uses' => 'AlbumController@Create'
            ]);
            Route::post('store', [
                'as' => 'admin.album.store',
                'uses' => 'AlbumController@Store'
            ]);
            Route::get('show/{id}', [
                'as' => 'admin.album.show',
                'uses' => 'AlbumController@Show'
            ]);
            Route::get('reload', [
                'as' => 'admin.album.reload',
                'uses' => 'AlbumController@Reload'
            ]);
            Route::get('edit/{id}', [
                'as' => 'admin.album.edit',
                'uses' => 'AlbumController@Edit'
            ]);
            Route::post('update', [
                'as' => 'admin.album.update',
                'uses' => 'AlbumController@Update'
            ]);
            Route::get('destroy/{id}', [
                'as' => 'admin.album.destroy',
                'uses' => 'AlbumController@Destroy'
            ]);
            // End Album
        });

        Route::group(['prefix' => 'banner'], function() {
            // Begin Banner
            Route::get('/', [
                'as' => 'admin.banner.index',
                'uses' => 'BannerController@Index'
            ]);
            Route::get('create', [
                'as' => 'admin.banner.create',
                'uses' => 'BannerController@Create'
            ]);
            Route::post('store', [
                'as' => 'admin.banner.store',
                'uses' => 'BannerController@Store'
            ]);
            Route::get('show/{id}', [
                'as' => 'admin.banner.show',
                'uses' => 'BannerController@Show'
            ]);
            Route::get('reload', [
                'as' => 'admin.banner.reload',
                'uses' => 'BannerController@Reload'
            ]);
            Route::get('edit/{id}', [
                'as' => 'admin.banner.edit',
                'uses' => 'BannerController@Edit'
            ]);
            Route::post('update', [
                'as' => 'admin.banner.update',
                'uses' => 'BannerController@Update'
            ]);
            Route::get('destroy/{id}', [
                'as' => 'admin.banner.destroy',
                'uses' => 'BannerController@Destroy'
            ]);
            // End Banner
        });

        Route::group(['prefix' => 'blockcontent'], function(){
            // Begin BlockContent
            Route::get('/{idduan}', [
                'as' => 'admin.blockcontent.index',
                'uses' => 'BlockContentController@Index'
            ]);
            Route::get('reload/{id}', [
                'as' => 'admin.blockcontent.reload',
                'uses' => 'BlockContentController@Reload'
            ]);
            Route::get('show/{id}', [
                'as' => 'admin.blockcontent.show',
                'uses' => 'BlockContentController@Show'
            ]);
            Route::get('edit/{id}', [
                'as' => 'admin.blockcontent.edit',
                'uses' => 'BlockContentController@Edit'
            ]);
            Route::post('update', [
                'as' => 'admin.blockcontent.update',
                'uses' => 'BlockContentController@Update'
            ]);
            // End BlockContent
        });

        Route::group(['prefix' => 'hinhanh'], function(){
            // Begin HinhAnh
//            Route::get('/{idblock}', 'HinhAnhController@Index');
            Route::get('create/{idblock}', [ 
                'as' => 'admin.hinhanh.create',
                'uses' => 'HinhAnhController@Create'
            ]);
            Route::post('store', [ 
                'as' => 'admin.hinhanh.store',
                'uses' => 'HinhAnhController@Store'
            ]);
            Route::get('show/{id}', [ 
                'as' => 'admin.hinhanh.show',
                'uses' => 'HinhAnhController@Show'
            ]);
            Route::get('reload/{idblock}', [ 
                'as' => 'admin.hinhanh.reload',
                'uses' => 'HinhAnhController@Reload'
            ]);
            Route::get('edit/{id}', [ 
                'as' => 'admin.hinhanh.edit',
                'uses' => 'HinhAnhController@Edit'
            ]);
            Route::post('update', [ 
                'as' => 'admin.hinhanh.update',
                'uses' => 'HinhAnhController@Update'
            ]);
            Route::get('destroy/{id}', [ 
                'as' => 'admin.hinhanh.destroy',
                'uses' => 'HinhAnhController@Destroy'
            ]);
            // End HinhAnh
        });

        Route::group(['prefix' => 'chude'], function() {
            //Begin CHUDE
            Route::get('/', [
                'as' => 'admin.chude.index',
                'uses' => 'ChuDeController@Index'
            ]);
            Route::get('create', [
                'as' => 'admin.chude.create',
                'uses' => 'ChuDeController@Create'
            ]);
            Route::post('search', [
                'as' => 'admin.chude.search',
                'uses' => 'ChuDeController@Search'
            ]);
            Route::get('reload', [
                'as' => 'admin.chude.reload',
                'uses' => 'ChuDeController@Reload'
            ]);
            Route::post('store', [
                'as' => 'admin.chude.store',
                'uses' => 'ChuDeController@Store'
            ]);
            Route::get('edit/{id}', [
                'as' => 'admin.chude.edit',
                'uses' => 'ChuDeController@Edit'
            ]);
            Route::post('update', [
                'as' => 'admin.chude.update',
                'uses' => 'ChuDeController@Update'
            ]);
            Route::get('destroy/{id}', [
                'as' => 'admin.chude.destroy',
                'uses' => 'ChuDeController@Destroy'
            ]);
            //End CHUDE
        });

        Route::group(['prefix' => 'nguoidung'], function() {
            //Begin USER
            Route::get('/', [ 
                'as' => 'admin.nguoidung.index',
                'uses' => 'UserController@Index'
            ]);
            Route::get('create', [ 
                'as' => 'admin.nguoidung.create',
                'uses' => 'UserController@Create'
            ]);
            Route::post('create', [ 
                'as' => 'admin.nguoidung.store',
                'uses' => 'UserController@SaveCreate'
            ]);
            Route::post('checkexist', [ 
                'as' => 'admin.nguoidung.checkexist',
                'uses' => 'UserController@CheckExist'
            ]);
            Route::post('reload', [ 
                'as' => 'admin.nguoidung.reload',
                'uses' => 'UserController@Reload'
            ]);
            Route::get('edit/{id}', [ 
                'as' => 'admin.nguoidung.edit',
                'uses' => 'UserController@Edit'
            ]);
            Route::post('edit', [ 
                'as' => 'admin.nguoidung.update',
                'uses' => 'UserController@SaveEdit'
            ]);
            Route::get('delete/{id}', [ 
                'as' => 'admin.nguoidung.delete',
                'uses' => 'UserController@Delete'
            ]);
            Route::post('delete', [ 
                'as' => 'admin.nguoidung.destroy',
                'uses' => 'UserController@Remove'
            ]);
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
