//app layout
import Layout from "../Layouts/Layout.vue";
//Dashboard
import Dashboard from "../Management/Dashboard/Dashboard.vue";
//SettingsRoutes
import SettingsRoutes from "../Management/Settings/setup/routes.js";
//UserRoutes
import UserRoutes from "../Management/UserManagement/User/setup/routes.js";
//routes
import SectionHeadingRoutes from '../../../GlobalManagement/SectionHeadingManagement/SectionHeading/setup/routes.js';
import PollOptionRoutes from '../../../GlobalManagement/PollManagement/PollOption/setup/routes.js';
import PollRoutes from '../../../GlobalManagement/PollManagement/Poll/setup/routes.js';
import VolunteerApplicationRoutes from '../../../GlobalManagement/VolunteerManagement/VolunteerApplication/setup/routes.js';
import CounterRoutes from '../../../GlobalManagement/CounterManagement/Counter/setup/routes.js';
import EventRoutes from '../../../GlobalManagement/EventManagement/Event/setup/routes.js';
import AboutUsRoutes from '../../../GlobalManagement/AboutUsManagement/AboutUs/setup/routes.js';
import ContactPeopleRoutes from '../../../GlobalManagement/ContactUsManagement/ContactPeople/setup/routes.js';
import ContactAddressRoutes from '../../../GlobalManagement/ContactUsManagement/ContactAddress/setup/routes.js';
import NewsRoutes from '../../../GlobalManagement/NewsManagement/News/setup/routes.js';
import NewsCategoryRoutes from '../../../GlobalManagement/NewsManagement/NewsCategory/setup/routes.js';
import JoinEventRoutes from '../../../GlobalManagement/EventManagement/JoinEvent/setup/routes.js';
import EventFacilitiesRoutes from '../../../GlobalManagement/EventManagement/EventFacilities/setup/routes.js';
import SpeakersRoutes from '../../../GlobalManagement/EventManagement/Speakers/setup/routes.js';
import FaqRoutes from '../../../GlobalManagement/FaqManagement/Faq/setup/routes.js';
import ProjectPlaningRoutes from '../../../GlobalManagement/ProjectPlaningManagement/ProjectPlaning/setup/routes.js';
import ServicesRoutes from '../../../GlobalManagement/ServicesManagement/Services/setup/routes.js';
import GetInvolvedRoutes from '../../../GlobalManagement/GetInvolvedManagement/GetInvolved/setup/routes.js';
import IssuesRoutes from '../../../GlobalManagement/IssuesManagement/Issues/setup/routes.js';
import videoRoutes from '../../../GlobalManagement/GalaryManagement/video/setup/routes.js';
import ImageRoutes from '../../../GlobalManagement/GalaryManagement/Image/setup/routes.js';
import GalleryCategoryRoutes from '../../../GlobalManagement/GalaryManagement/GalleryCategory/setup/routes.js';
import VolunteerRoutes from '../../../GlobalManagement/VolunteerManagement/Volunteer/setup/routes.js';
import OurSpeechesRoutes from '../../../GlobalManagement/OurSpeechesManagement/OurSpeeches/setup/routes.js';
import OurPrinciplesRoutes from '../../../GlobalManagement/OurPrinciplesManagement/OurPrinciples/setup/routes.js';
import HistoryTimelineRoutes from '../../../GlobalManagement/HistoryTimelineManagement/HistoryTimeline/setup/routes.js';
import OurJourneyRoutes from '../../../GlobalManagement/OurJourneyManagement/OurJourney/setup/routes.js';
import DonationDetailsRoutes from '../../../GlobalManagement/DonationDetailsManagement/DonationDetails/setup/routes.js';
import MissionVisionRoutes from '../../../GlobalManagement/MissionVisionManagement/MissionVision/setup/routes.js';
import PublicCommentRoutes from '../../../GlobalManagement/PublicCommentManagement/PublicComment/setup/routes.js';
import ContributeRoutes from '../../../GlobalManagement/ContributeManagement/Contribute/setup/routes.js';
import MediaCoverageRoutes from '../../../GlobalManagement/MediaCoverageManagement/MediaCoverage/setup/routes.js';
import WhyChoseUsRoutes from '../../../GlobalManagement/WhyChoseUsManagement/WhyChoseUs/setup/routes.js';
import BannerRoutes from '../../../GlobalManagement/BannerManagement/Banner/setup/routes.js';

const routes = {
  path: "",
  component: Layout,
  children: [
    {
      path: "dashboard",
      component: Dashboard,
      name: "adminDashboard",
    },
    //management routes
    SectionHeadingRoutes,
    PollOptionRoutes,
    PollRoutes,
    VolunteerApplicationRoutes,
    CounterRoutes,
    OurJourneyRoutes,
    EventRoutes,
    AboutUsRoutes,
    ContactPeopleRoutes,
    ContactAddressRoutes,
    NewsRoutes,
    NewsCategoryRoutes,
    JoinEventRoutes,
    EventFacilitiesRoutes,
    SpeakersRoutes,
    FaqRoutes,
    ProjectPlaningRoutes,
    ServicesRoutes,
    GetInvolvedRoutes,
    IssuesRoutes,
    videoRoutes,
    ImageRoutes,
    GalleryCategoryRoutes,
    VolunteerRoutes,
    OurSpeechesRoutes,
    OurPrinciplesRoutes,
    HistoryTimelineRoutes,
    OurJourneyRoutes,
    DonationDetailsRoutes,
    MissionVisionRoutes,
    PublicCommentRoutes,
    ContributeRoutes,
    MediaCoverageRoutes,
    WhyChoseUsRoutes,
    BannerRoutes,
    
    //user routes
    UserRoutes,
    //settings
    SettingsRoutes,
  ],
};

export default routes;
