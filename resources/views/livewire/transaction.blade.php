<div>
    @php
        use App\Models\Admin;
        use App\Models\User;
    @endphp
    <!--begin::Tables Widget 9-->
    <div class="card mb-5 mb-xl-8">
        <!--begin::Body-->
        <div class="card-body py-3">
            {{ $transaction->links() }}
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-bolder text-muted">
                            <th class="min-w-150px">{{__('messages.customer')}}</th>
                            <th class="min-w-140px">{{__('messages.card')}}</th>
                            <th class="min-w-120px">{{__('messages.cash')}}</th>
                            <th class="min-w-120px">{{__('messages.general')}}</th>
                            <th class="min-w-120px">{{__('messages.recipient')}}</th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @foreach ($transaction as $item)
                            @php
                                $user = User::find($item['to_id']);
                                $admin = Admin::find($item['from_id']);
                            @endphp
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <span class="text-dark fw-bolder d-block fs-6">{{$user->full_name ?? ''}}</span>
                                            <span class="text-dark fw-bolder d-block fs-7">{{$user->phone ?? ''}}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-dark fw-bolder d-block fs-7">{{number_format($item['card'], 0, '', ' ')}} UZS</span>
                                </td>
                                <td>
                                    <span class="text-dark fw-bolder d-block fs-7">{{number_format($item['cash'], 0, '', ' ')}} UZS</span>
                                </td>
                                <td>
                                    <span class="text-dark fw-bolder d-block fs-7">{{number_format($item['price'], 0, '', ' ')}} UZS</span>
                                </td>
                                <td>
                                    <span class="text-dark fw-bolder d-block fs-6">{{$admin->name}}</span>
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
</div>
