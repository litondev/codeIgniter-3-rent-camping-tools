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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'UserHomeController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* USER ROUTING */
$route["signin"] = "UserAuthController/signin";
$route["signup"] = "UserAuthController/signup";
$route["forget-password"] = "UserAuthController/forgetPassword";
$route["reset-password"] = "UserAuthController/resetPassword";

$route["action-signin"] = "UserActionAuthController/signin";
$route["action-signup"] = "UserActionAuthController/signup";
$route["action-forget-password"] = "UserActionAuthController/forgetPassword";
$route["action-reset-password"] = "UserActionAuthController/resetPassword";

$route['logout'] = "UserLogoutController/index";

$route["info"] = "UserInfoController/info";
$route["info/(:any)"] = "UserInfoController/infoDetail/$1";

$route["product"] = "UserProductController/product";
$route["product/(:num)"] = "UserProductDetailController/productDetail/$1";

$route["cart"] = "UserCartController/index";

$route["notif"] = "UserNotifController/index";

$route["akun"] = "UserAkunController/index";

$route["profil"] = "UserProfilController/index";
$route["action/update-data"] = "UserProfilController/updateData";
$route["action/update-password"] = "UserProfilController/updatePassword";

$route["wishlist"] = "UserWishlistController/index";
$route["action/add-wishlist/(:num)"] = "UserWishlistController/addWishlist/$1";
$route["action/sub-wishlist/(:num)"] = "UserWishlistController/subWishlist/$1";

$route["action/add-cart/(:num)"] = "UserCartController/addCart/$1";
$route["action/sub-cart/(:num)"] = "UserCartController/subCart/$1";
$route["action/subs-cart"] = "UserCartController/subsCart";

$route["checkout"] = "UserCheckoutController/checkout";

$route["invoice"] = "UserInvoiceController/index";
$route['action/cancel-order/(:num)'] = "UserInvoiceController/cancelOrder/$1";
$route["history-invoice"] = "UserInvoiceController/historyInvoice";
$route["history-manual-payment"] = "UserManualPaymentController/historyManualPayment";

$route["manual-payment"] = "UserManualPaymentController/index";
$route["action/manual-payment"] = "UserManualPaymentController/manualPayment";
$route["action/review-product"] = "UserReviewController/reviewProduct";
$route["action/download-pdf-invoice/(:num)"] = "UserInvoiceController/downloadPdfInvoice/$1";
/* USER ROUTING */


/* ADMIN ROUTING */
$route["admin"] = "AdminHomeController/index";

$route["admin/log-admin"] = "AdminLogController/index";

$route["admin/notif-admin"] = "AdminNotifController/index";

$route["admin/slider"] = "AdminSlidercontroller/index";
$route["admin/slider/(:num)/(:any)"] = "AdminSlidercontroller/changeStatus/$1/$2";
$route["admin/slider/(:num)"] = "AdminSlidercontroller/deleteSlider/$1";
$route["admin/slider/action-add"] = "AdminSlidercontroller/addSlider";

$route["admin/info"] = "AdminInfoController/index";
$route["admin/info/action-add"] = "AdminInfoController/addInfo";
$route["admin/info/action-edit/(:num)"] = "AdminInfoController/editInfo/$1";
$route["admin/info/(:num)"] = "AdminInfoController/deleteInfo/$1";

$route["admin/category"] = "AdminCategoryController/index";
$route["admin/category/action-add"] = "AdminCategoryController/addCategory";
$route["admin/category/action-edit/(:num)"] = "AdminCategoryController/editCategory/$1";
$route["admin/category/(:num)/(:any)"] = "AdminCategorycontroller/changeStatus/$1/$2";

$route["admin/setting/website"] = "AdminSettingController/website";
$route["admin/setting/invoice"] = "AdminSettingController/invoice";
$route["admin/setting/order"] = "AdminSettingController/order";

$route["admin/setting/website/action-edit"] = "AdminSettingController/editWebsite";
$route["admin/setting/invoice/action-edit"] = "AdminSettingController/editInvoice";
$route["admin/setting/order/action-edit"] = "AdminSettingController/editOrder";

$route["admin/review"] = "AdminReviewController/index";
$route["admin/review/negatif"] = "AdminReviewNegatifController/index";
$route["admin/review/positif"] = "AdminReviewPositifController/index";
$route["admin/review/(:num)"] = "AdminReviewController/deleteReview/$1";
$route["admin/review/replay-add"] = "AdminReviewController/addReplay";
$route["admin/review/replay-edit"] = "AdminReviewController/editReplay";

$route["admin/user"] = "AdminUserController/index";
$route["admin/user/action-blokir"] = "AdminUserController/blokir";
$route["admin/user/action-unblokir/(:num)"] = "AdminUserController/unblokir/$1";
$route["admin/user/blokir"] = "AdminUserBlokirController/index";
$route["admin/user/(:num)"] = "AdminUserEditController/index/$1";
$route["admin/user/action-edit/(:num)"]  = "AdminUserEditController/editUser/$1";

$route["admin/product"] = "AdminProductController/index";
$route["admin/product/nonaktif"] = "AdminProductNonaktifController/index";
$route["admin/product/(:num)/(:any)"] = "AdminProductController/changeStatus/$1/$2";

$route["admin/product/add"] = "AdminProductCreateController/index";
$route["admin/product/action-add"] = "AdminProductCreateController/add";

$route["admin/product/(:num)"] = "AdminProductEditController/index/$1";
$route["admin/product/action-edit/(:num)"] = "AdminProductEditController/edit/$1";

$route["admin/manual-payment"] = "AdminManualPaymentController/index";
$route["admin/manual-payment/validasi"] = "AdminManualPaymentValidasiController/index";
$route["admin/manual-payment/detail/(:num)"] = "AdminManualPaymentDetailController/index/$1";
$route["admin/manual-payment/success/(:num)"] = "AdminManualPaymentDetailController/successPayment/$1";
$route["admin/manual-payment/failed/(:num)"] = "AdminManualPaymentDetailController/failedPayment/$1";
$route["admin/manual-payment/paid/(:num)"] = "AdminManualPaymentDetailController/paid/$1";

$route["admin/invoice"] = "AdminInvoiceController/index";
$route["admin/invoice/detail/(:num)"] = "AdminInvoiceController/detail/$1";

$route["admin/cronjob"] = "CronjobController/index";
$route["admin/cronjob/action/expired-payment"] = "CronjobController/actionExpiredPayment";
$route["admin/cronjob/action/expired-invoice"] = "CronjobController/actionExpiredInvoice";
$route["admin/cronjob/action/backing-stuff"] = "CronjobController/actionBackingStuff";

$route["admin/invoice/action/rejected/(:num)"] = "AdminActionInvoiceController/actionRejected/$1";
$route["admin/invoice/action/payment/(:num)"] = "AdminActionInvoiceController/actionPayment/$1";
$route["admin/invoice/action/withdrawing-stuff/(:num)"] = "AdminActionInvoiceController/actionWithdrawingStuff/$1";
$route["admin/invoice/action/in-rent/(:num)"] = "AdminActionInvoiceController/actionInRent/$1";
$route["admin/invoice/action/backing-stuff/(:num)"] = "AdminActionInvoiceController/actionBackingStuff/$1";
$route["admin/invoice/action/completed/(:num)"] = "AdminActionInvoiceController/actionCompleted/$1";

$route["admin/invoice/fine"] = "AdminActionInvoiceController/addFine";
$route["admin/invoice/fine/(:num)"] = "AdminActionInvoiceController/editFine/$1";
/* ADMIN ROUTING */