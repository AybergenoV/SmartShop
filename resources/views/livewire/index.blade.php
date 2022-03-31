<div>
    <!--begin::Tables Widget 9-->
    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">{{__('messages.clients')}}</span>
            </h3>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <div class="row">
                <div class="col-6">
                   <label class="fw-bold fs-6 mb-2">{{__('messages.from')}}: </label>
                   <input wire:model="to" type="date" class="form-control">
                </div>
                <div class="col-6">
                    <label class="fw-bold fs-6 mb-2">{{__('messages.before')}}: </label>
                    <input wire:model="do" type="date" class="form-control">
                </div>
                <div class="col-12">
                   <label class="fw-bold fs-6 mb-2">{{__('messages.name_saller')}}: </label>
                    <select wire:model="staff_id" class="form-control">
                        <option value="all">{{__('messages.all')}}</option>
                        @foreach ($staffs as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
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
                                          <img alt="Pic" src="{{ URL::to('/').'/storage/images/'.$item['product_image'] }}">
                                       </div>
                                       <div class="d-flex justify-content-start flex-column">
                                          <a class="text-dark fw-bolder text-hover-primary fs-6">{{ $item['product_name'] }}</a>
                                       </div>
                                    </div>
                                 </td>
                                <td>{{$item['count']}}</td>
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
</div>
