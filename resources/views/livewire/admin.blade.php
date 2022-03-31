<div>
    @php
        use App\Models\Basket;
    @endphp
    <!--begin::Tables Widget 9-->
    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">{{__('messages.all_vendors')}}</span>
            </h3>
            <div class="row">
                <div class="col-6">
                    <div class="card-toolbar" data-bs-toggle="tooltip">
                        <a wire:click="show_salary" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#salary">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->{{__('messages.setting_salaries')}}</a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card-toolbar" data-bs-toggle="tooltip">
                        <a wire:click="show" href="#" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->{{__('messages.add_new_vendor')}}</a>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <div class="row">
                <div class="col-6">
                    <label class="fw-bold fs-6 mb-2">{{__('messages.from')}}:</label>
                    <input wire:model.lazy="to" type="date" class="form-control mb-8">
                </div>
                <div class="col-6">
                    <label class="fw-bold fs-6 mb-2">{{__('messages.before')}}:</label>
                    <input wire:model.lazy="do" type="date" class="form-control mb-8">
                </div>
            </div>
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-bolder text-muted">
                            <th class="min-w-150px">{{__('messages.name_saller')}}</th>
                            <th class="min-w-150px">{{__('messages.salary')}}</th>
                            <th class="min-w-150px">FLEX</th>
                            <th class="min-w-100px">{{__('messages.salary_history')}}</th>
                            <th class="min-w-100px text-end">{{__('messages.operations')}}</th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @foreach ($admins as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a class="text-dark fw-bolder text-hover-primary fs-6">{{ $item['name'] }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a class="text-dark fw-bolder text-hover-primary fs-6">{{ number_format($item['salary'], 2, '.', ' ') }} UZS</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a class="text-dark fw-bolder text-hover-primary fs-6">{{ $item['flex'] }}%</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a data-bs-toggle="modal" data-bs-target="#salary_history" wire:click="salary({{$item['id']}}, '{{$item['name']}}')" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            <!--begin::Svg Icon | path: assets/media/icons/duotune/finance/fin010.svg-->
                                            <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M12.5 22C11.9 22 11.5 21.6 11.5 21V3C11.5 2.4 11.9 2 12.5 2C13.1 2 13.5 2.4 13.5 3V21C13.5 21.6 13.1 22 12.5 22Z" fill="black"/>
                                                <path d="M17.8 14.7C17.8 15.5 17.6 16.3 17.2 16.9C16.8 17.6 16.2 18.1 15.3 18.4C14.5 18.8 13.5 19 12.4 19C11.1 19 10 18.7 9.10001 18.2C8.50001 17.8 8.00001 17.4 7.60001 16.7C7.20001 16.1 7 15.5 7 14.9C7 14.6 7.09999 14.3 7.29999 14C7.49999 13.8 7.80001 13.6 8.20001 13.6C8.50001 13.6 8.69999 13.7 8.89999 13.9C9.09999 14.1 9.29999 14.4 9.39999 14.7C9.59999 15.1 9.8 15.5 10 15.8C10.2 16.1 10.5 16.3 10.8 16.5C11.2 16.7 11.6 16.8 12.2 16.8C13 16.8 13.7 16.6 14.2 16.2C14.7 15.8 15 15.3 15 14.8C15 14.4 14.9 14 14.6 13.7C14.3 13.4 14 13.2 13.5 13.1C13.1 13 12.5 12.8 11.8 12.6C10.8 12.4 9.99999 12.1 9.39999 11.8C8.69999 11.5 8.19999 11.1 7.79999 10.6C7.39999 10.1 7.20001 9.39998 7.20001 8.59998C7.20001 7.89998 7.39999 7.19998 7.79999 6.59998C8.19999 5.99998 8.80001 5.60005 9.60001 5.30005C10.4 5.00005 11.3 4.80005 12.3 4.80005C13.1 4.80005 13.8 4.89998 14.5 5.09998C15.1 5.29998 15.6 5.60002 16 5.90002C16.4 6.20002 16.7 6.6 16.9 7C17.1 7.4 17.2 7.69998 17.2 8.09998C17.2 8.39998 17.1 8.7 16.9 9C16.7 9.3 16.4 9.40002 16 9.40002C15.7 9.40002 15.4 9.29995 15.3 9.19995C15.2 9.09995 15 8.80002 14.8 8.40002C14.6 7.90002 14.3 7.49995 13.9 7.19995C13.5 6.89995 13 6.80005 12.2 6.80005C11.5 6.80005 10.9 7.00005 10.5 7.30005C10.1 7.60005 9.79999 8.00002 9.79999 8.40002C9.79999 8.70002 9.9 8.89998 10 9.09998C10.1 9.29998 10.4 9.49998 10.6 9.59998C10.8 9.69998 11.1 9.90002 11.4 9.90002C11.7 10 12.1 10.1 12.7 10.3C13.5 10.5 14.2 10.7 14.8 10.9C15.4 11.1 15.9 11.4 16.4 11.7C16.8 12 17.2 12.4 17.4 12.9C17.6 13.4 17.8 14 17.8 14.7Z" fill="black"/>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end flex-shrink-0">
                                        <a data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends" wire:click="edit({{$item['id']}})" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                                                    <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>
        <!--begin::Body-->
    </div>
    <!--end::Tables Widget 9-->

    <!--begin::Modal - Invite Friends-->
    <div class="modal fade @if($show) show @endif" style="display:@if($show) block; @else none; @endif" id="kt_modal_invite_friends" tabindex="-1" @if($show) role="dialog" @endif aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-fullscreen">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span wire:click="close" class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                    <!--begin::Heading-->
                    <div class="text-center mb-13">
                        <!--begin::Title-->
                        <h1 class="mb-3">{{__('messages.new_seller')}}</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <div class="row">
                       <div class="col-6">
                         <label class="required fw-bold fs-6 mb-2">{{__('messages.name_saller')}}: @error('user.name')<span class="text-danger">{{ __('messages.required') }}</span> @enderror</label>
                         <input wire:model.lazy="user.name" class="form-control mb-8" type="text"  name="" id="" required>
                       </div>
                       <div class="col-6">
                        <label class="required fw-bold fs-6 mb-2">{{__('messages.salary')}}: </label>
                        <input wire:model.lazy="user.salary" class="form-control mb-8" type="text"  name="" id="" required>
                      </div>
                      <div class="col-6">
                        <label class="required fw-bold fs-6 mb-2">FLEX: </label>
                        <input wire:model.lazy="user.flex" class="form-control mb-8" type="text">
                      </div>
                       <div class="col-4">
                         <label class="required fw-bold fs-6 mb-2">{{__('messages.pincode')}}: </label>
                         <input wire:model.lazy="pincode" disabled class="form-control mb-8" type="text"  name="" id="">
                       </div>
                       <div class="col-2">
                            <label class="fw-bold fs-6 mb-2">{{__('messages.new_pincode')}}: </label>
                            <input wire:click="pincode" type="button" class="btn btn-primary" value="{{__('messages.pincode')}}">
                      </div>
                    </div>
                    <!--begin::Actions-->
                    <button data-bs-dismiss="modal" wire:click="create" id="kt_docs_formvalidation_tagify_submit" type="submit" class="btn btn-primary">
                        <span class="indicator-label">
                           {{__('messages.save')}}
                        </span>
                    </button>
                    <!--end::Actions-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Invite Friend-->
    <!--begin::Modal - Invite Friends-->
    <div class="modal fade @if($show_salary) show @endif" style="display:@if($show_salary) block; @else none; @endif" id="salary" tabindex="-1" @if($show_salary) role="dialog" @endif aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-fullscreen">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span wire:click="close_salary" class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                    <!--begin::Heading-->
                    <div class="text-center mb-13">
                        <!--begin::Title-->
                        <h1 class="mb-3">{{__('messages.new_seller')}}</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <div class="row">
                       <div class="col-6">
                         <label class="required fw-bold fs-6 mb-2">{{__('messages.salary')}}: </label>
                         <input wire:model.lazy="salary" class="form-control mb-8" type="text"  name="" id="" required>
                       </div>
                       <div class="col-6">
                         <label class="required fw-bold fs-6 mb-2">FLEX: </label>
                         <input wire:model.lazy="flex" class="form-control mb-8" type="text">
                       </div>
                    </div>
                    <!--begin::Actions-->
                    <button data-bs-dismiss="modal" wire:click="save_salary" id="salary" type="submit" class="btn btn-primary">
                        <span class="indicator-label">
                           {{__('messages.save')}}
                        </span>
                    </button>
                    <!--end::Actions-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Invite Friend-->
    <!--begin::Modal - Invite Friends-->
    <div class="modal fade @if($salary_history_show) show @endif" style="display:@if($salary_history_show) block; @else none; @endif" id="salary_history" tabindex="-1" @if($salary_history_show) role="dialog" @endif aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-fullscreen">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span wire:click="close_salary" class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                    <!--begin::Heading-->
                    <div class="text-center mb-13">
                        <!--begin::Title-->
                        <h1 class="mb-3">{{$name}}</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <table class="table table-rounded table-striped border gy-7 gs-7">
                        <thead>
                            <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                <th>{{__('messages.date')}}</th>
                                <th>{{__('messages.count_order')}}</th>
                                <th>{{__('messages.sum')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salary_history as $item)
                            @php
                                $count = Basket::where('admin_id', $item['admin_id'])
                                    ->whereMonth('created_at', $item['month'])
                                    ->whereYear('created_at', $item['year'])->count();
                            @endphp
                                <tr>
                                    <td>{{date('Y-m-d', (strtotime($item->created_at)))}}</td>
                                    <td>{{$count}}</td>
                                    <td>{{$item['salary']}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Invite Friend-->
 </div>
