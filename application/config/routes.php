<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'C_index';
$route['404_override'] = 'C_error';
$route['translate_uri_dashes'] = TRUE;

$route['login'] = 'C_index/login';
$route['logout'] ='C_index/logout';
$route['reset'] ='C_index/reset';
$route['reset_send'] ='C_index/reset_send';
$route['test_email'] = 'C_index/test_email';

//dashboard/data/"tipe"/"bulan";
$route['dashboard/data/:any/:any'] = 'C_index/data';
$route['dashboard/info/:any'] = 'C_index/info';

//Ganti Password
$route['gpass'] = 'C_setting/ganti_password';

// Edit Profile
$route['profile'] = 'C_setting/profile';
$route['profile/update'] = 'C_setting/profile_update';

//Master Item
$route['master/item'] = 'C_master/item';
$route['master/item/data'] = 'C_master/item_data';
$route['master/item/new'] = 'C_master/item_new';
$route['master/item/upd'] = 'C_master/item_upd';
$route['master/item/del'] = 'C_master/item_del';

//Master gedung
$route['master/gedung'] = 'C_master/gedung';
$route['master/gedung/data'] = 'C_master/gedung_data';
$route['master/gedung/new'] = 'C_master/gedung_new';
$route['master/gedung/upd'] = 'C_master/gedung_upd';
$route['master/gedung/del'] = 'C_master/gedung_del';

//Master Ruangan
$route['master/ruangan'] = 'C_master/ruangan';
$route['master/ruangan/data'] = 'C_master/ruangan_data';
$route['master/ruangan/new'] = 'C_master/ruangan_new';
$route['master/ruangan/upd'] = 'C_master/ruangan_upd';
$route['master/ruangan/del'] = 'C_master/ruangan_del';

//Master Ruangan item
$route['master/ruangan-item'] = 'C_master/ruangan_item';
$route['master/ruangan-item/data'] = 'C_master/ruangan_item_data';
$route['master/ruangan-item/new'] = 'C_master/ruangan_item_new';
$route['master/ruangan-item/upd'] = 'C_master/ruangan_item_upd';
$route['master/ruangan-item/del'] = 'C_master/ruangan_item_del';

$route['master/ruangan-item/query'] = 'C_master/ruangan_item_query';


//Master Kategori
$route['master/kategori'] = 'C_master/kategori';
$route['master/kategori/data'] = 'C_master/kategori_data';
$route['master/kategori/new'] = 'C_master/kategori_new';
$route['master/kategori/upd'] = 'C_master/kategori_upd';
$route['master/kategori/del'] = 'C_master/kategori_del';


//Master Pekerjaan Rutin
$route['master/prutin'] = 'C_master/prutin';
$route['master/prutin/data'] = 'C_master/prutin_data';
$route['master/prutin/new'] = 'C_master/prutin_new';
$route['master/prutin/upd'] = 'C_master/prutin_upd';
$route['master/prutin/del'] = 'C_master/prutin_del';

//--------------------------------------------------------
//-------------------Jadwal Rutin-------------------------
//--------------------------------------------------------

//Buat Jadwal Rutin | Menu : input jadwal rutin
$route['jadwal/rutin/new'] = 'C_jadwal/rutin_new';
$route['jadwal/rutin/query'] = 'C_jadwal/rutin_query';

$route['jadwal/rutin/save/list'] = 'C_jadwal/rutin_save_list';
$route['jadwal/rutin/save/jadwal'] = 'C_jadwal/rutin_save';
$route['jadwal/rutin/del/draft'] = 'C_jadwal/rutin_del_draft';


//Update Jadwal Rutin | Menu : Lihat jadwal rutin

$route['empty'] = 'C_jadwal/empty';
$route['jadwal/rutin/view'] = 'C_jadwal/rutin_view';
$route['jadwal/rutin/view/data'] = 'C_jadwal/rutin_view_data';
$route['jadwal/rutin/view/upd'] = 'C_jadwal/rutin_view_upd';
$route['jadwal/rutin/view/del'] = 'C_jadwal/rutin_view_del';
$route['jadwal/rutin/view/approve'] = 'C_jadwal/rutin_view_approve';

//--------------------------------------------------------
//-----------------End Jadwal Rutin-----------------------
//--------------------------------------------------------




//--------------------------------------------------------
//-----------------Laporan Kerusakan----------------------
//--------------------------------------------------------

//Buat Laporan Kerusakan | Menu : permintaaan perbaikan
$route['kerusakan/new'] = 'C_kerusakan/kerusakan_new';
$route['kerusakan/save'] = 'C_kerusakan/kerusakan_save';


//Update Status Perbaikan | Menu : update status perbaikan

$route['kerusakan/view'] = 'C_kerusakan/kerusakan_view';
$route['kerusakan/view/data'] = 'C_kerusakan/kerusakan_view_data';
$route['kerusakan/view/upd'] = 'C_kerusakan/kerusakan_view_upd';
$route['kerusakan/view/del'] = 'C_kerusakan/kerusakan_view_del';

$route['kerusakan/view/approve'] = 'C_kerusakan/kerusakan_view_approve';

//--------------------------------------------------------
//---------------End Laporan Kerusakan--------------------
//--------------------------------------------------------


//--------------------------------------------------------
//-------------------Buat User App------------------------
//--------------------------------------------------------

$route['admin/user'] = 'C_user/user_view';
$route['admin/user/data'] = 'C_user/user_data';
$route['admin/user/new'] = 'C_user/user_new';
$route['admin/user/upd'] = 'C_user/user_upd';
$route['admin/user/del'] = 'C_user/user_del';

//--------------------------------------------------------
//-----------------End Buat User App----------------------
//--------------------------------------------------------

//--------------------------------------------------------
//------------------Buat Akses App------------------------
//--------------------------------------------------------

$route['admin/akses'] = 'C_user/akses_view';
$route['admin/akses/data'] = 'C_user/akses_data';
$route['admin/akses/upd'] = 'C_user/akses_upd';

//--------------------------------------------------------
//----------------End Buat Akses App----------------------
//--------------------------------------------------------

//--------------------------------------------------------
//----------------------REPORT----------------------------
//--------------------------------------------------------

$route['report'] = 'C_report/report';
$route['report/data'] = 'C_report/report_data';


//--------------------------------------------------------
//--------------------END REPORT--------------------------
//--------------------------------------------------------


//--------------------------------------------------------
//--------------------User Manual-------------------------
//--------------------------------------------------------

$route['um'] = 'C_um/um';
$route['um/edit'] = 'C_um/edit';

//--------------------------------------------------------
//--------------------User Manual-------------------------
//--------------------------------------------------------