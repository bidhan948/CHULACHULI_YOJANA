@section('title', 'बजेट श्रोत')
@extends('layout.layout')
@section('sidebar')
    @include('layout.yojana_sidebar')
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}">
@endsection


@section('content')
    @include('yojana.budget-source.create')
    @include('yojana.budget-source.amount', ['budget_sources' => $data])
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">बजेट श्रोत</h3>
                <button onclick="onAdd()" class="float-right btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row"></div>
                <div class="row">
                    <table id="table1" width="100%" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>
                                        {{ $item->name }} &nbsp;&nbsp; (रु:
                                        <b>{{ NepaliAmount($item->amount - ($item->amountToBeSubtracted ?? 0)) }}</b>)
                                    </td>
                                    <td>
                                        <button onclick="onEdit({{ $item }})" class="btn btn-secondary btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button onclick="onAmountAdd({{ $item }}, false)"
                                            class="btn btn-secondary btn-sm">
                                            <i class="fa fa-credit-card mr-2"></i> रकम थप्नुहोस
                                        </button>
                                        <button onclick="onAmountAdd({{ $item }}, true)"
                                            class="btn btn-secondary btn-sm">
                                            <i class="fa fa-exchange-alt mr-2"></i> स्थानान्तरण
                                        </button>
                                        <button onclick="onDetailView({{ $item }})"
                                            class="btn btn-secondary btn-sm">
                                            <i class="fa fa-eye mr-2"></i>विवरण
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
@endsection



@section('scripts')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
    @yield('budget_source_scripts')
    @yield('budget_source_amount_scripts')
    <script>
        window.addEventListener("budget_sources_added", function(evt) {
            location.reload();
        }, false);
        window.addEventListener("budget_source_amounts_added", function(evt) {
            location.reload();
        }, false);

        $(function() {
            $('#table1').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $('#table1_wrapper').css("width", "100%");
        });

        const toggleBudgetSourceModal = () => {
            $('.budget_source_modal').modal('toggle');
        }

        const toggleBudgetSourceAmountModal = () => {
            $('.budget_source_amount_modal').modal('toggle');
        }

        const onAmountAdd = (item, isTransfer) => {
            $('#budget_source_amount_entry_date_nep').val('');
            $('#budget_source_amount_entry_date_eng').val('');
            $('#budget_source_amount_amount').val('');
            $('#budget_source_amount_remarks').val('');
            if (isTransfer) {
                $('#budget_source_amount_has_transfer').html('&nbsp;देखि');
                $('#budget_source_amount_to_budget_source_group').css('display', 'block');
                $('#budget_source_amount_budget_source_name').val(item.name);
                $('#budget_source_amount_budget_source_id').val(item.id);
            } else {
                $('#budget_source_amount_budget_source_id').val(item.id);
                $('#budget_source_amount_has_transfer').html('');
                $('#budget_source_amount_to_budget_source_group').css('display', 'none');
                $('#budget_source_amount_budget_source_name').val(item.name);
                $('#budget_source_amount_header').html('थप्नुहोस');
            }

            toggleBudgetSourceAmountModal();
        }

        const onAdd = () => {
            $('#budget_source_id').val('');
            $('#budget_source_name').val('');
            $('#budget_source_header').html('थप्नुहोस');
            toggleBudgetSourceModal();
        }

        const onEdit = (item) => {
            $('#budget_source_id').val(item.id);
            $('#budget_source_name').val(item.name);
            $('#budget_source_header').html('सच्याउनुहोस');
            toggleBudgetSourceModal();
        }
    </script>
@endsection
