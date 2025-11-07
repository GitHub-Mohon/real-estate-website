<?php

use App\Http\Controllers\BackEnd\AdminController;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\Backend\AdminPackageController;
use App\Http\Controllers\Backend\AdminCustomerController;
use App\Http\Controllers\Backend\AdminAgentController;
use App\Http\Controllers\Backend\AdminOrderController;
use App\Http\Controllers\Backend\AdminPropertyController;
use App\Http\Controllers\Backend\AdminTestimonialController;
use App\Http\Controllers\Backend\AdminPostController;
use App\Http\Controllers\Backend\AdminSettingController;
use App\Http\Controllers\Backend\AmenityController;
use App\Http\Controllers\BackEnd\LocationController;
use App\Http\Controllers\Backend\TypeController;
use App\Http\Controllers\Backend\AdminSubscriberController;
use App\Http\Controllers\FrontEnd\FrontController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[FrontController::class,'index'])->name('home');
Route::get('/about',[FrontController::class,'about'])->name('about');
Route::get('/contact',[FrontController::class,'contact'])->name('contact');
Route::post('/contact-submit',[FrontController::class,'contact_submit'])->name('contact_submit');
Route::get('/select_user',[FrontController::class,'select_user'])->name('select_user');
Route::get('/pricing',[FrontController::class,'pricing'])->name('pricing');
Route::get('/property-details/{slug}',[FrontController::class,'property_details'])->name('property_details');
Route::get('/properties',[FrontController::class,'properties'])->name('properties');
Route::get('/locations',[FrontController::class,'locations'])->name('locations');
Route::get('/agents',[FrontController::class,'agents'])->name('agents');
Route::get('/agent-details/{id}',[FrontController::class,'agent_details'])->name('agent_details');
Route::post('/agent-send-mail/{id}',[FrontController::class,'agent_send_mail'])->name('agent_send_mail');
Route::get('/services',[FrontController::class,'services'])->name('services');
Route::get('/services-details',[FrontController::class,'services_details'])->name('services_details');
Route::post('/services-contact',[FrontController::class,'services_contact'])->name('services_contact');
Route::post('/schedule-tour-form',[FrontController::class,'agent_schedule_tour_form'])->name('agent_schedule_tour_form');
Route::get('/blog',[FrontController::class,'blog'])->name('blog');
Route::get('/blog-details/{slug}',[FrontController::class,'blog_details'])->name('blog_details');

// comment
Route::post('/comment/{post_id}',[FrontController::class,'comment_store'])->name('comment_store');
Route::post('/comment-edit/{comment_id}',[FrontController::class,'comment_edit'])->name('comment_edit');
Route::get('/comment-destroy/{comment_id}',[FrontController::class,'comment_destroy'])->name('comment_destroy');

//reply comment
Route::post('/reply-comment/{comment_id}',[FrontController::class,'reply_comment_store'])->name('reply_comment_store');
Route::post('/reply-comment-edit/{reply_comment_id}', [FrontController::class, 'reply_comment_edit'])->name('reply_comment_edit');
Route::get('/reply-comment-destroy/{reply_comment_id}', [FrontController::class, 'reply_comment_destroy'])->name('reply_comment_destroy');


Route::get('/terms',[FrontController::class,'terms'])->name('terms');
Route::get('/privacy',[FrontController::class,'privacy'])->name('privacy');

//404 page when route not fund
Route::fallback(function () {
    return response()->view('frontEnd.404page', [], 404);
});


//Subscriber Section
Route::post('/subscriber/send-email',[FrontController::class,'subscriber_send_email'])->name('subscriber_send_email');
Route::get('/subscriber/verify/{email}/{token}',[FrontController::class,'subscriber_send_email_verify'])->name('subscriber_send_email_verify');


//User section

Route::middleware('auth')->group(function(){

    Route::get('/dashboard',[UserController::class,'dashboard'])->name('dashboard');
    Route::get('/profile',[UserController::class,'profile'])->name('profile');
    Route::get('/wishlist',[UserController::class,'wishlist'])->name('wishlist');
    Route::get('/add-wishlist/{property_id}',[UserController::class,'add_wishlist'])->name('add_wishlist');
    Route::get('/remove-wishlist/{id}',[UserController::class,'remove_wishlist'])->name('remove_wishlist');
    Route::get('/message/index',[UserController::class,'message_index'])->name('message');
    Route::get('/message/chat/{id}',[UserController::class,'message_chat'])->name('message_chat');
    Route::post('/message/conversation/{message_id}',[UserController::class,'message_conversation'])->name('message_conversation');
    Route::get('/message/create',[UserController::class,'message_create'])->name('message_create');
    Route::post('/message/store',[UserController::class,'message_store'])->name('message_store');
    Route::post('/profile',[UserController::class,'profile_submit'])->name('profile_submit');
    Route::get('/logout',[UserController::class,'logout'])->name('logout');
});

Route::get('/register',[UserController::class,'register'])->name('register');
Route::post('/registration',[UserController::class,'registration_submit'])->name('registration_submit');
Route::get('/registration_verify/{token}/{email}',[UserController::class,'registration_verify'])->name('registration_verify');
Route::get('/login',[UserController::class,'login'])->name('login');
Route::post('/login',[UserController::class,'login_submit'])->name('login_submit');
Route::get('/forget_password',[UserController::class,'forget_password'])->name('forget_password');
Route::post('/forget_password',[UserController::class,'forget_password_submit'])->name('forget_password_submit');
Route::get('/reset_password/{token}/{email}',[UserController::class,'reset_password'])->name('reset_password');
Route::post('/reset_password/{token}/{email}',[UserController::class,'reset_password_submit'])->name('reset_password_submit');

//Admin Section

Route::middleware('admin')->prefix('admin')->group(function(){

    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('admin_dashboard');
    Route::get('/profile',[AdminController::class,'profile'])->name('admin_profile');
    Route::post('/profile',[AdminController::class,'profile_submit'])->name('admin_profile_submit');
    Route::get('/logout',[AdminController::class,'logout'])->name('admin_logout');

    //package section
    Route::get('/package/index',[AdminPackageController::class,'index'])->name('admin_package_index');
    Route::get('/package/create',[AdminPackageController::class,'package_create'])->name('admin_package_create');
    Route::post('/package/store',[AdminPackageController::class,'package_store'])->name('admin_package_store');
    Route::get('/package/edit/{id}',[AdminPackageController::class,'package_edit'])->name('admin_package_edit');
    Route::post('/package/update/{id}',[AdminPackageController::class,'package_update'])->name('admin_package_update');
    Route::get('/package/destroy/{id}',[AdminPackageController::class,'package_destroy'])->name('admin_package_destroy');

    //order section

    Route::get('/order',[AdminOrderController::class,'index'])->name('admin_order_index');
    Route::get('/invoice/{id}',[AdminOrderController::class,'invoice'])->name('admin_order_invoice');


    //Customer section
    Route::get('/customer/index',[AdminCustomerController::class,'index'])->name('admin_customer_index');
    Route::get('/customer/create',[AdminCustomerController::class,'customer_create'])->name('admin_customer_create');
    Route::post('/customer/store',[AdminCustomerController::class,'customer_store'])->name('admin_customer_store');
    Route::get('/customer/edit/{id}',[AdminCustomerController::class,'customer_edit'])->name('admin_customer_edit');
    Route::post('/customer/update/{id}',[AdminCustomerController::class,'customer_update'])->name('admin_customer_update');
    Route::get('/customer/destroy/{id}',[AdminCustomerController::class,'customer_destroy'])->name('admin_customer_destroy');


    //Agent section
    Route::get('/agent/index',[AdminAgentController::class,'index'])->name('admin_agent_index');
    Route::get('/agent/create',[AdminAgentController::class,'agent_create'])->name('admin_agent_create');
    Route::post('/agent/store',[AdminAgentController::class,'agent_store'])->name('admin_agent_store');
    Route::get('/agent/edit/{id}',[AdminAgentController::class,'agent_edit'])->name('admin_agent_edit');
    Route::post('/agent/update/{id}',[AdminAgentController::class,'agent_update'])->name('admin_agent_update');
    Route::get('/agent/destroy/{id}',[AdminAgentController::class,'agent_destroy'])->name('admin_agent_destroy');


    //Location section
    Route::get('/location/index',[LocationController::class,'index'])->name('admin_location_index');
    Route::get('/location/create',[LocationController::class,'location_create'])->name('admin_location_create');
    Route::post('/location/store',[LocationController::class,'location_store'])->name('admin_location_store');
    Route::get('/location/edit/{id}',[LocationController::class,'location_edit'])->name('admin_location_edit');
    Route::post('/location/update/{id}',[LocationController::class,'location_update'])->name('admin_location_update');
    Route::get('/location/destroy/{id}',[LocationController::class,'location_destroy'])->name('admin_location_destroy');

    //Type section
    Route::get('/type/index',[TypeController::class,'index'])->name('admin_type_index');
    Route::get('/type/create',[TypeController::class,'type_create'])->name('admin_type_create');
    Route::post('/type/store',[TypeController::class,'type_store'])->name('admin_type_store');
    Route::get('/type/edit/{id}',[TypeController::class,'type_edit'])->name('admin_type_edit');
    Route::post('/type/update/{id}',[TypeController::class,'type_update'])->name('admin_type_update');
    Route::get('/type/destroy/{id}',[TypeController::class,'type_destroy'])->name('admin_type_destroy');

    //Amenity section
    Route::get('/amenity/index',[AmenityController::class,'index'])->name('admin_amenity_index');
    Route::get('/amenity/create',[AmenityController::class,'amenity_create'])->name('admin_amenity_create');
    Route::post('/amenity/store',[AmenityController::class,'amenity_store'])->name('admin_amenity_store');
    Route::get('/amenity/edit/{id}',[AmenityController::class,'amenity_edit'])->name('admin_amenity_edit');
    Route::post('/amenity/update/{id}',[AmenityController::class,'amenity_update'])->name('admin_amenity_update');
    Route::get('/amenity/destroy/{id}',[AmenityController::class,'amenity_destroy'])->name('admin_amenity_destroy');

    //Property section
    Route::get('/property/index',[AdminPropertyController::class,'index'])->name('admin_property_index');
    Route::get('/property/destroy/{property_id}',[AdminPropertyController::class,'property_destroy'])->name('admin_property_destroy');
    Route::get('/property/details/{property_id}',[AdminPropertyController::class,'property_details'])->name('admin_property_details');
    Route::get('/property/change-status/{property_id}',[AdminPropertyController::class,'property_change_status'])->name('admin_property_change_status');


    //Testimonial section
    Route::get('/testimonial/index',[AdminTestimonialController::class,'index'])->name('admin_testimonial_index');
    Route::get('/testimonial/create',[AdminTestimonialController::class,'testimonial_create'])->name('admin_testimonial_create');
    Route::post('/testimonial/store',[AdminTestimonialController::class,'testimonial_store'])->name('admin_testimonial_store');
    Route::get('/testimonial/edit/{id}',[AdminTestimonialController::class,'testimonial_edit'])->name('admin_testimonial_edit');
    Route::post('/testimonial/update/{id}',[AdminTestimonialController::class,'testimonial_update'])->name('admin_testimonial_update');
    Route::get('/testimonial/destroy/{id}',[AdminTestimonialController::class,'testimonial_destroy'])->name('admin_testimonial_destroy');

    //Post section
    Route::get('/post/index',[AdminPostController::class,'index'])->name('admin_post_index');
    Route::get('/post/create',[AdminPostController::class,'post_create'])->name('admin_post_create');
    Route::post('/post/store',[AdminPostController::class,'post_store'])->name('admin_post_store');
    Route::get('/post/edit/{id}',[AdminPostController::class,'post_edit'])->name('admin_post_edit');
    Route::post('/post/update/{id}',[AdminPostController::class,'post_update'])->name('admin_post_update');
    Route::get('/post/destroy/{id}',[AdminPostController::class,'post_destroy'])->name('admin_post_destroy');


    //Subscriber

    Route::get('/subscriber/index',[AdminSubscriberController::class,'index'])->name('admin_subscriber_index');
    Route::get('/subscriber/create',[AdminSubscriberController::class,'subscriber_create'])->name('admin_subscriber_create');
    Route::post('/subscriber/store',[AdminSubscriberController::class,'subscriber_store'])->name('admin_subscriber_store');
    Route::get('/subscriber/destroy/{id}',[AdminSubscriberController::class,'subscriber_destroy'])->name('admin_subscriber_destroy');

    Route::get('/subscriber-change-status/{id}',[AdminSubscriberController::class,'subscriber_change_status'])->name('subscriber_change_status');
    Route::get('/subscriber-export',[AdminSubscriberController::class,'subscriber_export'])->name('subscriber_export');

    //Setting

    Route::get('/setting',[AdminSettingController::class,'setting'])->name('admin_setting');
    Route::post('/setting-update/{id}',[AdminSettingController::class,'setting_update'])->name('admin_setting_update');




});

Route::prefix('admin')->group(function(){

    Route::get('/',function(){return redirect()->route('admin_login');});
    Route::get('/login',[AdminController::class,'login'])->name('admin_login');
    Route::post('/login',[AdminController::class,'login_submit'])->name('admin_login_submit');
    Route::get('/forget_password',[AdminController::class,'forget_password'])->name('admin_forget_password');
    Route::post('/forget_password',[AdminController::class,'forget_password_submit'])->name('admin_forget_password_submit');
    Route::get('/reset_password/{token}/{email}',[AdminController::class,'reset_password'])->name('admin_reset_password');
    Route::post('/reset_password/{token}/{email}',[AdminController::class,'reset_password_submit'])->name('admin_reset_password_submit');

});



//Agent Section

Route::middleware('agent')->prefix('agent')->group(function(){

    Route::get('/dashboard',[AgentController::class,'dashboard'])->name('agent_dashboard');
    Route::get('/profile',[AgentController::class,'profile'])->name('agent_profile');
    Route::get('/payment',[AgentController::class,'payment'])->name('agent_payment');
    Route::get('/order',[AgentController::class,'order'])->name('agent_order');
    Route::get('/invoice/{order_id}',[AgentController::class,'invoice'])->name('agent_invoice');
    Route::post('/profile',[AgentController::class,'profile_submit'])->name('agent_profile_submit');
    Route::get('/logout',[AgentController::class,'logout'])->name('agent_logout');
});

Route::prefix('agent')->group(function(){

    Route::get('/register',[AgentController::class,'register'])->name('agent_register');
    Route::post('/registration',[AgentController::class,'registration_submit'])->name    ('agent_registration_submit');
    Route::get('/registration_verify/{token}/{email}',[AgentController::class,    'registration_verify'])->name('agent_registration_verify');
    Route::get('/',function(){return redirect()->route('agent_login');});
    Route::get('/login',[AgentController::class,'login'])->name('agent_login');
    Route::post('/login',[AgentController::class,'login_submit'])->name('agent_login_submit');
    Route::get('/forget_password',[AgentController::class,'forget_password'])->name('agent_forget_password');
    Route::post('/forget_password',[AgentController::class,'forget_password_submit'])->name('agent_forget_password_submit');
    Route::get('/reset_password/{token}/{email}',[AgentController::class,'reset_password'])->name('agent_reset_password');
    Route::post('/reset_password/{token}/{email}',[AgentController::class,'reset_password_submit'])->name('agent_reset_password_submit');


    //Stripe payment

    Route::post('/stripe',[AgentController::class,'stripe'])->name('agent_stripe');
    Route::get('/stripe-success',[AgentController::class,'stripe_success'])->name('agent_stripe_success');
    Route::get('/stripe-cancel',[AgentController::class,'stripe_cancel'])->name('agent_stripe_cancel');

    //Property section
    Route::get('/property/index',[AgentController::class,'property_index'])->name('agent_property_index');
    Route::get('/property/create',[AgentController::class,'property_create'])->name('agent_property_create');
    Route::post('/property/store',[AgentController::class,'property_store'])->name('agent_property_store');
    Route::get('/property/edit/{id}',[AgentController::class,'property_edit'])->name('agent_property_edit');
    Route::post('/property/update/{id}',[AgentController::class,'property_update'])->name('agent_property_update');
    Route::get('/property/destroy/{id}',[AgentController::class,'property_destroy'])->name('agent_property_destroy');
//photo Gallery
    Route::get('/property/photo-gallery/{property_id}',[AgentController::class,'property_photo_gallery'])->name('agent_property_photo_gallery');
    Route::post('/property/photo-gallery/{property_id}',[AgentController::class,'property_photo_gallery_store'])->name('agent_property_photo_gallery_store');
    Route::get('/property/photo-gallery-delete/{photo_gallery_id}',[AgentController::class,'property_photo_gallery_delete'])->name('agent_property_photo_gallery_delete');

//video Gallery
    Route::get('/property/video-gallery/{property_id}',[AgentController::class,'property_video_gallery'])->name('agent_property_video_gallery');
    Route::post('/property/video-gallery/{property_id}',[AgentController::class,'property_video_gallery_store'])->name('agent_property_video_gallery_store');
    Route::get('/property/video-gallery-delete/{video_gallery_id}',[AgentController::class,'property_video_gallery_delete'])->name('agent_property_video_gallery_delete');

    //Message

    Route::get('/message/index',[AgentController::class,'message_index'])->name('agent_message');
    Route::get('/message/chat/{id}',[AgentController::class,'message_chat'])->name('agent_message_chat');
    Route::post('/message/conversation/{message_id}',[AgentController::class,'message_conversation'])->name('agent_message_conversation');

});


