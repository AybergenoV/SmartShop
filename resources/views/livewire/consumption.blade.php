<div>
    <!--begin::Tables Widget 9-->
    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">@if(url()->current() == route('web.income')) {{__('messages.income')}} @else {{__('messages.all_costs')}} @endif</span>
            </h3>
            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover">
                <a wire:click="show" href="#" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                <span class="svg-icon svg-icon-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                    </svg>
                </span>
                <!--end::Svg Icon-->@if(url()->current() == route('web.income')) {{__('messages.new_income')}} @else {{__('messages.add_consumption')}} @endif</a>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            {{$consumptions->links()}}
            <div class="row">
                <div class="col-4">
                    <label class="fw-bold fs-6 mb-2">{{__('messages.from')}}: </label>
                    <input wire:model.lazy="to" class="form-control mb-8" type="date">
                </div>
                <div class="col-4">
                    <label class="fw-bold fs-6 mb-2">{{__('messages.before')}}: </label>
                    <input wire:model.lazy="do" class="form-control mb-8" type="date">
                </div>
                <div class="col-4">
                    <label class="fw-bold fs-6 mb-2">{{__('messages.category')}}: </label>
                    <select wire:model.lazy="category_id" class="form-control mb-8">
                        @foreach($category as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-bolder text-muted">
                            <th class="min-w-150px">{{__('messages.category')}}</th>
                            <th class="min-w-150px">{{__('messages.to_whom')}}</th>
                            <th class="min-w-150px">{{__('messages.sum')}}</th>
                            <th class="min-w-150px">{{__('messages.description')}}</th>
                            <th class="min-w-150px">{{__('messages.date')}}</th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @foreach ($consumptions as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a class="text-dark fw-bolder text-hover-primary fs-6">{{ $item['category_name'] }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a class="text-dark fw-bolder text-hover-primary fs-6">{{ $item['staff'] }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a class="text-dark fw-bolder text-hover-primary fs-6">{{ $item['price'] }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a class="text-dark fw-bolder text-hover-primary fs-6">{{ $item['description'] }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a class="text-dark fw-bolder text-hover-primary fs-6">{{ $item['date'] }}</a>
                                        </div>
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
                        <h1 class="mb-3">@if(url()->current() == route('web.income')) {{__('messages.new_income')}} @else {{__('messages.add_consumption')}} @endif</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <div class="row">
                        <div class="col-6">
                            <label class="required fw-bold fs-6 mb-2">{{__('messages.category')}}: @error('consumption.category_id')<span class="text-danger">{{ __('messages.required') }}</span> @enderror</label>
                            <select wire:model.lazy="consumption.category_id" class="form-control mb-8">
                                <option value="">{{__('messages.select')}}</option>
                                @foreach ($category as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                       <div class="col-6">
                         <label class="required fw-bold fs-6 mb-2">{{__('messages.to_whom')}}: @error('consumption.staff')<span class="text-danger">{{ __('messages.required') }}</span> @enderror</label>
                         <input wire:model.lazy="consumption.staff" class="form-control mb-8" type="text">
                       </div>
                       <div class="col-4">
                        <label class="required fw-bold fs-6 mb-2">{{__('messages.sum')}}: @error('consumption.price')<span class="text-danger">{{ __('messages.required') }}</span> @enderror</label>
                        <input wire:model.lazy="consumption.price" class="form-control mb-8" type="number">
                      </div>
                      <div class="col-4">
                        <label class="required fw-bold fs-6 mb-2">{{__('messages.description')}}: @error('consumption.description')<span class="text-danger">{{ __('messages.required') }}</span> @enderror</label>
                        <input wire:model.lazy="consumption.description" class="form-control mb-8" type="text">
                      </div>
                      <div class="col-4">
                        <label class="required fw-bold fs-6 mb-2">{{__('messages.date')}}: @error('consumption.date')<span class="text-danger">{{ __('messages.required') }}</span> @enderror</label>
                        <input wire:model.lazy="consumption.date" class="form-control mb-8" type="date">
                      </div>
                    </div>
                    <!--begin::Actions-->
                    <button data-bs-dismiss="modal" wire:click="save" id="kt_docs_formvalidation_tagify_submit" type="submit" class="btn btn-primary">
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
</div>
