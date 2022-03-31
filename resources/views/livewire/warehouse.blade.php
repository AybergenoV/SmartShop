<div>
    <!--begin::Tables Widget 9-->
    <div class="card mb-5 mb-xl-8">
        <!--begin::Body-->
        <div class="card-body py-3">
            <div class="row">
                <div class="col-12" wire:ignore>
                    <label class="fw-bold fs-6 mb-2">{{__('messages.category')}}: </label>
                    <select class="select-live form-select form-select-solid" data-control="select2" data-placeholder="Select an option">
                        <option value="all">{{__('messages.all')}}</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
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
                            <th class="min-w-150px">{{__('messages.category')}}</th>
                            <th class="min-w-150px">{{__('messages.cost_price')}}</th>
                            <th class="min-w-150px">{{__('messages.was_before')}}</th>
                            <th class="min-w-150px">{{__('messages.new')}}</th>
                            <th class="min-w-150px">{{__('messages.sold_out')}}</th>
                            <th class="min-w-150px">{{__('messages.have_now')}} @if($category_id) ({{array_sum(array_column($warehouse, 'remained'))}}) @endif</th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @foreach ($warehouse as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-45px me-5">
                                            <img alt="Pic" src="{{ URL::to('/').'/'.$item['product_image'] }}">
                                         </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a class="text-dark fw-bolder text-hover-primary fs-6">{{ $item['product_name'] }}</a>
                                            <span class="text-muted fw-bold text-muted d-block fs-7">{{ $item['product_brand'] }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a class="text-dark fw-bolder text-hover-primary fs-6">{{ $item['category']['name'] }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                  <div class="d-flex align-items-center">
                                      <div class="d-flex justify-content-start flex-column">
                                          <a class="text-dark fw-bolder text-hover-primary fs-6">{{ $item['product_cost_price'] }}</a>
                                      </div>
                                  </div>
                               </td>
                               <td>
                                  <div class="d-flex align-items-center">
                                      <div class="d-flex justify-content-start flex-column">
                                          <a class="text-dark fw-bolder text-hover-primary fs-6">{{ $item['extant_was'] }}</a>
                                      </div>
                                  </div>
                               </td>
                               <td>
                                  <div class="d-flex align-items-center">
                                      <div class="d-flex justify-content-start flex-column">
                                          <a class="text-dark fw-bolder text-hover-primary fs-6">{{ $item['new'] }}</a>
                                      </div>
                                  </div>
                               </td>
                               <td>
                                  <div class="d-flex align-items-center">
                                      <div class="d-flex justify-content-start flex-column">
                                          <a class="text-dark fw-bolder text-hover-primary fs-6">{{ $item['sold_out'] }}</a>
                                      </div>
                                  </div>
                               </td>
                               <td>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-start flex-column">
                                        <a class="text-dark fw-bolder text-hover-primary fs-6">{{ $item['remained'] }}</a>
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
    @section('script')
    <script>
        $(document).ready(function() {
            $('.select-live').on('change', function (e) {
                var data = $(this).val();
                @this.category_id = data;
            });
        });
    </script>
    @endsection
 </div>
