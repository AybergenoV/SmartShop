<div>
   <!--begin::Tables Widget 9-->
   <div class="card mb-5 mb-xl-8">
       <!--begin::Header-->
       <div class="card-header border-0 pt-5">
           <h3 class="card-title align-items-start flex-column">
               <span class="card-label fw-bolder fs-3 mb-1">{{__('messages.all_categories')}}</span>
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
               <!--end::Svg Icon-->{{__('messages.add_category')}}</a>
           </div>
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
                           <th class="min-w-150px">{{__('messages.category_name')}}</th>
                           <th class="min-w-150px">{{__('messages.wholesale_percentage')}}</th>
                           <th class="min-w-150px">{{__('messages.maximum_percentage')}}</th>
                           <th class="min-w-150px">{{__('messages.minimum_percentage')}}</th>
                           <th class="min-w-150px">{{__('messages.minimum_product')}}</th>
                           <th class="min-w-100px text-end">{{__('messages.operations')}}</th>
                       </tr>
                   </thead>
                   <!--end::Table head-->
                   <!--begin::Table body-->
                   <tbody>
                       @foreach ($categoris as $item)
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
                                     <div class="d-flex justify-content-start flex-column">
                                         <a class="text-dark fw-bolder text-hover-primary fs-6">{{ $item['percent_wholesale'] }}</a>
                                     </div>
                                 </div>
                              </td>
                              <td>
                                 <div class="d-flex align-items-center">
                                     <div class="d-flex justify-content-start flex-column">
                                         <a class="text-dark fw-bolder text-hover-primary fs-6">{{ $item['percent_max'] }}</a>
                                     </div>
                                 </div>
                              </td>
                              <td>
                                 <div class="d-flex align-items-center">
                                     <div class="d-flex justify-content-start flex-column">
                                         <a class="text-dark fw-bolder text-hover-primary fs-6">{{ $item['percent_min'] }}</a>
                                     </div>
                                 </div>
                              </td>
                              <td>
                                 <div class="d-flex align-items-center">
                                     <div class="d-flex justify-content-start flex-column">
                                         <a class="text-dark fw-bolder text-hover-primary fs-6">{{ $item['min_count'] }}</a>
                                     </div>
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
                                       <a wire:click="delete({{$item['id']}})" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
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
                       <h1 class="mb-3">{{__('messages.add_category')}}</h1>
                       <!--end::Title-->
                   </div>
                   <!--end::Heading-->
                   <div class="row">
                      <div class="col-6">
                        <label class="required fw-bold fs-6 mb-2">{{__('messages.category_name')}}: @error('category')<span class="text-danger">{{ __('messages.required') }}</span> @enderror</label>
                        <input wire:model.lazy="category" class="form-control mb-8" type="text"  name="" id="">
                      </div>
                      <div class="col-6">
                        <label class="required fw-bold fs-6 mb-2">{{__('messages.wholesale_percentage')}}: @error('optom')<span class="text-danger">{{ __('messages.required') }}</span> @enderror</label>
                        <input wire:model.lazy="optom" class="form-control mb-8" type="number"  name="" id="">
                      </div>
                      <div class="col-6">
                        <label class="required fw-bold fs-6 mb-2">{{__('messages.maximum_percentage')}}: @error('max')<span class="text-danger">{{ __('messages.required') }}</span> @enderror</label>
                        <input wire:model.lazy="max" class="form-control mb-8" type="number"  name="" id="">
                      </div>
                      <div class="col-6">
                        <label class="required fw-bold fs-6 mb-2">{{__('messages.minimum_percentage')}}: @error('min')<span class="text-danger">{{ __('messages.required') }}</span> @enderror</label>
                        <input wire:model.lazy="min" class="form-control mb-8" type="number"  name="" id="">
                      </div>
                      <div class="col-12">
                        <label class="required fw-bold fs-6 mb-2">{{__('messages.minimum_product')}}: @error('min_count')<span class="text-danger">{{ __('messages.required') }}</span> @enderror</label>
                        <input wire:model.debounce.500ms="min_count" class="form-control mb-8" type="number" name="" id="">
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
   <!-------DELETE-------->
   <div class="modal fade @if($delete) show @endif" @if($delete) role="dialog" style="display: block;" aria-modal="true" @else style="display: none;" aria-hidden="true" @endif tabindex="-1" id="kt_modal_1">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Kategoryani o'chirish</h5>
              </div>

              <div class="modal-body">
                  <p>{!!__('messages.delete_category')!!}: <input wire:model="conf" type="checkbox" class="form-check-input"></p>
              </div>

              <div class="modal-footer">
                  <button wire:click="deleteClose" type="button" class="btn btn-primary" data-bs-dismiss="modal">{{ __('messages.no')}}</button>
                  <button @if(!$conf) disabled @endif wire:click="deleteConfirm" type="button" class="btn btn-danger" data-bs-dismiss="modal">{{__('messages.yes')}}</button>
              </div>
          </div>
      </div>
  </div>
   <!-------END-DELETE-------->
</div>
