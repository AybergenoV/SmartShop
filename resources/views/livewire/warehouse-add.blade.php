<div>
    <!--begin::Tables Widget 9-->
    <div class="card mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">{{__('messages.all_products')}}</span>
            </h3>
            <div class="card-toolbar" data-bs-toggle="tooltip">
                <a wire:click="show" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#new_product">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                <span class="svg-icon svg-icon-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                    </svg>
                </span>
                <!--end::Svg Icon-->{{__('messages.add_product')}}</a>
            </div>
        </div>
        <!--begin::Body-->
        <div class="card-body py-3">
            <div class="row">
                <div class="col-6" wire:ignore>
                    <label class="fw-bold fs-6 mb-2">{{__('messages.category')}}: </label>
                    <select class="select-live form-select form-select-solid" data-control="select2" data-placeholder="Select an option">
                        <option value="all">{{__('messages.all')}}</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <label class="fw-bold fs-6 mb-2">{{__('messages.product_name')}}: </label>
                    <input type="text" wire:model="name" placeholder="{{__('messages.product_name')}}..." class="border border-gray-900 form-control">
                </div>
                <div class="col-6">
                    <label class="fw-bold fs-6 mb-2">{{__('messages.more')}}: </label>
                    <input type="text" wire:model="max" placeholder="... {{__('messages.more')}}" class="border border-gray-900 form-control">
                </div>
                <div class="col-6">
                    <label class="fw-bold fs-6 mb-2">{{__('messages.less')}}: </label>
                    <input type="text" wire:model="min" placeholder="... {{__('messages.less')}}" class="border border-gray-900 form-control">
                </div>
                <div class="col-6">
                    <br>
                    <input id="kt_docs_sweetalert_basic" wire:click="save" type="button"  value="{{__('messages.save')}}" class="btn btn-primary">
                </div>
            </div>
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-bolder text-muted">
                            <th class="min-w-150px">{{__('messages.product')}}</th>
                            <th class="min-w-150px">{{__('messages.have_now')}}</th>
                            <th class="min-w-150px">{{__('messages.count')}}</th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @foreach ($products as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-45px me-5">
                                            <img alt="Pic" src="{{ URL::to('/').'/'.$item['image']}}">
                                         </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a class="text-dark fw-bolder text-hover-primary fs-6">{{ $item['name'] }}</a>
                                            <span class="text-muted fw-bold text-muted d-block fs-7">{{ $item['brand'] }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <input disabled type="number" class="form-control" value="{{$item['remained']}}">
                                </td>
                                <td>
                                    <input type="number" class="border border-gray-900 form-control" wire:model.defer="transactions.{{$item['id']}}">
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
    @section('script')
    <script>
        $(document).ready(function() {
            $('.select-live').on('change', function (e) {
                var data = $(this).val();
                @this.category = data;
            });
        });
        const button = document.getElementById('kt_docs_sweetalert_basic');

        button.addEventListener('click', e =>{
            e.preventDefault();

            Swal.fire({
                text: "{{__('messages.successful_transaction')}}",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "OK",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.select-live-123').on('change', function (e) {
                var data = $(this).val();
                @this.category_id = data;
            });
        });
    </script>
    @endsection
    <div class="modal fade @if($show) show @endif" style="display:@if($show) block; @else none; @endif" id="new_product" tabindex="-1" @if($show) role="dialog" @endif aria-hidden="true">
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
                        <h1 class="mb-3">{{__('messages.add_product')}}</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <div class="row">
                       <div class="col-6" wire:ignore>
                          <label class="required fw-bold fs-6 mb-2">{{__('messages.category')}}: </label>
                          <select class="form-select select-live-123" data-dropdown-parent="#new_product" data-control="select2" data-placeholder="Select an option">
                             <option></option>
                             @foreach ($categories as $item)
                                   <option value="{{$item->id}}">{{$item->name}}</option>
                             @endforeach
                          </select>
                       </div>
                       <div class="col-6">
                          <label class="required fw-bold fs-6 mb-2">{{__('messages.product_name')}}: </label>
                          <input wire:model.lazy="product.name" class="form-control mb-8" type="text"  name="" id="">
                       </div>
                       <div class="col-6">
                          <label class="required fw-bold fs-6 mb-2">{{__('messages.brand')}}: </label>
                          <input wire:model.lazy="product.brand" class="form-control mb-8" type="text"  name="" id="">
                       </div>
                       <div class="col-6">
                          <label class="required fw-bold fs-6 mb-2">{{__('messages.cost_price')}}: </label>
                          <input wire:model.debounce.500ms="product.cost_price" class="form-control mb-8" type="number"  name="" id="">
                       </div>
                       <div class="col-6">
                          <label class="required fw-bold fs-6 mb-2">{{__('messages.wholesale_price')}}: </label>
                          <input wire:model.defer="product.price_wholesale" class="form-control mb-8" type="number"  name="" id="">
                       </div>
                       <div class="col-6">
                          <label class="required fw-bold fs-6 mb-2">{{__('messages.max_price')}}: </label>
                          <input wire:model.defer="product.price_max" class="form-control mb-8" type="number"  name="" id="">
                       </div>
                       <div class="col-6">
                          <label class="required fw-bold fs-6 mb-2">{{__('messages.min_price')}}: </label>
                          <input wire:model.defer="product.price_min" class="form-control mb-8" type="number"  name="" id="">
                       </div>
                         <div class="col-6">
                          <label class="required fw-bold fs-6 mb-2">{{__('messages.product_count')}}: </label>
                          <input wire:model.defer="count" class="form-control mb-8" type="number"  name="" id="">
                       </div>
                    </div>
                    <!--begin::Actions-->
                    <button wire:click="saveProduct" data-bs-dismiss="modal" id="kt_docs_formvalidation_tagify_submit" type="submit" class="btn btn-primary">
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
 </div>
