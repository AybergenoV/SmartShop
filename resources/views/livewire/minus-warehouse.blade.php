<div>
    <!--begin::Tables Widget 9-->
    <div class="card mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">{{__('messages.all_products')}}</span>
            </h3>
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
                                    <input step="5" type="number" max="{{$item['remained']}}" class="border border-gray-900 form-control" wire:model="transactions.{{$item['id']}}">
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
                text: "Muvaffaqiyatli tranzaksiya qilindi",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "OK",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
        });
    </script>
    @endsection
 </div>
