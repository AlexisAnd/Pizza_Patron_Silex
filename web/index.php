<?php


include __DIR__.'/../vendor/autoload.php';
use Silex\Application;

// Instance de la classe Application (qui se trouve dans le namespace Silex)
$app = new Application();

$app['debug'] = true;

$app->register
(
    new Silex\Provider\TwigServiceProvider(),
    [
        'twig.path' => __DIR__.'/View'
    ]
);
$app->register(new Silex\Provider\SessionServiceProvider());

$app->register(new Silex\Provider\AssetServiceProvider(), array(
    'assets.version' => 'v1',
    'assets.version_format' => '%s?version=%s',
    'assets.named_packages' => array(
        'css' => array('base_path' => '/css'),
        'font' => array('base_path' => '/font'),
        'vendor' => array('base_path' => '/vendor'),
        'js' => array('base_path' => '/js'),
        'images' => array('base_path' => '/images')
    ),
));

$app->get('/','MonProjet\Controller\MenuController::showMenuDetails')
    ->bind('menu');

$app->get('/order','MonProjet\Controller\OrderController::orderGet')
    ->bind('order');

$app->post('/order','MonProjet\Controller\OrderController::order');

$app->get('/cart','MonProjet\Controller\OrderController::cartTotal')
    ->bind('cart');

$app->post('/menu','MonProjet\Controller\DeleteController::deleteLine')
    ->bind('delete');

$app->get('/payment','MonProjet\Controller\PaymentController::paymentPage')
    ->bind('payment');

$app->get('/validation','MonProjet\Controller\ValidationController::validationPage')
    ->bind('validation');

$app->get('/register','MonProjet\Controller\RegisterController::registerUser')
->bind('register');

$app->post('/register','MonProjet\Controller\RegisterController::userRegistered');

$app->get('/login','MonProjet\Controller\LoginController::loginpage')
->bind('login');

$app->post('/login','MonProjet\Controller\LoginController::loginUser');

$app->get('/logout','MonProjet\Controller\LogoutController::logOut')
    ->bind('logout');

$app->get('/admin','MonProjet\Controller\Admin\AdminAdd\AdminController::adminPage')
    ->bind('admin');

$app->post('/admin','MonProjet\Controller\Admin\AdminAdd\AdminController::addProduct');

$app->get('/adminpaninis','MonProjet\Controller\Admin\AdminAdd\AdminPaninisController::adminPaninisPage')
    ->bind('adminpaninis');

$app->post('/adminpaninis','MonProjet\Controller\Admin\AdminAdd\AdminPaninisController::addProduct');

$app->get('/adminsides','MonProjet\Controller\Admin\AdminAdd\AdminSidesController::adminSidesPage')
    ->bind('adminsides');

$app->post('/adminsides','MonProjet\Controller\Admin\AdminAdd\AdminSidesController::addProduct');

$app->get('/admindesserts','MonProjet\Controller\Admin\AdminAdd\AdminDessertsController::adminDessertsPage')
    ->bind('admindesserts');

$app->post('/admindesserts','MonProjet\Controller\Admin\AdminAdd\AdminDessertsController::addProduct');

$app->get('/admindrinks','MonProjet\Controller\Admin\AdminAdd\AdminDrinksController::adminDrinksPage')
    ->bind('admindrinks');

$app->post('/admindrinks','MonProjet\Controller\Admin\AdminAdd\AdminDrinksController::addProduct');

$app->get('/admindelete','MonProjet\Controller\Admin\AdminDelete\AdminDeleteController::adminDeletePage')
   ->bind('admindelete');

$app->post('/admindelete','MonProjet\Controller\Admin\AdminDelete\AdminDeleteController::deleteProduct');

$app->get('/admindeletepaninis','MonProjet\Controller\Admin\AdminDelete\AdminDeletePaninisController::adminDeletePaninisPage')
    ->bind('admindeletepaninis');

$app->post('/admindeletepaninis','MonProjet\Controller\Admin\AdminDelete\AdminDeletePaninisController::deleteProduct');

$app->get('/admindeletesides','MonProjet\Controller\Admin\AdminDelete\AdminDeleteSidesController::adminDeleteSidesPage')
    ->bind('admindeletesides');

$app->post('/admindeletesides','MonProjet\Controller\Admin\AdminDelete\AdminDeleteSidesController::deleteProduct');

$app->get('/admindeletedesserts','MonProjet\Controller\Admin\AdminDelete\AdminDeleteDessertsController::adminDeleteDessertsPage')
    ->bind('admindeletedesserts');

$app->post('/admindeletedesserts','MonProjet\Controller\Admin\AdminDelete\AdminDeleteDessertsController::deleteProduct');

$app->get('/admindeletedrinks','MonProjet\Controller\Admin\AdminDelete\AdminDeleteDrinksController::adminDeleteDrinksPage')
    ->bind('admindeletedrinks');

$app->post('/admindeletedrinks','MonProjet\Controller\Admin\AdminDelete\AdminDeleteDrinksController::deleteProduct');

$app->get('/adminmodify','MonProjet\Controller\Admin\AdminModify\AdminModifyController::adminModifyPage')
    ->bind('adminmodify');

$app->get('/adminmodifypizzas/{MealId}','MonProjet\Controller\Admin\AdminModify\ModifyPizzas\AdminModifyPizzasController::adminModifyPizzasPage')
    ->value('MealId', 1)
    ->assert('MealId', '\d+')
    ->bind('adminmodifypizzas');

$app->post('/adminmodifypizzas/{MealId}','MonProjet\Controller\Admin\AdminModify\ModifyPizzas\AdminModifyPizzasController::adminModifyPizzas');

$app->get('/adminmodifypaninis','MonProjet\Controller\Admin\AdminModify\AdminModifyController::adminModifyPageP')
    ->bind('adminmodifypaninis');

$app->get('/modifypaninis/{PaninisId}','MonProjet\Controller\Admin\AdminModify\ModifyPizzas\AdminModifyPizzasController::adminModifyPaninisPage')
    ->value('PaninisId', 1)
    ->assert('PaninisId', '\d+')
    ->bind('modifypaninis');

$app->post('/modifypaninis/{PaninisId}','MonProjet\Controller\Admin\AdminModify\ModifyPizzas\AdminModifyPizzasController::adminModifyPaninis');

$app->get('/adminmodifysides','MonProjet\Controller\Admin\AdminModify\AdminModifyController::adminModifyPageS')
    ->bind('adminmodifysides');

$app->get('/modifysides/{SideId}','MonProjet\Controller\Admin\AdminModify\ModifyPizzas\AdminModifyPizzasController::adminModifySidesPage')
    ->value('SideId', 1)
    ->assert('SideId', '\d+')
    ->bind('modifysides');

$app->post('/modifysides/{SideId}','MonProjet\Controller\Admin\AdminModify\ModifyPizzas\AdminModifyPizzasController::adminModifySides');

$app->get('/adminmodifydesserts','MonProjet\Controller\Admin\AdminModify\AdminModifyController::adminModifyPageDs')
    ->bind('adminmodifydesserts');

$app->get('/modifydesserts/{DessertId}','MonProjet\Controller\Admin\AdminModify\ModifyPizzas\AdminModifyPizzasController::adminModifyDessertsPage')
    ->value('DessertId', 1)
    ->assert('DessertId', '\d+')
    ->bind('modifydesserts');

$app->post('/modifydesserts/{DessertId}','MonProjet\Controller\Admin\AdminModify\ModifyPizzas\AdminModifyPizzasController::adminModifyDesserts');

$app->get('/adminmodifydrinks','MonProjet\Controller\Admin\AdminModify\AdminModifyController::adminModifyPageDk')
    ->bind('adminmodifydrinks');

$app->get('/modifydrinks/{DrinksId}','MonProjet\Controller\Admin\AdminModify\ModifyPizzas\AdminModifyPizzasController::adminModifyDrinksPage')
    ->value('DrinksId', 1)
    ->assert('DrinksId', '\d+')
    ->bind('modifydrinks');

$app->post('/modifydrinks/{DrinksId}','MonProjet\Controller\Admin\AdminModify\ModifyPizzas\AdminModifyPizzasController::adminModifyDrinks');

$app->get('/history','MonProjet\Controller\AboutUsController::history')
    ->bind('history');

$app->get('/contact','MonProjet\Controller\ContactController::contactPage')
    ->bind('contact');

$app->get('/settings','MonProjet\Controller\SettingsController::settingsPage')
    ->bind('settings');

$app->post('/settings','MonProjet\Controller\SettingsController::userUpdate');

$app->get('/password','MonProjet\Controller\PasswordController::passwordPage')
    ->bind('password');

$app->post('/password','MonProjet\Controller\PasswordController::passwordUpdate');

$app->get('/orderslist','MonProjet\Controller\OrdersListController::orderListPage')
    ->bind('orderslist');

$app->get('/orderdetails/{OrderId}','MonProjet\Controller\OrdersListController::showOrderDetails')
    ->value('OrderId', 1)
    ->assert('OrderId', '\d+')
    ->bind('orderdetails');

$app->run();
