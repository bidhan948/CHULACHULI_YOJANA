    {{-- karyadesh bibaran accordion --}}
    @foreach ($program->workOrder as $workOrder)
        <div class="accordion" id="work_orderDiv{{ $workOrder->id }}" style="margin-top:-10px;">
            <div class="card">
                <div class="card-header bg-primary p-0" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-center text-white" type="button"
                            data-toggle="collapse" data-target="#work_order{{ $workOrder->id }}" aria-expanded="true"
                            aria-controls="program_bibaran">
                            {{ $workOrder->name . 'द्वारा लागिएको' }}
                        </button>
                    </h2>
                </div>

                <div id="work_order{{ $workOrder->id }}" class="collapse " aria-labelledby="headingOne"
                    data-parent="#work_orderDiv{{ $workOrder->id }}">
                    <div class="card-body">
                        <div class="container">
                            <div class="row mb-1">
                                @if ($loop->last)
                                    <div class="col-6">
                                        <a href="{{ route('work_order.edit', $workOrder) }}" class="btn btn-sm btn-primary"><i
                                                class="fa-solid fa-pen-to-square px-1"></i> {{ __('सच्याउनुहोस्') }}</a>
                                    </div>
                                @endif
                            </div>
                            <table id="table1" width="100%" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td class="text-center">{{ __('कर्यादेस न:') }}</td>
                                        <td class="">{{ Nepali($workOrder->work_order_no) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ __('कार्यक्रमको विनियोजित बजेट रु:') }}</td>
                                        <td class="">{{ Nepali($program->grant_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ __('कार्यक्रमको बाँकी रकम:') }}</td>
                                        <td class="">
                                            {{ Nepali($program->grant_amount - $program->work_order_sum) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ __('कार्यक्रमको नाम:') }}</td>
                                        <td class="">{{ $workOrder->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ __('कार्यादेश दिने निर्णय भएको मिति :') }}</td>
                                        <td class="">{{ Nepali($workOrder->decision_date_nep) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ __('नगरपालिकाबाट :') }}</td>
                                        <td class="">{{ Nepali($workOrder->municipality_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ __('लागत सहभागित :') }}</td>
                                        <td class="">{{ Nepali($workOrder->cost_participation) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ __('कार्यादेश दिईएको रकम रु :') }}</td>
                                        <td class="">{{ Nepali($workOrder->work_order_budget) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ __('कार्यक्रम शुरु हुने मिति :') }}</td>
                                        <td class="">{{ Nepali($workOrder->program_start_date_nep) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ __('कार्यक्रम सम्पन्न हुने मिति :') }}</td>
                                        <td class="">{{ Nepali($workOrder->program_end_date_nep) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ __('कार्यक्रमको संचालन गर्ने :') }}</td>
                                        <td class="">
                                            {{ Nepali($workOrder->listRegistrationAttribute->listRegistration->name) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ __('कार्यक्रमको संचालन गर्नेको नाम :') }}</td>
                                        <td class="">
                                            {{ Nepali($workOrder->listRegistrationAttribute->name) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            {{ __('नगरपालिकाको तर्फबाट संझौता गर्नेको नाम:') }}</td>
                                        <td class="">
                                            @foreach ($workOrder->workOrderDetail as $workOrderDetail)
                                                {{ $workOrderDetail->Staff->nep_name . ($loop->last ? '' : ',') }}
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ __('पद:') }}</td>
                                        <td class="">
                                            @foreach ($workOrder->workOrderDetail as $workOrderDetail)
                                                {{ getSettingValueById($workOrderDetail->post_id)->name . ($loop->last ? '' : ',') }}
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ __('मिती :') }}</td>
                                        <td>{{ Nepali($workOrder->date_nep) }}</td>
                                    </tr>
                                </thead>
                            </table>
                            <p class="mb-0 p-1 text-center bg-dark">
                                {{ __('कार्यक्रमबाट लाभान्वित घरधुरी तथा परिबारको विबरण') }}</p>
                            <table width="100%" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="4" class="text-center">लाभान्वित जनसंख्या</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">{{ __('घर परिवार संख्या') }}</th>
                                        <th class="text-center">{{ __('महिला') }}</th>
                                        <th class="text-center">{{ __('पुरुष') }}</th>
                                        <th class="text-center">{{ __('जम्मा') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">{{ Nepali($workOrder->house_family_count) }}</td>
                                        <td class="text-center">{{ Nepali($workOrder->female) }}</td>
                                        <td class="text-center">{{ Nepali($workOrder->male) }}</td>
                                        <td class="text-center">{{ Nepali($workOrder->male + $workOrder->female) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- end of karyadesh bibaran accordion --}}
