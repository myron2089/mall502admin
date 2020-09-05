
@extends('layouts.manage-app')

@section('content')
    <div class="kt-portlet ">
        <div class="kt-portlet__body">

            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__body">
                    <div class="kt-widget kt-widget--user-profile-3">
                        <div class="kt-widget__top">
                            <div class="kt-widget__media kt-hidden">
                                <img src="{{url('img/backgrounds/users/user_no_image.png')}}" alt="image">
                            </div>
                            <div class="kt-widget__pic kt-widget__pic--brand kt-font-gray kt-font-boldest kt-font-gray kt-hidden- custom-widget-pic">
                                @php
                                    $letterName = explode(' ',( Session::get('userInfo')->data->FirstName));   
                                 @endphp
                               {{$letterName[0][0]}}@if(count($letterName)>1){{$letterName[1][0]}}@endif
                            </div>
                            <div class="kt-widget__content">
                                <div class="kt-widget__head">
                                    <label class="kt-widget__username md-widget__company-name mt-2">
                                        {{ Session::get('userInfo')->data->FirstName }}
                                        
                                    </label>
                                    <small>{{ Session::get('userInfo')->data->Email }}</small>
                                    
                                </div>
                                <div class="kt-widget__subhead">
                                    <p>{{ Session::get('userInfo')->data->Email }}</p>
                                    <!--<a href="#"><i class="flaticon2-phone"></i>companyData->companyPhoneNumber</a>-->
                                    <p>Administrador</p>
                                </div>
                                <div class="kt-widget__info">
                                    
                                    <!--<div class="kt-widget__progress">
                                        <div class="kt-widget__text">
                                            Progress
                                        </div>
                                        <div class="progress" style="height: 5px;width: 100%;">
                                            <div class="progress-bar kt-bg-success" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="kt-widget__stats">
                                            78%
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-12 p-0 mt-4">
                           <!-- <a href="javascript:;" id="btn-user-edit"  data-base-url="{{url('')}}" data-url="/user/getAuthData" data-target="modal-user-form" data-action="2" class="btn btn-label-success btn-sm btn-upper">@lang('base.label_account_info_update')</a>&nbsp;-->
                            <!--<a href="javascript:companyCreate(1);" class="btn btn-bold btn-label-brand btn-sm btn-show-modal" data-action="2" data-target="modal-company-form" >@lang('base.label_account_info_update')</a>-->
                        
                        </div>
                        
                        
                        <div class="kt-widget__bottom">
                            <a href="{{url('management/companies')}}" >
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect id="Rectangle-5" x="0" y="0" width="24" height="24"></rect>
                                                <path d="M6,7 C7.1045695,7 8,6.1045695 8,5 C8,3.8954305 7.1045695,3 6,3 C4.8954305,3 4,3.8954305 4,5 C4,6.1045695 4.8954305,7 6,7 Z M6,9 C3.790861,9 2,7.209139 2,5 C2,2.790861 3.790861,1 6,1 C8.209139,1 10,2.790861 10,5 C10,7.209139 8.209139,9 6,9 Z" id="Oval-7" fill="#000000" fill-rule="nonzero"></path>
                                                <path d="M7,11.4648712 L7,17 C7,18.1045695 7.8954305,19 9,19 L15,19 L15,21 L9,21 C6.790861,21 5,19.209139 5,17 L5,8 L5,7 L7,7 L7,8 C7,9.1045695 7.8954305,10 9,10 L15,10 L15,12 L9,12 C8.27142571,12 7.58834673,11.8052114 7,11.4648712 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                <path d="M18,22 C19.1045695,22 20,21.1045695 20,20 C20,18.8954305 19.1045695,18 18,18 C16.8954305,18 16,18.8954305 16,20 C16,21.1045695 16.8954305,22 18,22 Z M18,24 C15.790861,24 14,22.209139 14,20 C14,17.790861 15.790861,16 18,16 C20.209139,16 22,17.790861 22,20 C22,22.209139 20.209139,24 18,24 Z" id="Oval-7-Copy" fill="#000000" fill-rule="nonzero"></path>
                                                <path d="M18,13 C19.1045695,13 20,12.1045695 20,11 C20,9.8954305 19.1045695,9 18,9 C16.8954305,9 16,9.8954305 16,11 C16,12.1045695 16.8954305,13 18,13 Z M18,15 C15.790861,15 14,13.209139 14,11 C14,8.790861 15.790861,7 18,7 C20.209139,7 22,8.790861 22,11 C22,13.209139 20.209139,15 18,15 Z" id="Oval-7-Copy-3" fill="#000000" fill-rule="nonzero"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">@lang('base.registered_companies') <span class="kt-nav__link-badge" wfd-id="790">
                                                    <!--<span class="kt-badge kt-badge--brand kt-badge--rounded" wfd-id="791">$sucCount</span>-->
                                                </span></span>
                                        <a href="{{url('management/companies')}}" class="kt-widget__value kt-font-brand">@lang('base.show_all')</a>
                                    </div>
                                </div>
                            </a>
                            <!-- <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                            <path d="M10.5,5 L19.5,5 C20.3284271,5 21,5.67157288 21,6.5 C21,7.32842712 20.3284271,8 19.5,8 L10.5,8 C9.67157288,8 9,7.32842712 9,6.5 C9,5.67157288 9.67157288,5 10.5,5 Z M10.5,10 L19.5,10 C20.3284271,10 21,10.6715729 21,11.5 C21,12.3284271 20.3284271,13 19.5,13 L10.5,13 C9.67157288,13 9,12.3284271 9,11.5 C9,10.6715729 9.67157288,10 10.5,10 Z M10.5,15 L19.5,15 C20.3284271,15 21,15.6715729 21,16.5 C21,17.3284271 20.3284271,18 19.5,18 L10.5,18 C9.67157288,18 9,17.3284271 9,16.5 C9,15.6715729 9.67157288,15 10.5,15 Z" id="Combined-Shape" fill="#000000"></path>
                                            <path d="M5.5,8 C4.67157288,8 4,7.32842712 4,6.5 C4,5.67157288 4.67157288,5 5.5,5 C6.32842712,5 7,5.67157288 7,6.5 C7,7.32842712 6.32842712,8 5.5,8 Z M5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 C6.32842712,10 7,10.6715729 7,11.5 C7,12.3284271 6.32842712,13 5.5,13 Z M5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 C6.32842712,15 7,15.6715729 7,16.5 C7,17.3284271 6.32842712,18 5.5,18 Z" id="Combined-Shape" fill="#000000" opacity="0.3"></path>
                                        </g>
                                    </svg>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">@lang('base.categories') <span class="kt-nav__link-badge" wfd-id="790">
                                    <span class="kt-badge kt-badge--brand kt-badge--rounded">productCount</span>
                                            </span></span>
                                    <a href="#" class="kt-widget__value kt-font-brand">@lang('base.show_more')</a>
                                </div>
                            </div>
                            
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                            <path d="M20.4061385,6.73606154 C20.7672665,6.89656288 21,7.25468437 21,7.64987309 L21,16.4115967 C21,16.7747638 20.8031081,17.1093844 20.4856429,17.2857539 L12.4856429,21.7301984 C12.1836204,21.8979887 11.8163796,21.8979887 11.5143571,21.7301984 L3.51435707,17.2857539 C3.19689188,17.1093844 3,16.7747638 3,16.4115967 L3,7.64987309 C3,7.25468437 3.23273352,6.89656288 3.59386153,6.73606154 L11.5938615,3.18050598 C11.8524269,3.06558805 12.1475731,3.06558805 12.4061385,3.18050598 L20.4061385,6.73606154 Z" id="Combined-Shape" fill="#000000" opacity="0.3"></path>
                                            <polygon id="Combined-Shape-Copy" fill="#000000" points="14.9671522 4.22441676 7.5999999 8.31727912 7.5999999 12.9056825 9.5999999 13.9056825 9.5999999 9.49408582 17.25507 5.24126912"></polygon>
                                        </g>
                                    </svg>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">@lang('base.products') 
                                        <span class="kt-badge kt-badge--brand kt-badge--rounded">productCount</span></span>
                                    <a href="#" class="kt-widget__value kt-font-brand">@lang('base.show_all')</a>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-network"></i>
                                </div>
                                 <div class="kt-widget__details">
                                    <span class="kt-widget__title">@lang('base.lbl_employees') </span>
                                    <a href="#" class="kt-widget__value kt-font-brand">@lang('base.show_all')s</a>
                                </div>
                                
                            </div>-->
                        </div>
                       
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <!--begin:: notifications-->
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    @lang('base.notifications')
                                </h3>
                            </div>
                            
                        </div>
                        <div class="kt-portlet__body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="kt_widget6_tab1_content" aria-expanded="true">
                                    <div class="kt-notification">
                                        
                                        <a data-pjax href="" class="kt-notification__item ajax-request">
                                            <div class="kt-notification__item-icon">
                                                
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                        <circle id="Oval-5" fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                        <rect id="Rectangle-9" fill="#000000" x="11" y="10" width="2" height="7" rx="1"/>
                                                        <rect id="Rectangle-9-Copy" fill="#000000" x="11" y="7" width="2" height="2" rx="1"/>
                                                    </g>
                                                </svg> </div>
                                            <div class="kt-notification__item-details">
                                                <div class="kt-notification__item-title">
                                                    @lang('base.no_categories_registered')
                                                </div>
                                                <div class="kt-notification__item-time">
                                                    Las categorías brindan un mayor orden para sus productos, asimismo facilitan la interacción de los clientes dentro de tu página web.
                                                </div>
                                            </div>
                                        </a>
                                        <a data-pjax href="" class="kt-notification__item ajax-request">
                                            <div class="kt-notification__item-icon">
                                               
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                        <circle id="Oval-5" fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                        <rect id="Rectangle-9" fill="#000000" x="11" y="10" width="2" height="7" rx="1"/>
                                                        <rect id="Rectangle-9-Copy" fill="#000000" x="11" y="7" width="2" height="2" rx="1"/>
                                                    </g>
                                                </svg> </div>
                                            <div class="kt-notification__item-details">
                                                <div class="kt-notification__item-title">
                                                    @lang('base.no_web_page_configured')
                                                </div>
                                                <div class="kt-notification__item-time">
                                                    Configure su página web para dar una mejor experiencia a sus clientes
                                                </div>
                                            </div>
                                        </a>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::notifications-->

                   
                </div>

               
            </div>

        </div>
    </div>
@endsection


