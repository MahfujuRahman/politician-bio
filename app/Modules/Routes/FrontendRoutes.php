<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Controllers\Frontend\FrontendController;
use App\Modules\Controllers\Frontend\Auth\AuthController;



//Home
Route::get('/', [FrontendController::class, 'HomePage'])->name('HomePage');
// About
Route::get('/about-us', [FrontendController::class, 'AboutUsPage'])->name('AboutUsPage');
// Donation
Route::get('/donation', [FrontendController::class, 'DonationPage'])->name('DonationPage');
Route::get('/donation/details', [FrontendController::class, 'DonationDetailsPage'])->name('DonationDetailsPage');
// Pages
Route::get('/pages/history', [FrontendController::class, 'HistoryPage'])->name('HistoryPage');
Route::get('/pages/history/details', [FrontendController::class, 'HistoryDetailsPage'])->name('HistoryDetailsPage');
Route::get('/pages/principles', [FrontendController::class, 'PrinciplesPage'])->name('pages.principles');
Route::get('/pages/team', [FrontendController::class, 'TeamPage'])->name('pages.team');
Route::get('/pages/media', [FrontendController::class, 'MediaPage'])->name('pages.media');
Route::get('/pages/gallery', [FrontendController::class, 'GalleryPage'])->name('pages.gallery');
Route::get('/pages/issues', [FrontendController::class, 'IssuesPage'])->name('pages.issues');
Route::get('/pages/issues/details', [FrontendController::class, 'IssuesDetailsPage'])->name('pages.issues.details');
Route::get('/pages/volunteer', [FrontendController::class, 'VolunteerPage'])->name('pages.volunteer');
Route::get('/pages/services', [FrontendController::class, 'ServicesPage'])->name('pages.services');
Route::get('/pages/services/details', [FrontendController::class, 'ServicesDetailsPage'])->name('pages.services.details');
Route::get('/pages/faq', [FrontendController::class, 'FaqPage'])->name('pages.faq');
//events
Route::get('/events/event', [FrontendController::class, 'EventPage'])->name('EventPage');
Route::get('/events/event/details', [FrontendController::class, 'EventDetailsPage'])->name('EventDetailsPage');
// News
Route::get('/news', [FrontendController::class, 'NewsPage'])->name('news');
Route::get('/news/details', [FrontendController::class, 'NewsDetailsPage'])->name('news.details');
Route::get('/news/debug-comments', [FrontendController::class, 'NewsCommentsDebugPage'])->name('news.debug-comments');
// Contact Us
Route::get('/contact-us', [FrontendController::class, 'ContactUsPage'])->name('ContactUsPage');
//single pages
Route::get('/single/election', [FrontendController::class, 'ElectionPage'])->name('single.election');
Route::get('/single/privacy-policy', [FrontendController::class, 'PrivacyPolicyPage'])->name('single.privacy-policy');
Route::get('/single/terms-and-conditions', [FrontendController::class, 'TermsAndConditionsPage'])->name('single.terms-and-conditions');


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'LoginPage'])->name('LoginPage');
Route::get('/register', [AuthController::class, 'RegisterPage'])->name('RegisterPage');
Route::get('/forgot-password', [AuthController::class, 'ForgotPassword'])->name('ForgotPassword');
