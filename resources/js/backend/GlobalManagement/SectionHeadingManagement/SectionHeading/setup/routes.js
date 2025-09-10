import setup from ".";
import All from "../pages/All.vue";
import Form from "../pages/Form.vue";
import Details from "../pages/Details.vue";
import Layout from "../pages/Layout.vue";
//---------page wise heading------------
import HomePage from "../pages/HomePage.vue";
import AboutUsPage from "../pages/AboutUsPage.vue";
import DonationPage from "../pages/DonationPage.vue";
import HistoryPage from "../pages/HistoryPage.vue";
import PrinciplesPage from "../pages/PrinciplesPage.vue";
import TeamPage from "../pages/TeamPage.vue";
import GalleryPage from "../pages/GalleryPage.vue";
import MediaPage from "../pages/MediaPage.vue";
import IssuesPage from "../pages/IssuesPage.vue";
import VolunteerPage from "../pages/VolunteerPage.vue";
import ServicesPage from "../pages/ServicesPage.vue";
import ServicesDetailsPage from "../pages/ServicesDetailsPage.vue";
import FaqPage from "../pages/FaqPage.vue";
import EventPage from "../pages/EventPage.vue";
import EventDetailsPage from "../pages/EventDetailsPage.vue";
import NewsPage from "../pages/NewsPage.vue";
import NewsDetailsPage from "../pages/NewsDetailsPage.vue";
import ContactUsPage from "../pages/ContactUsPage.vue";



let route_prefix = setup.route_prefix;
let route_path = setup.route_path;

const routes = {
    path: route_path,
    component: Layout,
    children: [
        {
            path: "all",
            name: "All" + route_prefix,
            component: All,
        },
        {
            path: "create",
            name: "Create" + route_prefix,
            component: Form,
        },
        {
            path: "details/:id",
            name: "Details" + route_prefix,
            component: Details,
        },
        {
            path: "edit/:id",
            name: "Edit" + route_prefix,
            component: Form,
        },
        //---------page wise heading------------
        {
            path: "home-page",
            name: "HomePage" + route_prefix,
            component: HomePage,
        },
        {
            path: "about-us",
            name: "AboutUsPage" + route_prefix,
            component: AboutUsPage,
        },
        {
            path: "donation",
            name: "DonationPage" + route_prefix,
            component: DonationPage,
        },
        {
            path: "history",
            name: "HistoryPage" + route_prefix,
            component: HistoryPage,
        },
        {
            path: "principles",
            name: "PrinciplesPage" + route_prefix,
            component: PrinciplesPage,
        },
        {
            path: "team",
            name: "TeamPage" + route_prefix,
            component: TeamPage,
        },
        {
            path: "media",
            name: "MediaPage" + route_prefix,
            component: MediaPage,
        },
        {
            path: "gallery",
            name: "GalleryPage" + route_prefix,
            component: GalleryPage,
        },
        {
            path: "issues",
            name: "IssuesPage" + route_prefix,
            component: IssuesPage,
        },
        {
            path: "volunteer",
            name: "VolunteerPage" + route_prefix,
            component: VolunteerPage,
        },
        {
            path: "services",
            name: "ServicesPage" + route_prefix,
            component: ServicesPage,
        },
        {
            path: "services-details",
            name: "ServicesDetailsPage" + route_prefix,
            component: ServicesDetailsPage,
        },
        {
            path: "faq",
            name: "FaqPage" + route_prefix,
            component: FaqPage,
        },
        {
            path: "event",
            name: "EventPage" + route_prefix,
            component: EventPage,
        },
        {
            path: "event-details",
            name: "EventDetailsPage" + route_prefix,
            component: EventDetailsPage,
        },
        {
            path: "news",
            name: "NewsPage" + route_prefix,
            component: NewsPage,
        },
        {
            path: "news-details",
            name: "NewsDetailsPage" + route_prefix,
            component: NewsDetailsPage,
        },
        {
            path: "contact-us",
            name: "ContactUsPage" + route_prefix,
            component: ContactUsPage,
        },


    ],
};

export default routes;

