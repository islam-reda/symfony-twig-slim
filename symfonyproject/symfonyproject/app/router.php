<?php
// $app->get('/api/customers', function () {
//   $db = new \App\Models\db();
//   $conn = new \App\Models\connection();
//   header('Content-Type: application/json');
//   $data = $db->getAllData('customers',$conn->conn);
//   var_dump($data);
// });

$app->any('/customers','CustomersController:index');
$app->any('/customers/delete/{id}','CustomersController:delete');
$app->any('/customers/import','CustomersController:import');

$app->any('/customers/export','CustomersController:export');


//$app->get('/customer/list','CustomersController:list');

$app->any('/','LoginController:index');
$app->any('/logout','LoginController:logout');

//vouchers
$app->any('/vouchers','VouchersController:index');
$app->any('/vouchers/new','VouchersController:new');
$app->any('/vouchers/delete/{id}','VouchersController:delete');
$app->any('/vouchers/update/{id}','VouchersController:update');

$app->any('/test','TestController:index');


// $app->get('/login','LoginController:login');

//brands
$app->any('/brands','BrandController:index');
$app->any('/brands/new','BrandController:new');
$app->any('/brands/delete/{id}','BrandController:delete');
$app->any('/brands/update/{id}','BrandController:update');

//brand_news
$app->any('/brand_news','NewsController:index');
$app->any('/brand_news/new','NewsController:new');
$app->any('/brand_news/delete/{id}','NewsController:delete');
$app->any('/brand_news/update/{id}','NewsController:update');


//stores
$app->any('/stores','StoresController:index');
$app->any('/stores/new','StoresController:new');
$app->any('/stores/delete/{id}','StoresController:delete');
$app->any('/stores/update/{id}','StoresController:update');



//users
$app->any('/users','UserController:index');
$app->any('/users/new','UserController:new');
$app->any('/users/delete/{id}','UserController:delete');
$app->any('/users/update/{id}','UserController:update');

//setting
$app->any('/setting','SettingController:index');
$app->any('/setting/new','SettingController:new');
$app->any('/setting/delete/{id}','SettingController:delete');
$app->any('/setting/update/{id}','SettingController:update');

//Api
$app->post('/api/customer/login','Auth:login');
$app->post('/api/customer/verfyuser','Auth:verfyuser');
$app->post('/api/customer/getuser','Auth:getuser');
$app->post('/api/customer/register','Auth:register');


$app->post('/api/home/news','Home:news');
$app->post('/api/home/vouchers','Home:vouchers');
$app->post('/api/home/stores','Location:getStores');

$app->post('/api/home/markers','Location:getMarkers');
