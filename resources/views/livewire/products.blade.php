<div>
   @php
      use App\Models\Warehouse;
   @endphp
   <!--begin::Tables Widget 9-->
   <div class="card mb-5 mb-xl-8">
       <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
               <span class="card-label fw-bolder fs-3 mb-1">{{__('messages.all_products')}}</span>
            </h3>
            <div class="card-toolbar">
                <a wire:click="export" href="#" class="btn btn-sm btn-light btn-active-primary">
                <!--begin::Svg Icon | path: assets/media/icons/duotune/files/fil009.svg-->
                <span class="svg-icon svg-icon-muted svg-icon-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM13 15.4V10C13 9.4 12.6 9 12 9C11.4 9 11 9.4 11 10V15.4H8L11.3 18.7C11.7 19.1 12.3 19.1 12.7 18.7L16 15.4H13Z" fill="black"/>
                        <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black"/>
                    </svg>
                </span>
                <!--end::Svg Icon-->
                Export</a>
            </div>
            <div class="card-toolbar">
                <a wire:click="import" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#import">
                <!--begin::Svg Icon | path: assets/media/icons/duotune/files/fil002.svg-->
                    <span class="svg-icon svg-icon-muted svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                            <path opacity="0.3" d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z" fill="black"/>
                            <path d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z" fill="black"/>
                        </svg>
                    </span>
                <!--end::Svg Icon-->Import</a>
            </div>
            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover">
                <a wire:click="show" href="#" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">
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
       <!--end::Header-->
       <!--begin::Body-->
       <div class="card-body py-3">
          <div class="row">
            <div class="col-6">
               <label class="fw-bold fs-6 mb-2">{{__('messages.category')}}: </label>
               <select wire:model="category_s_id" class="form-control">
                  <option value="all">{{__('messages.all')}}</option>
                  @foreach ($categories as $category)
                     <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
               </select>
            </div>
            <div class="col-6">
               <label class="fw-bold fs-6 mb-2">{{__('messages.product_name')}}: </label>
               <input wire:model.debounce.500ms="name" class="form-control mb-8" type="text"  name="" id="">
            </div>
          </div>
          {{ $products->links() }}
           <!--begin::Table container-->
           <div class="table-responsive">
               <!--begin::Table-->
               <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                   <!--begin::Table head-->
                   <thead>
                       <tr class="fw-bolder text-muted">
                           <th class="min-w-150px">{{__('messages.product')}}</th>
                           <th class="min-w-150px">{{__('messages.category_name')}}</th>
                           <th class="min-w-150px">{{__('messages.cost_price')}}</th>
                           <th class="min-w-150px">{{__('messages.wholesale_percentage')}}</th>
                           <th class="min-w-150px">{{__('messages.maximum_percentage')}}</th>
                           <th class="min-w-150px">{{__('messages.minimum_product')}}</th>
                           <th class="min-w-50px">{{__('messages.have_now')}}</th>
                           <th class="min-w-100px text-end">{{__('messages.operations')}}</th>
                       </tr>
                   </thead>
                   <!--end::Table head-->
                   <!--begin::Table body-->
                   <tbody>
                       @foreach ($products as $product)
                       @php
                          $warehouse = Warehouse::where('product_id', $product['product_id'])->orderBy('id', 'desc')->first();
                       @endphp
                           <tr>
                              <td>
                                 <div class="d-flex align-items-center">
                                    <div class="symbol symbol-45px me-5">
                                       <img alt="Pic" src="{{ URL::to('/').'/storage/images/'.$product['product_image'] }}">
                                    </div>
                                    <div class="d-flex justify-content-start flex-column">
                                       <a class="text-dark fw-bolder text-hover-primary fs-6">{{ $product['product_name'] }}</a>
                                    </div>
                                 </div>
                              </td>
                              <td>
                                 <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-start flex-column">
                                       <a class="text-dark fw-bolder text-hover-primary fs-6">{{ $product['category_name'] }}</a>
                                    </div>
                                 </div>
                              </td>
                              <td>
                                 <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-start flex-column">
                                       <a class="text-dark fw-bolder text-hover-primary fs-6">{{ number_format($product['product_cost_price'], 2, '.', ' ') }} USD</a>
                                    </div>
                                 </div>
                              </td>
                              <td>
                                 <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-start flex-column">
                                       <a class="text-dark fw-bolder text-hover-primary fs-6">{{ number_format($product['price_wholesale'], 2, '.', ' ') }} USD</a>
                                       <span class="text-muted fw-bold text-muted d-block fs-7">{{ $product['percent_wholesale'] }}%</span>
                                    </div>
                                 </div>
                              </td>
                              <td>
                                 <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-start flex-column">
                                       <a class="text-dark fw-bolder text-hover-primary fs-6">{{ number_format($product['price_max'], 0, '', ' ') }} UZS</a>
                                       <span class="text-muted fw-bold text-muted d-block fs-7">{{ $product['percent_max'] }}%</span>
                                    </div>
                                 </div>
                              </td>
                              <td>
                                 <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-start flex-column">
                                       <a class="text-dark fw-bolder text-hover-primary fs-6">{{ number_format($product['price_min'], 0, '', ' ') }} UZS</a>
                                       <span class="text-muted fw-bold text-muted d-block fs-7">{{ $product['percent_min'] }}%</span>
                                    </div>
                                 </div>
                              </td>
                              <td>
                                 <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-start flex-column">
                                       <a class="text-dark fw-bolder text-hover-primary fs-6">{{ $warehouse['remained'] ?? 0 }}</a>
                                    </div>
                                 </div>
                              </td>
                               <td>
                                   <div class="d-flex justify-content-end flex-shrink-0">
                                       <a data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends" wire:click="edit({{$product['product_id']}})" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                           <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                           <span class="svg-icon svg-icon-3">
                                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                   <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                                                   <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                                               </svg>
                                           </span>
                                           <!--end::Svg Icon-->
                                       </a>
                                       <a wire:click="delete({{$product['product_id']}})" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                           <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                           <span class="svg-icon svg-icon-3">
                                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                   <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
                                                   <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
                                                   <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
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
                   <h1 class="mb-3">{{__('messages.add_product')}}</h1>
                   <!--end::Title-->
               </div>
               <!--end::Heading-->
               <div class="row">
                  <div class="col-6">
                     <label class="required fw-bold fs-6 mb-2">{{__('messages.category')}}: @error('category_id') <span class="text-danger">{{ __('messages.required') }}</span> @enderror</label>
                     <select class="form-select select-live" data-dropdown-parent="#kt_modal_invite_friends" data-control="select2" data-placeholder="Select an option">
                        <option></option>
                        @foreach ($categories as $item)
                           @if($category_id == $item['id'])
                              <option value="{{$item->id}}" selected>{{$item->name}}</option>
                           @else
                              <option value="{{$item->id}}">{{$item->name}}</option>
                           @endif
                        @endforeach
                     </select>
                  </div>
                  <div class="col-6">
                     <label class="required fw-bold fs-6 mb-2">{{__('messages.product_name')}}: @error('product.name')<span class="text-danger">{{ __('messages.required') }}</span> @enderror</label>
                     <input wire:model.lazy="product.name" class="form-control mb-8" type="text"  name="" id="">
                  </div>
                  <div class="col-6">
                     <label class="required fw-bold fs-6 mb-2">{{__('messages.brand')}}: @error('product.brand')<span class="text-danger">{{ __('messages.required') }}</span> @enderror</label>
                     <input wire:model.lazy="product.brand" class="form-control mb-8" type="text"  name="" id="">
                  </div>
                  <div class="col-6">
                     <label class="required fw-bold fs-6 mb-2">{{__('messages.cost_price')}}: @error('product.cost_price')<span class="text-danger">{{ __('messages.required') }}</span> @enderror</label>
                     <input wire:model.debounce.500ms="product.cost_price" class="form-control mb-8" type="number"  name="" id="">
                  </div>
                  <div class="col-6">
                     <label class="required fw-bold fs-6 mb-2">{{__('messages.wholesale_price')}}: @error('product.price_wholesale')<span class="text-danger">{{ __('messages.required') }}</span> @enderror</label>
                     <input wire:model.defer="product.price_wholesale" class="form-control mb-8" type="number"  name="" id="">
                  </div>
                  <div class="col-6">
                     <label class="required fw-bold fs-6 mb-2">{{__('messages.max_price')}}: @error('product.price_max')<span class="text-danger">{{ __('messages.required') }}</span> @enderror</label></label>
                     <input wire:model.defer="product.price_max" class="form-control mb-8" type="number"  name="" id="">
                  </div>
                  <div class="@if(!$update) col-6 @else col-12 @endif">
                     <label class="required fw-bold fs-6 mb-2">{{__('messages.min_price')}}: @error('product.price_min')<span class="text-danger">{{ __('messages.required') }}</span> @enderror</label>
                     <input wire:model.defer="product.price_min" class="form-control mb-8" type="number"  name="" id="">
                  </div>
                  @if(!$update)
                    <div class="col-6">
                     <label class="required fw-bold fs-6 mb-2">{{__('messages.product_count')}}:</label>
                     <input wire:model.defer="count" class="form-control mb-8" type="number"  name="" id="">
                  </div>
                  @endif
               </div>
               <!--begin::Actions-->
               <button wire:click="save" data-bs-dismiss="modal" id="kt_docs_formvalidation_tagify_submit" type="submit" class="btn btn-primary">
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
<div class="modal fade @if($import) show @endif" style="display:@if($import) block; @else none; @endif" id="import" tabindex="-1" @if($import) role="dialog" @endif aria-hidden="true">
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
               <form action="{{route('import')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                       <div class="col-3">
                           <label class="fw-bold fs-6 mb-2">Yuklob olish</label><br>
                           <span wire:click="example" class="btn btn-primary">
                               <span class="indicator-label">
                               {{__('messages.example_excel')}}
                               </span>
                           </span>
                       </div>
                       <div class="col-9">
                        <label class="required fw-bold fs-6 mb-2">File(excel): </label>
                           <input type="file" name="file" id="" class="form-control" accept=".xlsx">
                       </div>
                   </div>
                   <button type="submit" data-bs-dismiss="modal" class="btn btn-primary mt-5">
                       <span class="indicator-label">
                          {{__('messages.save')}}
                       </span>
                   </button>
               </form>

               <!--begin::Actions-->
               <!--end::Actions-->
           </div>
           <!--end::Modal body-->
       </div>
       <!--end::Modal content-->
   </div>
   <!--end::Modal dialog-->
</div>
<!--end::Modal - Invite Friend-->
<!-------DELETE-------->
<div class="modal fade @if($delete) show @endif" @if($delete) role="dialog" style="display: block;" aria-modal="true" @else style="display: none;" aria-hidden="true" @endif tabindex="-1" id="kt_modal_1">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title">{{__('messages.delete_product')}}</h5>
           </div>

           <div class="modal-body">
               <p>{{__('messages.delete_con')}}</p>
           </div>

           <div class="modal-footer">
               <button wire:click="deleteClose" type="button" class="btn btn-primary" data-bs-dismiss="modal">{{__('messages.no')}}</button>
               <button wire:click="deleteConfirm" type="button" class="btn btn-danger" data-bs-dismiss="modal">{{__('messages.yes')}}</button>
           </div>
       </div>
   </div>
</div>
<!-------END-DELETE-------->
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
