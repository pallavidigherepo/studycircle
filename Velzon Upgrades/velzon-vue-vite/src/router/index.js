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
import Chat from '@/views/Apps/chat.vue'
import FileManager from '@/views/Apps/filemanager.vue'
import ToDoList from '@/views/Apps/todo.vue'
import APIKey from '@/views/Apps/apikey.vue'

import Mailbox from '@/views/Apps/email/mailbox.vue'
import BasicAction from '@/views/Apps/email/email-basic.vue'
import EcommerceAction from '@/views/Apps/email/email-ecommerce.vue'
import LiveAuction from '@/views/Apps/nft/nft-auction.vue'

import Collactions from '@/views/Apps/nft/nft-collection.vue'
import Create from '@/views/Apps/nft/nft-create.vue'
import Creators from '@/views/Apps/nft/nft-creators.vue'
import ExploreNow from '@/views/Apps/nft/nft-explore.vue'
import ItemDetail from '@/views/Apps/nft/nft-item-detail.vue'
import Marketplace from '@/views/Apps/nft/nft-marketplace.vue'
import Ranking from '@/views/Apps/nft/nft-ranking.vue'
import Wallet from '@/views/Apps/nft/nft-wallet.vue'

import ProjectsList from '@/views/Apps/projects/list.vue'
import ProjectsOverview from '@/views/Apps/projects/overview.vue'
import ProjectsCreate from '@/views/Apps/projects/create.vue'

import TasksDetails from '@/views/Apps/tasks/details.vue'
import TasksKanban from '@/views/Apps/tasks/kanban.vue'
import TasksList from '@/views/Apps/tasks/list-view.vue'

import CRMContacts from '@/views/Apps/crm/contacts.vue'
import CRMcompanies from '@/views/Apps/crm/companies.vue'
import CRMDeals from '@/views/Apps/crm/deals.vue'
import CRMLeads from '@/views/Apps/crm/leads.vue'

import Customers from '@/views/Apps/ecommerce/customers.vue'
import Products from '@/views/Apps/ecommerce/products.vue'
import ProductDetails from '@/views/Apps/ecommerce/product-details.vue'
import Orders from '@/views/Apps/ecommerce/orders.vue'
import OrderDetails from '@/views/Apps/ecommerce/order-details.vue'
import CreateProduct from '@/views/Apps/ecommerce/add-product.vue'
import ShoppingCart from '@/views/Apps/ecommerce/shopping-cart.vue'
import CheckOut from '@/views/Apps/ecommerce/checkout.vue'
import Sellers from '@/views/Apps/ecommerce/sellers.vue'
import SellerDetails from '@/views/Apps/ecommerce/seller-details.vue'

import BuySell from '@/views/Apps/crypto/buy-sell.vue'
import KYCApplication from '@/views/Apps/crypto/kyc.vue'
import ICOList from '@/views/Apps/crypto/ico.vue'
import CryptoOrders from '@/views/Apps/crypto/orders.vue'
import MyWallet from '@/views/Apps/crypto/wallet.vue'
import Transactions from '@/views/Apps/crypto/transactions.vue'

import InvoiceDetails from '@/views/Apps/invoices/details.vue'
import InvoiceList from '@/views/Apps/invoices/list.vue'
import CreateInvoice from '@/views/Apps/invoices/create.vue'

import JobApplication from '@/views/Apps/jobs/application.vue'
import CandidateGrid from '@/views/Apps/jobs/candidate-grid.vue'
import CandidateLists from '@/views/Apps/jobs/candidate-lists.vue'
import JobCategories from '@/views/Apps/jobs/categories.vue'
import CompaniesList from '@/views/Apps/jobs/companies-list.vue'
import JobDetails from '@/views/Apps/jobs/details.vue'
import GridLists from '@/views/Apps/jobs/grid-lists.vue'
import JobLists from '@/views/Apps/jobs/lists.vue'
import NewJob from '@/views/Apps/jobs/new.vue'
import JobStatistics from '@/views/Apps/jobs/statistics.vue'



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
    path: "/chat",
    name: "chat",
    meta: { title: "Chat", authRequired: true },
    component: Chat
  },
  {
    path: "/apps-file-manager",
    name: "file manager",
    meta: { title: "File Manager", authRequired: true },
    component: FileManager
  },
  {
    path: "/apps-todo",
    name: "To Do List",
    meta: { title: "To Do List", authRequired: true },
    component: ToDoList
  },
  {
    path: "/mailbox",
    name: "mailbox",
    meta: { title: "Mailbox", authRequired: true },
    component: Mailbox
  },
  {
    path: "/email/email-basic",
    name: "email-basic",
    meta: { title: "Basic Action", authRequired: true },
    component: BasicAction
  },
  {
    path: "/email/email-ecommerce",
    name: "email-ecommerce",
    meta: { title: "Ecommerce Action", authRequired: true },
    component: EcommerceAction
  },
  {
    path: "/apps/nft-auction",
    name: "auction",
    meta: { title: "Live Auction", authRequired: true },
    component: LiveAuction
  },
  {
    path: "/apps/nft-collection",
    name: "collection",
    meta: { title: "Collactions", authRequired: true },
    component: Collactions
  },
  {
    path: "/apps/nft-create",
    name: "create",
    meta: { title: "Create", authRequired: true },
    component: Create 
  },
  {
    path: "/apps/nft-creators",
    name: "creators",
    meta: { title: "Creators", authRequired: true },
    component: Creators
  },
  {
    path: "/apps/nft-explore",
    name: "explore",
    meta: { title: "Explore Now", authRequired: true },
    component: ExploreNow 
  },
  {
    path: "/apps/nft-item-detail",
    name: "item-detail",
    meta: { title: "Item Detail", authRequired: true },
    component: ItemDetail
  },
  {
    path: "/apps/nft-marketplace",
    name: "marketplace",
    meta: { title: "Marketplace", authRequired: true },
    component: Marketplace
  },
  {
    path: "/apps/nft-ranking",
    name: "ranking",
    meta: { title: "Ranking", authRequired: true },
    component: Ranking
  },
  {
    path: "/apps/nft-wallet",
    name: "nft-wallet",
    meta: { title: "Wallet", authRequired: true },
    component: Wallet
  },
  {
    path: "/apps/projects-list",
    name: "projects-list",
    meta: { title: "Projects List", authRequired: true },
    component: ProjectsList
  },
  {
    path: "/apps/projects-overview",
    name: "projects Overview",
    meta: { title: "Projects Overview", authRequired: true },
    component: ProjectsOverview
  },
  {
    path: "/apps/projects-create",
    name: "projects-create",
    meta: { title: "Projects Create", authRequired: true },
    component: ProjectsCreate
  },
  {
    path: "/apps/tasks-details",
    name: "tasks-details",
    meta: { title: "Tasks Details", authRequired: true },
    component: TasksDetails
  },
  {
    path: "/apps/tasks-kanban",
    name: "tasks-kanban",
    meta: { title: "Tasks Kanban", authRequired: true },
    component: TasksKanban
  },
  {
    path: "/apps/tasks-list-view",
    name: "tasks-list-view",
    meta: { title: "Tasks List", authRequired: true },
    component: TasksList
  },
  // {
  //   path: "/apps/tickets-details",
  //   name: "tickets-details",
  //   meta: { title: "Ticket Details", authRequired: true },
  //   component: () => import("../views/tickets/details"),
  // },
  // {
  //   path: "/apps/tickets-list",
  //   name: "tickets-list",
  //   meta: { title: "Tickets List", authRequired: true },
  //   component: () => import("../views/tickets/list"),
  // },
  {
    path: "/apps/crm-contacts",
    name: "crm-contacts",
    meta: { title: "CRM Contacts", authRequired: true },
    component: CRMContacts
  },
  {
    path: "/apps/crm-companies",
    name: "crm-companies",
    meta: { title: "CRM companies", authRequired: true },
    component: CRMcompanies
  },
  {
    path: "/apps/crm-deals",
    name: "crm-deals",
    meta: { title: "CRM Deals", authRequired: true },
    component: CRMDeals
  },
  {
    path: "/apps/crm-leads",
    name: "crm-leads",
    meta: { title: "CRM Leads", authRequired: true },
    component: CRMLeads
  },
  {
    path: "/ecommerce/customers",
    name: "customers",
    meta: { title: "Customers", authRequired: true },
    component: Customers
  },
  {
    path: "/ecommerce/products",
    name: "products",
    meta: { title: "Products", authRequired: true },
    component: Products
  },
  {
    path: "/ecommerce/product-details",
    name: "product-detail",
    meta: { title: "Product Details", authRequired: true },
    component: ProductDetails
  },
  {
    path: "/ecommerce/orders",
    name: "orders",
    meta: { title: "Orders", authRequired: true },
    component: Orders
  },
  {
    path: "/ecommerce/order-details",
    name: "order-details",
    meta: { title: "Order Details", authRequired: true },
    component: OrderDetails
  },
  {
    path: "/ecommerce/add-product",
    name: "add-product",
    meta: { title: "Create Product", authRequired: true },
    component: CreateProduct
  },
  {
    path: "/ecommerce/shopping-cart",
    name: "shopping cart",
    meta: { title: "Shopping Cart", authRequired: true },
    component: ShoppingCart
  },
  {
    path: "/ecommerce/checkout",
    name: "checkout",
    meta: { title: "Check Out", authRequired: true },
    component: CheckOut
  },
  {
    path: "/ecommerce/sellers",
    name: "sellers",
    meta: { title: "Sellers", authRequired: true },
    component: Sellers
  },
  {
    path: "/ecommerce/seller-details",
    name: "seller-details",
    meta: { title: "Seller Details", authRequired: true },
    component: SellerDetails
  },
  {
    path: "/crypto/buy-sell",
    name: "buy/sell",
    meta: { title: "Buy & Sell", authRequired: true },
    component: BuySell
  },
  {
    path: "/crypto/kyc",
    name: "kyc",
    meta: { title: "KYC Application", authRequired: true },
    component: KYCApplication
  },
  {
    path: "/crypto/ico",
    name: "ico",
    meta: { title: "ICO List", authRequired: true },
    component: ICOList
  },
  {
    path: "/crypto/orders",
    name: "crypto-orders",
    meta: { title: "Orders", authRequired: true },
    component: CryptoOrders
  },
  {
    path: "/crypto/wallet",
    name: "wallet",
    meta: { title: "My Wallet", authRequired: true },
    component: MyWallet
  },
  {
    path: "/crypto/transactions",
    name: "transactions",
    meta: { title: "Transactions", authRequired: true },
    component: Transactions
  },
  {
    path: "/invoices/detail/:id?",
    name: "invoice-detail",
    meta: { title: "Invoice Details", authRequired: true },
    component: InvoiceDetails
  },
  {
    path: "/invoices/list",
    name: "invoice-list",
    meta: { title: "Invoice List", authRequired: true },
    component: InvoiceList
  },
  {
    path: "/invoices/create",
    name: "invoice-create",
    meta: { title: "Create Invoice", authRequired: true },
    component: CreateInvoice
  },
  {
    path: "/jobs/application",
    name: "job-application",
    meta: { title: "Job Application", authRequired: true },
    component: JobApplication
  },
  {
    path: "/jobs/candidate-grid",
    name: "job-candidate-grid",
    meta: { title: "Candidate Grid", authRequired: true },
    component: CandidateGrid
  },
  {
    path: "/jobs/candidate-lists",
    name: "job-candidate-lists",
    meta: { title: "Candidate Lists", authRequired: true },
    component: CandidateLists
  },
  {
    path: "/jobs/categories",
    name: "job-categories",
    meta: { title: "Job Categories", authRequired: true },
    component: JobCategories
  },
  {
    path: "/jobs/companies-list",
    name: "job-companies-list",
    meta: { title: "Companies List", authRequired: true },
    component: CompaniesList
  },
  {
    path: "/jobs/details",
    name: "job-details",
    meta: { title: "Job Details", authRequired: true },
    component: JobDetails
  },
  {
    path: "/jobs/grid-lists",
    name: "job-grid-lists",
    meta: { title: "Grid Lists", authRequired: true },
    component: GridLists
  },
  {
    path: "/jobs/lists",
    name: "job-lists",
    meta: { title: "Job Lists", authRequired: true },
    component: JobLists
  },
  {
    path: "/jobs/new",
    name: "job-new",
    meta: { title: "New Job", authRequired: true },
    component: NewJob
  },
  {
    path: "/jobs/statistics",
    name: "job-statistics",
    meta: { title: "Job Statistics", authRequired: true },
    component: JobStatistics
  },
  {
    path: "/apps-api-key",
    name: "API Key",
    meta: { title: "API Key", authRequired: true },
    component: APIKey
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