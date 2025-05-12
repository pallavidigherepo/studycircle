import { createRouter, createWebHistory } from 'vue-router'
import Login from '@/views/Auth/login.vue'
import Register from '@/views/Auth/register.vue'
import ForgotPassword from '@/views/Auth/forgot-password.vue'
import Animation from '@/views/Advance-UI/animation.vue'
import Highlight from '@/views/Advance-UI/highlight.vue'
import Scrollbar from '@/views/Advance-UI/scrollbar.vue'
import Scrollspy from '@/views/Advance-UI/scrollspy.vue'
import Sweetalerts from '@/views/Advance-UI/sweetalerts.vue'
import SwiperSlider from '@/views/Advance-UI/swiper.vue'
import Accordions from '@/views/UI/accordions.vue'
import Ribbons from '@/views/UI/ribbons.vue'
import Progress from '@/views/UI/progress.vue'
import Placeholders from '@/views/UI/placeholders.vue'
import Offcanvas from '@/views/UI/offcanvas.vue'
import Notifications from '@/views/UI/notifications.vue'
import Modals from '@/views/UI/modals.vue'
import Media from '@/views/UI/media.vue'
import Lists from '@/views/UI/lists.vue'
import Links from '@/views/UI/links.vue'
import Images from '@/views/UI/images.vue'
import Grid from '@/views/UI/grid.vue'
import General from '@/views/UI/general.vue'
import Embedvideo from '@/views/UI/embed-video.vue'
import Dropdowns from '@/views/UI/dropdowns.vue'
import Colors from '@/views/UI/colors.vue'
import Carousel from '@/views/UI/carousel.vue'
import Cards from '@/views/UI/cards.vue'
import Buttons from '@/views/UI/buttons.vue'
import Badges from '@/views/UI/badges.vue'
import Alerts from '@/views/UI/alerts.vue'
import Typography from '@/views/UI/typography.vue'
import Tabs from '@/views/UI/tabs.vue'
import Utilities from '@/views/UI/utilities.vue'
import FormAdvance from '@/views/Forms/advanced.vue'
import FormElements from '@/views/Forms/elements.vue'
import FormLayouts from '@/views/Forms/layouts.vue'
import FormEditors from '@/views/Forms/editors.vue'
import FileUploads from '@/views/Forms/file-uploads.vue'
import FormValidation from '@/views/Forms/validation.vue'
import FormWizard from '@/views/Forms/wizard.vue'
import FormMask from '@/views/Forms/masks.vue'
import FormPicker from '@/views/Forms/pickers.vue'
import FormRangeSlider from '@/views/Forms/range-sliders.vue'
import FormSelect from '@/views/Forms/select.vue'
import CheckboxsRadios from '@/views/Forms/checkboxs-radios.vue'
import Boxicons from '@/views/Icons/boxicons.vue'
import MaterialDesign from '@/views/Icons/materialdesign.vue'
import Feather from '@/views/Icons/feather.vue'
import LineAwesome from '@/views/Icons/lineawesome.vue'
import Remix from '@/views/Icons/remix.vue'
import Crypto from '@/views/Icons/crypto.vue'
import Starter from '@/views/Pages/starter.vue'
import TermConditions from '@/views/Pages/term-conditions.vue'
import PrivacyPolicy from '@/views/Pages/privacy-policy.vue'
import Sitemap from '@/views/Pages/sitemap.vue'
import SearchResults from '@/views/Pages/search-results.vue'
import Team from '@/views/Pages/team.vue'
import Pricing from '@/views/Pages/pricing.vue'
import FAQs from '@/views/Pages/faqs.vue'
import Timeline from '@/views/Pages/timeline.vue'
import CommingSoon from '@/views/Pages/coming-soon.vue'
import Maintanance from '@/views/Pages/maintenance.vue'
import Setting from '@/views/Pages/profile/setting.vue'
import Profile from '@/views/Pages/profile/simple.vue'
import GridView from '@/views/Pages/blogs/grid-view.vue'
import ListView from '@/views/Pages/blogs/list-view.vue'
import Overview from '@/views/Pages/blogs/overview.vue'
import Dashboard from '@/views/Dashboard/analytics/index.vue'
import CryptoDashboard from '@/views/Dashboard/crypto/index.vue'
import Projects from '@/views/Dashboard/projects/index.vue'
import CRM from '@/views/Dashboard/crm/index.vue'
import NFT from '@/views/Dashboard/nft/index.vue'
import Job from '@/views/Dashboard/job/index.vue'
import Blog from '@/views/Dashboard/blog/index.vue'

const routes = [
  {
    path: "/",
    name: "default",
    meta: {
          title: "Dashboard", authRequired: true,
        },
    component: Dashboard
  },
  {
    path: "/dashboard/crypto",
    name: "dashboard-crypto",
    meta: {
      title: "CryptoDashboard",
      authRequired: true,
    },
    component: CryptoDashboard,
  },
  {
    path: "/dashboard/projects",
    name: "dashboard-projects",
    meta: {
      title: "Projects",
      authRequired: true,
    },
    component: Projects,
  },
  {
    path: "/dashboard/crm",
    name: "dashboard-crm",
    meta: {
      title: "CRM",
      authRequired: true,
    },
    component: CRM,
  },
  {
    path: "/dashboard/nft",
    name: "dashboard-nft",
    meta: {
      title: "NFT Dashboard",
      authRequired: true,
    },
    component: NFT,
  },
  {
    path: "/dashboard/job",
    name: "dashboard-job",
    meta: {
      title: "Job Dashboard",
      authRequired: true,
    },
    component: Job,
  },
  {
    path: "/dashboard/blog",
    name: "dashboard-blog",
    meta: {
      title: "Blog Dashboard",
      authRequired: true,
    },
    component: Blog,
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/register',
    name: 'register',
    component: Register
  },
  {
    path: '/forgot-password',
    name: 'forgot-password',
    component: ForgotPassword
  },
  {
    path: '/animation',
    name: 'animation',
    component: Animation
  },
  {
    path: '/highlight',
    name: 'highlight',
    component: Highlight
  },
  {
    path: '/scrollbar',
    name: 'scrollbar',
    component: Scrollbar
  },
  {
    path: '/scrollspy',
    name: 'scrollspy',
    component: Scrollspy
  },
  {
    path: '/sweetalerts',
    name: 'sweetalerts',
    component: Sweetalerts
  },
  {
    path: '/swiper',
    name: 'Swiper Slider',
    component: SwiperSlider
  },
  {
    path: '/ui/accordions',
    name: 'accordions',
    component: Accordions
  },
  {
    path: '/ui/alerts',
    name: 'alerts',
    component: Alerts
  },
  {
    path: '/ui/badges',
    name: 'badges',
    component: Badges
  },
  {
    path: '/ui/buttons',
    name: 'buttons',
    component: Buttons
  },
  {
    path: '/ui/cards',
    name: 'cards',
    component: Cards
  },
  {
    path: '/ui/carousel',
    name: 'carousel',
    component: Carousel
  },
  {
    path: '/ui/colors',
    name: 'colors',
    component: Colors
  },
  {
    path: '/ui/dropdowns',
    name: 'dropdowns',
    component: Dropdowns
  },
  {
    path: '/ui/embed-video',
    name: 'embed-video',
    component: Embedvideo
  },
  {
    path: '/ui/general',
    name: 'general',
    component: General
  },
  {
    path: '/ui/grid',
    name: 'grid',
    component: Grid
  },
  {
    path: '/ui/images',
    name: 'images',
    component: Images
  },
  {
    path: '/ui/links',
    name: 'links',
    component: Links
  },
  {
    path: '/ui/lists',
    name: 'lists',
    component: Lists
  },
  {
    path: '/ui/media',
    name: 'media',
    component: Media
  },
  {
    path: '/ui/modals',
    name: 'modals',
    component: Modals
  },
  {
    path: '/ui/notifications',
    name: 'notifications',
    component: Notifications
  },
  {
    path: '/ui/offcanvas',
    name: 'offcanvas',
    component: Offcanvas
  },
  {
    path: '/ui/placeholders',
    name: 'placeholders',
    component: Placeholders
  },
  {
    path: '/ui/progress',
    name: 'progress',
    component: Progress
  },
  {
    path: '/ui/ribbons',
    name: 'ribbons',
    component: Ribbons
  },
  {
    path: '/ui/tabs',
    name: 'tabs',
    component: Tabs
  },
  {
    path: '/ui/typography',
    name: 'typography',
    component: Typography
  },
  {
    path: '/ui/utilities',
    name: 'utilities',
    component: Utilities
  },
  {
    path: "/form/advanced",
    name: "formadvanced",
    component: FormAdvance 
  },
  {
    path: "/form/elements",
    name: "formelements",
    component: FormElements
  },
  {
    path: "/form/layouts",
    name: "formlayouts",
    component: FormLayouts
  },
  {
    path: "/form/editors",
    name: "formeditors",
    component: FormEditors
  },
  {
    path: "/form/file-uploads",
    name: "FileUploads",
    component: FileUploads
  },
  {
    path: "/form/validation",
    name: "FormValidation",
    component: FormValidation
  },
  {
    path: "/form/wizard",
    name: "FormWizard",
    component: FormWizard
  },
  {
    path: "/form/masks",
    name: "formmask",
    component: FormMask
  },
  {
    path: "/form/pickers",
    name: "formpickers",
    component: FormPicker
  },
  {
    path: "/form/range-sliders",
    name: "formrangeslider",
    component: FormRangeSlider
  },
  {
    path: "/form/select",
    name: "formselect",
    component: FormSelect
  },
  {
    path: "/form/checkboxs-radios",
    name: "formcheckboxsradio",
    component: CheckboxsRadios
  },
  {
    path: "/icons/boxicons",
    name: "boxiconsicon",
    component: Boxicons
  },
  {
    path: "/icons/materialdesign",
    name: "MaterialDesign",
    component: MaterialDesign
  },
  {
    path: "/icons/feather",
    name: "feather",
    component: Feather
  },
  {
    path: "/icons/lineawesome",
    name: "lineawesome",
    component: LineAwesome
  },
  {
    path: "/icons/remix",
    name: "remix",
    component: Remix
  },
  {
    path: "/icons/crypto",
    name: "crypto",
    component: Crypto
  },
  {
    path: "/pages/starter",
    name: "Starter",
    component: Starter
  },
  {
    path: "/pages/profile",
    name: "Profile",
    component: Profile
  },
  {
    path: "/pages/profile-setting",
    name: "profile-setting",
    component: Setting
  },
  {
    path: "/pages/maintenance",
    name: "Maintanance",
    component: Maintanance
  },
  {
    path: "/pages/coming-soon",
    name: "coming-soon",
    component: CommingSoon
  },
  {
    path: "/pages/timeline",
    name: "timeline",
    component: Timeline
  },
  {
    path: "/pages/faqs",
    name: "FAQs",
    component: FAQs
  },
  {
    path: "/pages/pricing",
    name: "pricing",
    component: Pricing
  },
  {
    path: "/pages/team",
    name: "team",
    component: Team
  },
  {
    path: "/pages/search-results",
    name: "search-results",
    component: SearchResults
  },
  {
    path: "/pages/sitemap",
    name: "sitemap",
    component: Sitemap
  },
  {
    path: "/pages/privacy-policy",
    name: "privacy-policy",
    component: PrivacyPolicy
  },
  {
    path: "/pages/term-conditions",
    name: "term-conditions",
    component: TermConditions
  },
  {
    path: "/blogs/list-view",
    name: "List View",
    component: ListView
  },
  {
    path: "/blogs/grid-view",
    name: "grid-view",
    component: GridView
  },
  {
    path: "/blogs/overview",
    name: "overview",
    component: Overview
  },
  
];
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
  linkActiveClass: "active",
  linkExactActiveClass: "exact-active",
  scrollBehavior(to, from, savedPosition) {
    return savedPosition || { left: 0, top: 0 }
  }
})

export default router;