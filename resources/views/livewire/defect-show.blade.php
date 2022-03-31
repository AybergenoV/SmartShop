<div>
    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">{{__('messages.defective_products')}}</span>
            </h3>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-bolder text-muted">
                            <th class="min-w-140px">{{__('messages.date')}}</th>
                            <th class="min-w-75px text-end">{{__('messages.operations')}}</th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    <a wire:click="bakset({{$product->basket_id}})" class="text-dark fw-bolder text-hover-primary d-block fs-6 cursor-pointer" data-bs-toggle="modal" data-bs-target="#basket_modal">{{$product->created_at}}</a>
                                    <span class="text-muted fw-bold text-muted d-block fs-7">{{ucfirst(App\Models\Admin::find(1)->name)}}</span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end flex-shrink-0">
                                        <a wire:click="bakset({{$product->basket_id}})" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target="#basket_modal">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
                                                    <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
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
    <div class="modal fade @if($show) show @endif" style="display:@if($show) block; @else none; @endif" id="basket_modal" tabindex="-1" @if($show) role="dialog" @endif aria-hidden="true">
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
                        <h1 class="mb-3">{{__('messages.defective_products')}}</h1>
                        <!--end::Title-->
                        <br>
                        <table class="table table-rounded table-striped border gy-7 gs-7">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                    <th>{{__('messages.product_name')}}</th>
                                    <th>{{__('messages.count')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($basket_orders as $item)
                                    <tr>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->count}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!--end::Heading-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
</div>
