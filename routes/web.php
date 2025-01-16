<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ComponentAdminController;
use App\Http\Controllers\ConfigurationsController;
use App\Http\Controllers\EmpController;
use App\Http\Controllers\OrderAdminController;
use App\Http\Controllers\PackageAdminController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TelegramBotController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*Telegram Bot*/

Route::get('/updated-activity', [TelegramBotController::class, 'updatedActivity'])->name('updatedActivity'); /*Проверка состояния*/
Route::get('/send-message', [TelegramBotController::class, 'storeMessage'])->name('storeMessage');

/**/

Route::get('/', [TaskController::class,'index'])->name('index');
Route::get('/info', [TaskController::class,'info'])->name('indexInfo');
Route::get('/projects', [TaskController::class, 'project'])->name('indexProject');
Route::get('/configurator', [ConfigurationsController::class, 'index'])->name('configurator');
Route::get('/configurator/computers_assemblies/{id}', [ConfigurationsController::class, 'computers_assemblies'])->name('computers_assemblies');
Route::get('/configurator/configurator_page/{id}/{model_name}/{complectation}/', [ConfigurationsController::class, 'configurator_page'])->name('configurator_page');
/*Подгружаемые страницы через AJAX конфигуратор*/
Route::post('/configurator/configurator_page/conf_motherboard/{model_name}', [ConfigurationsController::class, 'selectMotherboard'])->name('selectMotherboard');
Route::post('/configurator/configurator_page/conf_cpu/{model_name}', [ConfigurationsController::class, 'selectCpu'])->name('selectCpu');

Route::resource('/configurations', ConfigurationsController::class);
/*Авторизация/Регистрация/Выход с аккаунта*/
Route::get('/create', [UserController::class, 'create'])->name('create');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/store', [UserController::class,'store'])->name('store');
Route::post('/signup', [UserController::class, 'signup'])->name('signup');
/*Личный кабинет*/
Route::get('/account', [TaskController::class, 'account'])->name('account');
Route::get('/check-order/{order_id}', [TaskController::class, 'checkOrder'])->name('checkOrder'); //Страница чека
Route::get('/download/{order_id}', [EmpController::class, 'downloadPDF'])->name('downloadPDF'); //Загрузка чека
/*Подгружаемые страницы через AJAX ЛК*/
Route::post('/change-photo', [TaskController::class, 'changePhoto'])->name('changePhoto');
Route::post('/change-photo-user/{user}', [TaskController::class, 'userPhotoChange'])->name('userPhotoChange');
Route::post('/change-password', [TaskController::class, 'changePassword'])->name('changePassword');
Route::post('/change-password-user/{user}', [TaskController::class, 'userPasswordChange'])->name('userPasswordChange');
Route::post('/show-orders', [TaskController::class, 'ShowOrder'])->name('ShowOrder');

/*Корзина*/
Route::get('/cart', [TaskController::class, 'cart'])->name('cart');
/*Подгружаемые страницы через AJAX корзина*/
Route::post('/add-to-cart', [TaskController::class, 'addToCart'])->name('addToCart');
Route::post('/detele-to-cart', [TaskController::class, 'DeleteCart'])->name('DeleteCart');
Route::post('/update-to-cart', [TaskController::class, 'UpdateCart'])->name('UpdateCart');
Route::post('/make-orders', [TaskController::class, 'MakeOrder'])->name('MakeOrder');
Route::post('/form-card', [TaskController::class, 'CardForm'])->name('CardForm');

/*Админ-панель*/
Route::prefix('admin')->group(function () {
    /* Главная страница */
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    /* заказы */
    Route::prefix('orders')->group(function () {
        Route::get('/', [AdminController::class, 'ModerateOrder'])->name('admin.order.index');
        /* Функции с заказами */
        Route::patch('/update-status/{id}', [OrderAdminController::class, 'Update'])->name('admin.order.update'); /*Изменение статуса*/
        Route::patch('/update/{id}', [OrderAdminController::class, 'CancelUpdate'])->name('admin.order.Cancelupdate'); /*Отмена заказа*/
    });
    /* комплектующие */
    Route::prefix('components')->group(function () {
        Route::get('/', [AdminController::class, 'ModerateComponent'])->name('admin.component.index');
        Route::get('/{id}', [ComponentAdminController::class, 'show'])->name('admin.component.show');
        /*Процессоры*/
        Route::prefix('cpu')->group(function () {
            Route::get('/{id}', [ComponentAdminController::class, 'ShowCpu'])->name('admin.cpu.show');
            Route::post('/store', [ComponentAdminController::class, 'StoreCpu'])->name('admin.components.cpu.store');
            Route::patch('/update/{id}', [ComponentAdminController::class, 'UpdateCpu'])->name('admin.components.cpu.update');
        });

        /*Материнские платы*/
        Route::prefix('motherboard')->group(function () {
            Route::get('/{id}', [ComponentAdminController::class, 'ShowMotherboard'])->name('admin.motherboard.show');
            Route::post('/store', [ComponentAdminController::class, 'StoreMotherboard'])->name('admin.components.motherboard.store');
            Route::patch('/update/{id}', [ComponentAdminController::class, 'UpdateMotherboard'])->name('admin.components.motherboard.update');
        });

        /*ОЗУ*/
        Route::prefix('ram')->group(function () {
            Route::get('/{id}', [ComponentAdminController::class, 'ShowRam'])->name('admin.ram.show');
            Route::post('/store', [ComponentAdminController::class, 'StoreRam'])->name('admin.components.ram.store');
            Route::patch('/update/{id}', [ComponentAdminController::class, 'UpdateRam'])->name('admin.components.ram.update');
        });

        /*Видеокарта*/
        Route::prefix('gpu')->group(function () {
            Route::get('/{id}', [ComponentAdminController::class, 'ShowGpu'])->name('admin.gpu.show');
            Route::post('/store', [ComponentAdminController::class, 'StoreGpu'])->name('admin.components.gpu.store');
            Route::patch('/update/{id}', [ComponentAdminController::class, 'UpdateGpu'])->name('admin.components.gpu.update');
        });

        /*Блок питания*/
        Route::prefix('psu')->group(function () {
            Route::get('/{id}', [ComponentAdminController::class, 'ShowPsu'])->name('admin.psu.show');
            Route::post('/store', [ComponentAdminController::class, 'StorePsu'])->name('admin.components.psu.store');
            Route::patch('/update/{id}', [ComponentAdminController::class, 'UpdatePsu'])->name('admin.components.psu.update');
        });

        /*Диски*/
        Route::prefix('disk')->group(function () {
            Route::get('/hdd/{id}', [ComponentAdminController::class, 'ShowHdd'])->name('admin.hdd.show');
            Route::post('/store/hdd', [ComponentAdminController::class, 'StoreHdd'])->name('admin.components.hdd.store');
            Route::get('/ssd/{id}', [ComponentAdminController::class, 'ShowSsd'])->name('admin.ssd.show');
            Route::post('/store/ssd', [ComponentAdminController::class, 'StoreSsd'])->name('admin.components.ssd.store');
            Route::patch('/update/hdd/{id}', [ComponentAdminController::class, 'UpdateHDD'])->name('admin.components.hdd.update');
            Route::patch('/update/ssd/{id}', [ComponentAdminController::class, 'UpdateSSD'])->name('admin.components.ssd.update');
        });

        /*Охлаждение*/
        Route::prefix('cooling')->group(function () {
            Route::get('/{id}', [ComponentAdminController::class, 'ShowCooling'])->name('admin.cooling.show');
            Route::post('/store', [ComponentAdminController::class, 'StoreCooling'])->name('admin.components.cooling.store');
            Route::patch('/update/{id}', [ComponentAdminController::class, 'UpdateCooling'])->name('admin.components.cooling.update');
        });

        /*Корпус*/
        Route::prefix('case')->group(function () {
            Route::get('/{id}', [ComponentAdminController::class, 'ShowCase'])->name('admin.case.show');
            Route::post('/store', [ComponentAdminController::class, 'StoreCase'])->name('admin.components.case.store');
            Route::patch('/update/{id}', [ComponentAdminController::class, 'UpdateCase'])->name('admin.components.case.update');
        });
    });
    /* сборки */
    Route::prefix('packages')->group(function () {
        Route::get('/', [AdminController::class, 'ModeratePackage'])->name('admin.package.index');
        Route::post('/store', [PackageAdminController::class, 'PackagePositionStore'])->name('admin.package.model.component.store');
        Route::post('/component_package_store', [PackageAdminController::class, 'ComponentPackageStore'])->name('admin.package.model.component_package_store');
        Route::post('/create', [PackageAdminController::class, 'CreateModel'])->name('admin.package.model.create');
        Route::patch('/update/{id}', [PackageAdminController::class, 'UpdateModel'])->name('admin.package.model.update');
    });
    /* пользователи */
    Route::prefix('users')->group(function () {
        Route::get('/', [AdminController::class, 'ModerateUser'])->name('admin.user.index');
        Route::patch('/update/{id}', [UserAdminController::class, 'Update'])->name('admin.user.update'); /*Изменение статуса*/
    });


//    /* Функции с категориями */
//    Route::get('/category', [AdminController::class, 'CategoryIndex'])->name('admin.category.index');
//    Route::post('/category/store', [AdminController::class, 'CategoryAdd'])->name('admin.category.store');
//    Route::patch('/category/update/{id}', [AdminController::class, 'CategoryUpdate'])->name('admin.category.update');
//    Route::delete('/category/delete/{id}', [AdminController::class, 'CategoryDelete'])->name('admin.category.delete');
//    /* Функции с продуктами */
//    Route::get('/product', [AdminController::class, 'ProductIndex'])->name('admin.product.index');
//    Route::post('/product/store', [AdminController::class, 'ProductAdd'])->name('admin.product.store');
//    Route::patch('/product/update/{id}', [AdminController::class, 'ProductUpdate'])->name('admin.product.update');
//    Route::delete('/product/delete/{id}', [AdminController::class, 'index'])->name('admin.product.delete');
});
