<div>
    <!--begin::Tables Widget 9-->
    <div class="card mb-5 mb-xl-8">
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
                <div class="col-6">
                    <label class="fw-bold fs-6 mb-2">{{__('messages.customer')}}: </label>
                    <input wire:model="client" type="text" class="form-control">
                </div>
                <div class="col-3">
                    <label class="fw-bold fs-6 mb-2">{{__('messages.debt_term')}}: </label>
                    <input wire:model="term" type="date" class="form-control">
                </div>
                <div class="col-3">
                    <label class="fw-bold fs-6 mb-2">{{__('messages.debt_term')}}: </label>
                    <select class="form-control" wire:model="payment_type">
                        <option value="all">{{__('messages.all')}}</option>
                        <option value="debt">{{__('messages.debt')}}</option>
                        <option value="cash">{{__('messages.cash')}}</option>
                        <option value="card">{{__('messages.card')}}</option>
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
                            <th class="min-w-150px">{{__('messages.customer')}}</th>
                            <th class="min-w-120px">{{__('messages.cash')}}</th>
                            <th class="min-w-120px">{{__('messages.card')}}</th>
                            <th class="min-w-120px">{{__('messages.debt')}}</th>
                            <th class="min-w-120px">{{__('messages.total_cost')}}</th>
                            <th class="min-w-120px">{{__('messages.description')}}</th>
                            <th class="min-w-120px">{{__('messages.finished_time')}}</th>
                            <th class="min-w-100px text-end">{{__('messages.operations')}}</th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @foreach ($baskets as $basket)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{$basket->full_name}}</a>
                                            <span class="text-muted fw-bold text-muted d-block fs-7">{{$basket->phone}}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a class="text-dark fw-bolder d-block fs-6">{{number_format($basket->cash, 0, '', ' ')}} UZS</a>
                                </td>
                                <td>
                                    <a class="text-dark fw-bolder d-block fs-6">{{number_format($basket->card, 0, '', ' ')}} UZS</a>
                                </td>
                                <td>
                                    <a class="text-dark fw-bolder d-block fs-6">{{number_format($basket->debt, 0, '', ' ')}} UZS</a>
                                    <a class="text-dark fw-bolder d-block fs-8">{{$basket->term}}</a>
                                </td>
                                <td>
                                    <a class="text-dark fw-bolder d-block fs-6">{{number_format($basket->price, 0, '', ' ')}} UZS</a>
                                </td>
                                <td>
                                    <a class="text-dark fw-bolder d-block fs-6">{{$basket->description}}</a>
                                </td>
                                <td>
                                    <a class="text-dark fw-bolder d-block fs-6">{{$basket->created_at}}</a>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end flex-shrink-0">
                                        <a data-bs-toggle="modal" data-bs-target="#basket" wire:click="basket({{$basket->basket_id}})" href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                            <span class="svg-icon svg-icon-muted svg-icon-2hx">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M18.041 22.041C18.5932 22.041 19.041 21.5932 19.041 21.041C19.041 20.4887 18.5932 20.041 18.041 20.041C17.4887 20.041 17.041 20.4887 17.041 21.041C17.041 21.5932 17.4887 22.041 18.041 22.041Z" fill="black"/>
                                                    <path opacity="0.3" d="M6.04095 22.041C6.59324 22.041 7.04095 21.5932 7.04095 21.041C7.04095 20.4887 6.59324 20.041 6.04095 20.041C5.48867 20.041 5.04095 20.4887 5.04095 21.041C5.04095 21.5932 5.48867 22.041 6.04095 22.041Z" fill="black"/>
                                                    <path opacity="0.3" d="M7.04095 16.041L19.1409 15.1409C19.7409 15.1409 20.141 14.7409 20.341 14.1409L21.7409 8.34094C21.9409 7.64094 21.4409 7.04095 20.7409 7.04095H5.44095L7.04095 16.041Z" fill="black"/>
                                                    <path d="M19.041 20.041H5.04096C4.74096 20.041 4.34095 19.841 4.14095 19.541C3.94095 19.241 3.94095 18.841 4.14095 18.541L6.04096 14.841L4.14095 4.64095L2.54096 3.84096C2.04096 3.64096 1.84095 3.04097 2.14095 2.54097C2.34095 2.04097 2.94096 1.84095 3.44096 2.14095L5.44096 3.14095C5.74096 3.24095 5.94096 3.54096 5.94096 3.84096L7.94096 14.841C7.94096 15.041 7.94095 15.241 7.84095 15.441L6.54096 18.041H19.041C19.641 18.041 20.041 18.441 20.041 19.041C20.041 19.641 19.641 20.041 19.041 20.041Z" fill="black"/>
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

    <div class="modal bg-white fade @if($show) show @endif" @if($show) role="dialog" style="display: block;" aria-modal="true" @else style="display: none;" aria-hidden="true" @endif tabindex="-1" id="basket">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Mahsulotlar</h5>
                </div>

                <div class="modal-body">
                    <div class="py-5">
                        <table class="table table-row-dashed table-row-gray-300 gy-7 styled-table">
                            <thead>
                                <tr class="fw-bolder fs-6 text-gray-800">
                                    {{-- <th class="w-25px">{{__('messages.defect')}}</th> --}}
                                    <th class="w-25px">Qaytariw</th>
                                    <th>{{__('messages.product_name')}}</th>
                                    <th>{{__('messages.count')}}</th>
                                    <th class="min-w-120px">{{__('messages.sum')}}</th>
                                    <th>Minus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($show_bakset as $item)
                                    <tr>
                                        {{-- <td>
                                            <div class="form-check form-check-custom form-check-solid">
                                                <input wire:click="defect({{$item['order_id']}})" class="form-check-input" type="radio" name="{{$item['order_id']}}-type"/>
                                            </div>
                                        </td> --}}
                                        <td>
                                            <div class="form-check form-check-custom form-check-solid">
                                                <input wire:click="returnes({{$item['order_id']}})" class="form-check-input" type="radio" name="{{$item['order_id']}}-type"/>
                                            </div>
                                        </td>
                                        <td>{{$item->product_name}}</td>
                                        <td>{{$item->count}}</td>
                                        <td>{{number_format($item->price, 0, '', ' ')}} UZS</td>
                                        <td>
                                            <input type="number" wire:model="minus.{{$item['order_id']}}" class="form-control">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button wire:click="save" type="button" class="btn btn-primary" data-bs-dismiss="modal">{{__('messages.save')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
