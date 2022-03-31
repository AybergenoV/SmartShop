@php
use App\Models\Profit;
@endphp
<!DOCTYPE html>
<html lang="en">
   <!--begin::Head-->
   <head>
      <title>@yield('title')</title>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <!--begin::Fonts-->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
      <!--end::Fonts-->
      <!--begin::Page Vendor Stylesheets(used by this page)-->
      @yield('style')
      <!--end::Page Vendor Stylesheets-->
      <!--begin::Global Stylesheets Bundle(used by all pages)-->
      <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
      <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
      <!--end::Global Stylesheets Bundle-->
      <livewire:styles />
   </head>
   <!--end::Head-->
   <!--begin::Body-->
   <body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
      <!--begin::Main-->
      <!--begin::Root-->
      <div class="d-flex flex-column flex-root">
         <!--begin::Page-->
         <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Aside-->
            <div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
               <!--begin::Brand-->
               <div class="aside-logo flex-column-auto" id="kt_aside_logo">
                  <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
                     <!--begin::Svg Icon | path: icons/duotune/arrows/arr074.svg-->
                     <span class="svg-icon svg-icon-1 rotate-180">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                           <path d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z" fill="black" />
                        </svg>
                     </span>
                     <!--end::Svg Icon-->
                  </div>
                  <!--end::Aside toggler-->
               </div>
               <!--end::Brand-->
               <!--begin::Aside menu-->
               <div class="aside-menu flex-column-fluid">
                  <!--begin::Aside Menu-->
                  <div class="hover-scroll-overlay-y my-2 py-5 py-lg-8" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
                     <!--begin::Menu-->
                     <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
                        <div class="menu-item">
                           <div class="menu-content pb-2">
                              <span class="menu-section text-muted text-uppercase fs-8 ls-1">{{__('messages.general')}}</span>
                           </div>
                        </div>
                        <div class="menu-item">
                           <a class="menu-link @if(url()->current() == route('web.index')) active @endif" href="{{route('web.index')}}">
                           <span class="menu-icon">
                           <i class="bi bi-grid fs-3"></i>
                           </span>
                           <span class="menu-title">{{__('messages.main')}}</span>
                           </a>
                        </div>
                        <div class="menu-item">
                           <div class="menu-content pt-8 pb-0">
                              <span class="menu-section text-muted text-uppercase fs-8 ls-1">{{__('messages.menu')}}</span>
                           </div>
                        </div>
                        <div class="menu-item">
                           <a class="menu-link @if(url()->current() == route('web.categories')) active @endif" href="{{route('web.categories')}}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                           <span class="menu-icon">
                           <i class="bi bi-layers fs-3"></i>
                           </span>
                           <span class="menu-title">{{__('messages.categories')}}</span>
                           </a>
                        </div>
                        <div class="menu-item">
                           <a class="menu-link @if(url()->current() == route('web.products')) active @endif" href="{{route('web.products')}}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                           <span class="menu-icon">
                           <i class="bi bi-layers fs-3"></i>
                           </span>
                           <span class="menu-title">{{__('messages.products')}}</span>
                           </a>
                        </div>
                        <div class="menu-item">
                           <a class="menu-link @if(url()->current() == route('web.clients')) active @endif" href="{{route('web.clients')}}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                           <span class="menu-icon">
                           <i class="bi bi-people fs-3"></i>
                           </span>
                           <span class="menu-title">{{__('messages.clients')}}</span>
                           </a>
                        </div>
                        <div class="menu-item">
                           <a class="menu-link @if(url()->current() == route('web.orders')) active @endif" href="{{route('web.orders')}}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                           <span class="menu-icon">
                           <i class="bi bi-people fs-3"></i>
                           </span>
                           <span class="menu-title">{{__('messages.sales')}}</span>
                           </a>
                        </div>
                        {{-- <div class="menu-item">
                           <a class="menu-link @if(url()->current() == route('web.transaction')) active @endif" href="{{route('web.transaction')}}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                           <span class="menu-icon">
                           <i class="bi bi-people fs-3"></i>
                           </span>
                           <span class="menu-title">{{__('messages.transactions')}}</span>
                           </a>
                        </div> --}}
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                            <span class="menu-link">
                            <span class="menu-icon">
                            <i class="bi bi-layout-sidebar fs-3"></i>
                            </span>
                            <span class="menu-title">{{__('messages.transactions')}}</span>
                            <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                               <div class="menu-item">
                                  <a class="menu-link" href="{{route('web.transaction')}}">
                                  <span class="menu-bullet">
                                  <span class="bullet bullet-dot"></span>
                                  </span>
                                  <span class="menu-title">{{__('messages.clients')}}</span>
                                  </a>
                               </div>
                            </div>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                <div class="menu-item">
                                   <a class="menu-link" href="{{route('defect.show')}}">
                                   <span class="menu-bullet">
                                   <span class="bullet bullet-dot"></span>
                                   </span>
                                   <span class="menu-title">{{__('messages.defective_products')}}</span>
                                   </a>
                                </div>
                            </div>
                         </div>
                        <div class="menu-item">
                           <a class="menu-link @if(url()->current() == route('web.admin')) active @endif" href="{{route('web.admin')}}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                           <span class="menu-icon">
                           <i class="bi bi-people fs-3"></i>
                           </span>
                           <span class="menu-title">{{__('messages.new_seller')}}</span>
                           </a>
                        </div>
                        <div class="menu-item">
                           <a class="menu-link @if(url()->current() == route('web.consumption')) active @endif" href="{{route('web.consumption')}}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                           <span class="menu-icon">
                           <i class="bi bi-people fs-3"></i>
                           </span>
                           <span class="menu-title">{{__('messages.costs')}}</span>
                           </a>
                        </div>
                        <div class="menu-item">
                           <a class="menu-link @if(url()->current() == route('web.income')) active @endif" href="{{route('web.income')}}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                           <span class="menu-icon">
                           <i class="bi bi-people fs-3"></i>
                           </span>
                           <span class="menu-title">{{__('messages.income')}}</span>
                           </a>
                        </div>
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                           <span class="menu-link">
                           <span class="menu-icon">
                           <i class="bi bi-layout-sidebar fs-3"></i>
                           </span>
                           <span class="menu-title">{{__('messages.warehouse')}}</span>
                           <span class="menu-arrow"></span>
                           </span>
                           <div class="menu-sub menu-sub-accordion menu-active-bg">
                              <div class="menu-item">
                                 <a class="menu-link" href="{{route('web.warehouse')}}">
                                 <span class="menu-bullet">
                                 <span class="bullet bullet-dot"></span>
                                 </span>
                                 <span class="menu-title">{{__('messages.warehouse')}}</span>
                                 </a>
                              </div>
                              <div class="menu-item">
                                 <a class="menu-link" href="{{route('web.warehouse.few')}}">
                                 <span class="menu-bullet">
                                 <span class="bullet bullet-dot"></span>
                                 </span>
                                 <span class="menu-title">{{__('messages.little_remaining_goods')}}</span>
                                 </a>
                              </div>
                              <div class="menu-item">
                                 <a class="menu-link" href="{{route('web.warehouse.add')}}">
                                 <span class="menu-bullet">
                                 <span class="bullet bullet-dot"></span>
                                 </span>
                                 <span class="menu-title">{{__('messages.transaction')}}</span>
                                 </a>
                              </div>
                              <div class="menu-item">
                                 <a class="menu-link" href="{{route('web.warehouse.min')}}">
                                 <span class="menu-bullet">
                                 <span class="bullet bullet-dot"></span>
                                 </span>
                                 <span class="menu-title">{{__('messages.revert_transaction')}}</span>
                                 </a>
                              </div>
                              <div class="menu-item">
                                <a class="menu-link" href="{{route('web.warehouse.defect')}}">
                                <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{__('messages.defect')}}</span>
                                </a>
                             </div>
                           </div>
                        </div>
                        <div class="menu-item">
                           <div class="menu-content">
                              <div class="separator mx-1 my-4"></div>
                           </div>
                        </div>
                        <div class="menu-item">
                            <span class="menu-icon">
                                <a class="menu-link" href="{{route('logout')}}">
                                    <span class="menu-title"><i class="bi bi-people fs-3" style="margin-right:5%;color:#888C9F;"></i>{{__('messages.exit')}}</span>
                                </a>
                            </span>
                        </div>
                        @if(auth()->user()->role == 'ceo')
                        @php
                            $profit = Profit::orderBy('id', 'desc')->first();
                        @endphp
                        <div class="menu-item">
                            <span class="menu-icon">
                                <a class="menu-link" href="#">
                                    <span class="menu-title"><i class="bi bi-people fs-3" style="margin-right:5%;color:#888C9F;"></i>{{__('messages.profit')}}: {{number_format($profit->balance, 2, '.', ' ')}} UZS</span>
                                </a>
                            </span>
                        </div>
                        @endif
                     </div>
                     <!--end::Menu-->
                  </div>
               </div>
               <!--end::Aside menu-->
            </div>
            <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
               <!--begin::Header-->
               <div id="kt_header" class="header align-items-stretch">
                  <!--begin::Container-->
                  <div class="container-fluid d-flex align-items-stretch justify-content-between">
                     <!--begin::Aside mobile toggle-->
                     <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
                        <div class="btn btn-icon btn-active-color-white" id="kt_aside_mobile_toggle">
                           <i class="bi bi-list fs-1"></i>
                        </div>
                     </div>
                     <!--end::Aside mobile toggle-->
                     <!--begin::Wrapper-->
                     <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                        <!--begin::Navbar-->
                        <div class="d-flex align-items-stretch" id="kt_header_nav">

                        </div>
                        <div class="d-flex align-items-stretch flex-shrink-0">
                           <!--begin::Toolbar wrapper-->
                           <div class="topbar d-flex align-items-stretch flex-shrink-0">
                              <!--begin::User-->
                              <div class="d-flex align-items-stretch" id="kt_header_user_menu_toggle">
                                 <!--begin::Menu wrapper-->
                                 <div class="topbar-item cursor-pointer symbol px-3 px-lg-5 me-n3 me-lg-n5 symbol-30px symbol-md-35px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                                    <i class="las la-language fs-3x text-success"></i>
                                 </div>
                                 <!--begin::Menu-->
                                 <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                                    <!--begin::Menu separator-->
                                    <div class="separator my-2"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5">
                                        <a href="{{route('set.lang', ['lang'=> 'ru'])}}" class="menu-link d-flex px-5">
                                        <span class="symbol symbol-20px me-4">
                                        <img class="rounded-1" src="{{asset('assets/media/flags/russia.svg')}}" alt="" />
                                        </span>Русский</a>
                                     </div>
                                     <div class="menu-item px-5">
                                        <a href="{{route('set.lang', ['lang'=> 'uz'])}}" class="menu-link d-flex px-5">
                                        <span class="symbol symbol-20px me-4">
                                        <img class="rounded-1" src="{{asset('assets/media/flags/uzbekistan.svg')}}" alt="" />
                                        </span>O'zbek</a>
                                     </div>
                                     <div class="menu-item px-5">
                                        <a href="{{route('set.lang', ['lang'=> 'uz'])}}" class="menu-link d-flex px-5">
                                        <span class="symbol symbol-20px me-4">
                                        <img class="rounded-1" src="{{asset('assets/media/flags/uzbekistan.svg')}}" alt="" />
                                        </span>Qaraqalpaq</a>
                                     </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu separator-->
                                    <div class="separator my-2"></div>
                                    <!--end::Menu separator-->

                                 </div>
                                 <!--end::Menu-->
                                 <!--end::Menu wrapper-->
                              </div>
                              <!--end::User -->
                              <!--begin::Heaeder menu toggle-->
                              <div class="d-flex align-items-stretch d-lg-none px-3 me-n3" title="Show header menu">
                                 <div class="topbar-item" id="kt_header_menu_mobile_toggle">
                                    <i class="bi bi-text-left fs-1"></i>
                                 </div>
                              </div>
                              <!--end::Heaeder menu toggle-->
                           </div>
                           <!--end::Toolbar wrapper-->
                        </div>
                        <!--end::Navbar-->
                     </div>
                     <!--end::Wrapper-->
                  </div>
                  <!--end::Container-->
               </div>
               <!--end::Header-->
               <!--begin::Content-->
               <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                  <!--begin::Toolbar-->
                  <div class="toolbar" id="kt_toolbar">
                     <!--begin::Container-->
                     <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                        <!--begin::Page title-->
                        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                           <!--begin::Title-->
                           <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">
                              @yield('page-name')
                              <!--begin::Separator-->
                              <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                              <!--end::Separator-->
                           </h1>
                           <!--end::Title-->
                        </div>
                        <!--end::Page title-->
                        @livewire('usd')
                     </div>
                     <!--end::Container-->
                  </div>
                  <!--end::Toolbar-->
                  <!--begin::Post-->
                  <div class="post d-flex flex-column-fluid" id="kt_post">
                     <!--begin::Container-->
                     <div id="kt_content_container" class="container-xxl">
                        @yield('content')
                     </div>
                     <!--end::Container-->
                  </div>
                  <!--end::Post-->
               </div>
               <!--end::Content-->
               <!--begin::Footer-->
               <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                  <!--begin::Container-->
                  <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                     <!--begin::Copyright-->
                     <div class="text-dark order-2 order-md-1">
                        <span class="text-muted fw-bold me-1">{{date('Y')}}©</span>
                        <a href="https://texnopos.site/" target="_blank" class="text-gray-800 text-hover-primary">TexnoPOS</a>
                     </div>
                     <!--end::Copyright-->
                  </div>
                  <!--end::Container-->
               </div>
               <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
         </div>
         <!--end::Page-->
      </div>
      <!--end::Root-->
      <!--begin::Scrolltop-->
      <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
         <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
         <span class="svg-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
               <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
               <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
            </svg>
         </span>
         <!--end::Svg Icon-->
      </div>
      <!--end::Scrolltop-->
      <!--end::Main-->
      <livewire:scripts />
      <script>var hostUrl = "assets/";</script>
      <!--begin::Javascript-->
      <!--begin::Global Javascript Bundle(used by all pages)-->
      <script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
      <script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
      <!--end::Global Javascript Bundle-->
      <!--begin::Page Custom Javascript(used by this page)-->
      @yield('script')
      <!--end::Page Custom Javascript-->
      <!--end::Javascript-->
   </body>
   <!--end::Body-->
</html>
