import Vue from 'vue';
import Router from 'vue-router';

/**
 * Layzloading will create many files and slow on compiling, so best not to use lazyloading on devlopment.
 * The syntax is lazyloading, but we convert to proper require() with babel-plugin-syntax-dynamic-import
 * @see https://doc.laravue.dev/guide/advanced/lazy-loading.html
 */

Vue.use(Router);

/* Layout */
import Layout from '@/layout';

/* Router for modules */
// import elementUiRoutes from './modules/element-ui';
// import componentRoutes from './modules/components';
// import chartsRoutes from './modules/charts';
// import tableRoutes from './modules/table';
// import adminRoutes from './modules/admin';
// import nestedRoutes from './modules/nested';
import errorRoutes from './modules/error';
// import excelRoutes from './modules/excel';
// import permissionRoutes from './modules/permission';

/**
 * Sub-menu only appear when children.length>=1
 * @see https://doc.laravue.dev/guide/essentials/router-and-nav.html
 **/

/**
* hidden: true                   if `hidden:true` will not show in the sidebar(default is false)
* alwaysShow: true               if set true, will always show the root menu, whatever its child routes length
*                                if not set alwaysShow, only more than one route under the children
*                                it will becomes nested mode, otherwise not show the root menu
* redirect: noredirect           if `redirect:noredirect` will no redirect in the breadcrumb
* name:'router-name'             the name is used by <keep-alive> (must set!!!)
* meta : {
    roles: ['admin', 'editor']   Visible for these roles only
    permissions: ['view menu zip', 'manage user'] Visible for these permissions only
    title: 'title'               the name show in sub-menu and breadcrumb (recommend set)
    icon: 'svg-name'             the icon show in the sidebar
    noCache: true                if true, the page will no be cached(default is false)
    breadcrumb: false            if false, the item will hidden in breadcrumb (default is true)
    affix: true                  if true, the tag will affix in the tags-view
  }
**/

export const constantRoutes = [
  {
    path: '/redirect',
    component: Layout,
    hidden: true,
    children: [
      {
        path: '/redirect/:path*',
        component: () => import('@/views/redirect/index'),
      },
    ],
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('@/views/login/index'),
    hidden: true,
  },
  {
    path: '/Forgot-pass',
    //    redirect: '/forgot-pass',
    name: 'Forgot',
    component: () => import('@/views/RestPass/index'),
    hidden: true,
  },
  {
    path: '/rest-password',
    name: 'restpass',
    component: () => import('@/views/RestPass/reste'),
    hidden: true,
  },
  {
    path: '/Contact',
    name: 'Contact',
    component: () => import('@/views/contact/index'),
    hidden: true,
  },
  {
    path: '/auth-redirect',
    name: 'authredName',
    component: () => import('@/views/login/AuthRedirect'),
    hidden: true,
  },
  {
    path: '/404',

    component: () => import('@/views/error-page/404'),
    hidden: true,
  },
  {
    path: '/401',
    component: () => import('@/views/error-page/401'),
    hidden: true,
  },
  {
    path: '',
    component: Layout,
    redirect: 'dashboard',
    children: [
      {
        path: 'dashboard',
        component: () => import('@/views/dashboard/index'),
        name: 'Dashboard',
        meta: { title: 'dashboard', icon: 'dashboard', noCache: true },
      },
    ],
  },
  /* {
    path: '/documentation',
    component: Layout,
    redirect: '/documentation/index',
    children: [
      {
        path: 'index',
        component: () => import('@/views/documentation/index'),
        name: 'Documentation',
        meta: { title: 'documentation', icon: 'documentation', noCache: true },
      },
    ],
  },
  {
    path: '/documentation',
    component: Layout,
    redirect: '/documentation/index',
    children: [
      {
        path: 'index',
        component: () => import('@/views/documentation/index'),
        name: 'Documentation',
        meta: { title: 'documentation', icon: 'documentation', noCache: true },
      },
    ],
  }, */
  /* {
    path: '/profile',
    component: Layout,
    redirect: '/profile/edit',
    children: [
      {
        path: 'edit',
        component: () => import('@/views/users/SelfProfile'),
        name: 'SelfProfile',
        meta: { title: 'userProfile', icon: 'user', noCache: true },
      },
    ],
  },*/
  // sujet
  {
    path: '/sujets',
    component: Layout,
    redirect: '/sujets/index',
    children: [
      {
        path: '/sujets',
        component: () => import('@/views/management/sujet/index'),
        name: 'sujets',
        meta: { title: 'Vaches', icon: 'cowFace', noCache: true },
      },
      {
        path: '/View',
        component: () => import('@/views/management/sujet/View'),
        name: 'View',
        meta: { title: 'View', icon: 'cowSujet', noCache: true },
        hidden: true,
      },
        // pdf generator for mobile

      {
        path: '/mobilePdf',
        component: () => import('@/views/management/sujet/mobilePdf'),
        name: 'mobile',
        meta: { title: 'mobile', noCache: true },
         hidden: true,
      },
    ],
  },
  {
    path: '/Naisseurs',
    component: Layout,
    redirect: '/Naisseurs/index',
    children: [
      {
        path: '/Naisseurs',
        component: () => import('@/views/management/Naisseur/index'),
        name: 'Naisseur',
        meta: { title: 'Naisseur', icon: 'Farmer', noCache: true },
      },
    ],
  },
  {
    path: '/Proprietaires',
    component: Layout,
    redirect: '/Proprietaires/index',
    children: [
      {
        path: '/Proprietaires',
        component: () => import('@/views/management/Proprietaires/index'),
        name: 'Proprietaires',
        meta: { title: 'Proprietaires', icon: 'Proprietaires', noCache: true },
      },
    ],
  },


  // {
  //   path: '/IA',
  //   component: Layout,
  //   name: 'IA',
  //   redirect: '/admin/IA',
  //   meta: { title: 'Proprietaire', icon: 'plus', noCache: true },
  //   children: [
  //     {
  //       path: 'Saisie',
  //       component: () => import('@/views/management/eleveurnaisseurs/index'),
  //       name: 'Saisie',
  //       meta: { title: 'Saisie', icon: '', noCache: true },
  //     },
  //     {
  //       path: 'Calendrier',
  //       component: () => import('@/views/management/eleveurnaisseurs/Create'),
  //       name: 'Calendrier',
  //       meta: { title: 'Calendrier', icon: '', noCache: true },
  //     },
  //   ],
  // },
  // {
  //   path: '/Pro laitiere',
  //   component: Layout,
  //   redirect: '#',
  //   children: [
  //     {
  //       path: '/Prolaitiere',
  //       component: () => import('@/views/management/sujet/index'),
  //       name: 'Prolaitiere',
  //       meta: { title: 'Production ', icon: 'plus', noCache: true },
  //     },
  //   ],
  // },
  // {
  //   path: '/eleveur',
  //   component: Layout,
  //   redirect: '#',
  //   children: [
  //     {
  //       path: '/eleveur',
  //       component: () => import('@/views/management/sujet/index'),
  //       name: 'eleveur',
  //       meta: { title: 'historique', icon: 'plus', noCache: true },
  //     },
  //   ],
  // },

  /* {
    path: '/eleveurnaisseurs',
    component: Layout,
    name: 'eleveurnaisseurs',
    redirect: '/management/eleveurnaisseurs',
    meta: { title: 'eleveurnaisseurs', icon: 'admin', noCache: true },
    children: [
      {
        path: 'index',
        component: () => import('@/views/management/eleveurnaisseurs/index'),
        name: 'eleveurnaisseursindex',
        meta: { title: 'index', icon: 'table', noCache: true },
      },
      {
        path: 'create',
        component: () => import('@/views/management/eleveurnaisseurs/Create'),
        name: 'create',
        meta: { title: 'create', icon: 'plus', noCache: true },
      },
    ],
  },*/
  /* {
    path: '/guide',
    component: Layout,
    redirect: '/guide/index',
    children: [
      {
        path: 'index',
        component: () => import('@/views/guide/index'),
        name: 'Guide',
        meta: { title: 'guide', icon: 'guide', noCache: true },
      },
    ],
  },*/
  // elementUiRoutes,
];

export const asyncRoutes = [
  // permissionRoutes,
  //errorRoutes,
  // componentRoutes,
  // chartsRoutes,
  // nestedRoutes,
  // tableRoutes,
  // adminRoutes,
  /* {
    path: '/theme',
    component: Layout,
    redirect: 'noredirect',
    children: [
      {
        path: 'index',
        component: () => import('@/views/theme/index'),
        name: 'Theme',
        meta: { title: 'theme', icon: 'theme' },
      },
    ],
  },
  {
    path: '/clipboard',
    component: Layout,
    redirect: 'noredirect',
    meta: { permissions: ['view menu clipboard'] },
    children: [
      {
        path: 'index',
        component: () => import('@/views/clipboard/index'),
        name: 'ClipboardDemo',
        meta: { title: 'clipboardDemo', icon: 'clipboard', roles: ['admin', 'manager', 'editor', 'user'] },
      },
    ],
  },*/

  // excelRoutes,
  /* {
    path: '/zip',
    component: Layout,
    redirect: '/zip/download',
    alwaysShow: true,
    meta: { title: 'zip', icon: 'zip', permissions: ['view menu zip'] },
    children: [
      {
        path: 'download',
        component: () => import('@/views/zip'),
        name: 'ExportZip',
        meta: { title: 'exportZip' },
      },
    ],
  },
  {
    path: '/pdf',
    component: Layout,
    redirect: '/pdf/index',
    meta: { title: 'pdf', icon: 'pdf', permissions: ['view menu pdf'] },
    children: [
      {
        path: 'index',
        component: () => import('@/views/pdf'),
        name: 'Pdf',
        meta: { title: 'pdf' },
      },
    ],
  },
  {
    path: '/pdf/download',
    component: () => import('@/views/pdf/Download'),
    hidden: true,
  },
  {
    path: '/i18n',
    component: Layout,
    meta: { permissions: ['view menu i18n'] },
    children: [
      {
        path: 'index',
        component: () => import('@/views/i18n'),
        name: 'I18n',
        meta: { title: 'i18n', icon: 'international' },
      },
    ],
  },
  {
    path: '/external-link',
    component: Layout,
    children: [
      {
        path: 'https://github.com/tuandm/laravue',
        meta: { title: 'externalLink', icon: 'link' },
      },
    ],
  },*/
  {
    path: '/external-link',
    component: Layout,
    children: [
      {
        path: 'https://ajicod.com',
        meta: { title: 'AJICOD', icon: 'copyrightIcon' },
      },
    ],
  },
  { path: '*', redirect: '/404', hidden: true },
];

const createRouter = () =>
  new Router({
    // mode: 'history', // require service support
    scrollBehavior: () => ({ y: 0 }),
    base: process.env.MIX_LARAVUE_PATH,
    routes: constantRoutes,
  });

const router = createRouter();

// Detail see: https://github.com/vuejs/vue-router/issues/1234#issuecomment-357941465
export function resetRouter() {
  const newRouter = createRouter();
  router.matcher = newRouter.matcher; // reset router
}

export default router;
