<?php

namespace Database\Seeders;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use Illuminate\Database\Seeder;

/**
 * User seeder management.
 */

use App\Modules\Management\UserManagement\Role\Seeder\Seeder as RoleSeeder;
use App\Modules\Management\UserManagement\User\Seeder\Seeder as UserSeeder;
use App\Modules\Management\SettingManagement\WebsiteSettings\Seeder\Seeder as WebsiteSettingsSeeder;

/**
 * Suppliyer seeder management.
 */

use App\Modules\Management\EventManagement\Event\Seeder\Seeder as EventSeeder;
use App\Modules\Management\EventManagement\JoinEvent\Seeder\Seeder as JoinEventSeeder;
use App\Modules\Management\NewsletterManagement\Newsletter\Seeder\Seeder as NewsletterSeeder;
use App\Modules\Management\EventManagement\EventFacilities\Seeder\Seeder as EventFacilitiesSeeder;
use App\Modules\Management\EventManagement\Speakers\Seeder\Seeder as SpeakersSeeder;
use App\Modules\Management\HistoryTimelineManagement\HistoryTimeline\Seeder\Seeder as HistoryTimelineSeeder;
use App\Modules\Management\BannerManagement\Banner\Seeder\Seeder as BannerSeeder;
use App\Modules\Management\PublicCommentManagement\PublicComment\Seeder\Seeder as PublicCommentSeeder;
use App\Modules\Management\WhyChoseUsManagement\WhyChoseUs\Seeder\Seeder as WhyChoseUsSeeder;
use App\Modules\Management\ProjectPlaningManagement\ProjectPlaning\Seeder\Seeder as ProjectPlaningSeeder;
use App\Modules\Management\GetInvolvedManagement\GetInvolved\Seeder\Seeder as GetInvolvedSeeder;
use App\Modules\Management\OurPrinciplesManagement\OurPrinciples\Seeder\Seeder as OurPrinciplesSeeder;
use App\Modules\Management\FaqManagement\Faq\Seeder\Seeder as FaqSeeder;
use App\Modules\Management\ContactUsManagement\ContactPeople\Seeder\Seeder as ContactPeopleSeeder;
use App\Modules\Management\ContributeManagement\Contribute\Seeder\Seeder as ContributeSeeder;
use App\Modules\Management\GalaryManagement\GalleryCategory\Seeder\Seeder as GalleryCategorySeeder;
use App\Modules\Management\ServicesManagement\Services\Seeder\Seeder as ServicesSeeder;
use App\Modules\Management\GalaryManagement\video\Seeder\Seeder as GalleryVideoSeeder;
use App\Modules\Management\DonationDetailsManagement\DonationDetails\Seeder\Seeder as DonationDetailsSeeder;
use App\Modules\Management\AboutUsManagement\AboutUs\Seeder\Seeder as AboutUsSeeder;
use App\Modules\Management\ContactUsManagement\ContactAddress\Seeder\Seeder as ContactAddressSeeder;
use App\Modules\Management\GalaryManagement\Image\Seeder\Seeder as GalleryImageSeeder;
use App\Modules\Management\MediaCoverageManagement\MediaCoverage\Seeder\Seeder as MediaCoverageSeeder;
use App\Modules\Management\MissionVisionManagement\MissionVision\Seeder\Seeder as MissionVisionSeeder;
use App\Modules\Management\NewsManagement\News\Seeder\Seeder as NewsSeeder;
use App\Modules\Management\NewsManagement\NewsCategory\Seeder\Seeder as NewsCategorySeeder;
use App\Modules\Management\OurSpeechesManagement\OurSpeeches\Seeder\Seeder as OurSpeechesSeeder;
use App\Modules\Management\VolunteerManagement\Volunteer\Seeder\Seeder as VolunteerSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            /**
             * User seeder management.
             */
            RoleSeeder::class,
            UserSeeder::class,
            WebsiteSettingsSeeder::class,
            /**
             * Suppliyer seeder management.
             */

            EventSeeder::class,
            JoinEventSeeder::class,
            NewsletterSeeder::class,
            EventFacilitiesSeeder::class,
            SpeakersSeeder::class,
            HistoryTimelineSeeder::class,
            BannerSeeder::class,
            PublicCommentSeeder::class,
            WhyChoseUsSeeder::class,
            ProjectPlaningSeeder::class,
            GetInvolvedSeeder::class,
            OurPrinciplesSeeder::class,
            FaqSeeder::class,
            ContactPeopleSeeder::class,
            ContributeSeeder::class,
            GalleryCategorySeeder::class,
            ServicesSeeder::class,
            GalleryVideoSeeder::class,
            DonationDetailsSeeder::class,
            AboutUsSeeder::class,
            ContactAddressSeeder::class,
            GalleryImageSeeder::class,
            MediaCoverageSeeder::class,
            MissionVisionSeeder::class,
            NewsSeeder::class,
            NewsCategorySeeder::class,
            OurSpeechesSeeder::class,
            VolunteerSeeder::class,
        ]);
    }
}
