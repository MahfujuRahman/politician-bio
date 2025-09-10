<?php

namespace App\Modules\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Modules\Management\BannerManagement\Banner\Models\Model as BannerModel;
use App\Modules\Management\ServicesManagement\Services\Models\Model as ServiceModel;
use App\Modules\Management\WhyChoseUsManagement\WhyChoseUs\Models\Model as WhyChoseUsModel;
use App\Modules\Management\OurPrinciplesManagement\OurPrinciples\Models\Model as OurPrinciplesModel;
use App\Modules\Management\OurPrinciplesManagement\OurPrinciples\Models\Model as PrincipleModel;
use App\Modules\Management\OurJourneyManagement\OurJourney\Models\Model as OurJourneyModel;
use App\Modules\Management\MediaCoverageManagement\MediaCoverage\Models\Model as MediaCoverageModel;
use App\Modules\Management\PublicCommentManagement\PublicComment\Models\Model as PublicCommentModel;
use App\Modules\Management\NewsManagement\News\Models\Model as NewsModel;


class FrontendController extends Controller
{
    // Home
    public function HomePage()
    {

        return Inertia::render('HomePage/Index', [
            'event' => [
                'title' => 'Home Page',
                'meta'  => [
                    'description' => 'test description',
                ]
            ]
        ]);
    }

    // About
    public function AboutUsPage()
    {
        return Inertia::render('AboutUs/Index', [
            'event' => [
                'title' => 'About Us',
            ]
        ]);
    }

    // Donation
    public function DonationPage()
    {
        return Inertia::render('Donation/Index', [
            'event' => [
                'title' => 'Donation',
            ]
        ]);
    }

    public function DonationDetailsPage()
    {
        $slug = request()->query('slug');
        if (!$slug) {
            return redirect()->back();
        }

        return Inertia::render('Donation/Details', [
            'event' => [
                'title' => 'Donation Details',
            ]
        ]);
    }

    // Pages/History
    public function HistoryPage()
    {
        return Inertia::render('Pages/History/Index', [
            'event' => [
                'title' => 'History',
            ]
        ]);
    }

    public function HistoryDetailsPage()
    {
        return Inertia::render('Pages/History/Details', [
            'event' => [
                'title' => 'History Details',
            ]
        ]);
    }

    // Pages/Principles
    public function PrinciplesPage()
    {
        return Inertia::render('Pages/Principles/Index', [
            'event' => [
                'title' => 'Principles',
            ]
        ]);
    }

    // Pages/Team
    public function TeamPage()
    {
        return Inertia::render('Pages/Team/Index', [
            'event' => [
                'title' => 'Team',
            ]
        ]);
    }

    // Pages/Gallery
    public function GalleryPage()
    {
        return Inertia::render('Pages/Gallery/Index', [
            'event' => [
                'title' => 'Gallery',
            ]
        ]);
    }
    // Pages/Media
    public function MediaPage()
    {
        return Inertia::render('Pages/Media/Index', [
            'event' => [
                'title' => 'Media',
            ]
        ]);
    }

    // Pages/Issues
    public function IssuesPage()
    {
        return Inertia::render('Pages/Issues/Index', [
            'event' => [
                'title' => 'Issues',
            ]
        ]);
    }

    // Pages/Issues Details
    public function IssuesDetailsPage()
    {
        $slug = request()->query('slug');
        if (!$slug) {
            return redirect()->back();
        }

        return Inertia::render('Pages/Issues/Details', [
            'event' => [
                'title' => 'Issues Details',
            ]
        ]);
    }

    // Pages/Volunteer
    public function VolunteerPage()
    {
        return Inertia::render('Pages/Volunteer/Index', [
            'event' => [
                'title' => 'Volunteer',
            ]
        ]);
    }

    // Pages/Services
    public function ServicesPage()
    {
        $services = ServiceModel::active()->latest()->take(6)->get();
        return Inertia::render('Pages/Services/Index', [
            'event' => [
                'title' => 'Services',
            ],
            'data'  => [
                'services' => $services,
            ]
        ]);
    }

    // Pages/Services Details
    public function ServicesDetailsPage(Request $request)
    {
        $slug = request()->query('slug');
        if (!$slug) {
            return redirect()->back();
        }
        return Inertia::render('Pages/Services/Details', [
            'event' => [
                'title' => 'Service Details',
            ],
        ]);
    }

    // Pages/HelpFaq
    public function FaqPage()
    {
        return Inertia::render('Pages/Faq/Index', [
            'event' => [
                'title' => 'Help & Faq',
            ]
        ]);
    }

    // Events
    public function EventPage()
    {
        return Inertia::render('Events/Event/Index', [
            'event' => [
                'title' => 'Event',
            ]
        ]);
    }

    public function EventDetailsPage()
    {
        $slug = request()->query('slug');
        if (!$slug) {
            return redirect()->back();
        }
        return Inertia::render('Events/Event/Details', [
            'event' => [
                'title' => 'Event Details',
            ]
        ]);
    }

    // News
    public function NewsPage()
    {
        return Inertia::render('News/Index', [
            'event' => [
                'title' => 'News',
            ]
        ]);
    }

    public function NewsDetailsPage()
    {
        return Inertia::render('News/Details', [
            'event' => [
                'title' => 'News Details',
            ],
        ]);
    }

    public function NewsCommentsDebugPage()
    {
        return Inertia::render('News/CommentDebugPage', [
            'event' => [
                'title' => 'Comment System Debug',
            ],
        ]);
    }

    // Contact
    public function ContactUsPage()
    {
        return Inertia::render('Contacts/Index', [
            'event' => [
                'title' => 'Contact',
            ]
        ]);
    }

    // Single/Election
    public function ElectionPage()
    {
        return Inertia::render('Single/Election', [
            'event' => [
                'title' => 'Election',
            ]
        ]);
    }

    // Single/Privacy Policy
    public function PrivacyPolicyPage()
    {
        return Inertia::render('Single/PrivacyPolicy', [
            'event' => [
                'title' => 'Privacy Policy',
            ]
        ]);
    }

    // Single/Terms and Conditions
    public function TermsAndConditionsPage()
    {
        return Inertia::render('Single/TermsAndConditions', [
            'event' => [
                'title' => 'Terms and Conditions',
            ]
        ]);
    }

    
}
