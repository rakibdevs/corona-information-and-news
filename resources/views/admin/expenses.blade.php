@extends('admin.layouts.main')

@section('content')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jquery-ui/jquery-ui.css') }}">
@endpush
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ik ik-x"></i>
                </button>
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ik ik-x"></i>
                </button>

            </div>
            @endif
        </div>
        <div class="col-sm-12">
            <form class="box-20" method="POST" action="{{ url('admin/expense/store')}}">
            <h5>Expense Entry <span class="right">Total Expense: <strong>{{$total}}</strong></span></h5>
            <hr>
            @csrf
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label>date<span class="text-red">*</span></label>
                        <input type="date" name="exp_date" class="form-control" placeholder="Enter date" value="{{ date('Y-m-d')}}" required>
                    </div>
                    <div class="col-sm-3">
                        <label>Reason</label>
                        <input type="text" name="reason" class="form-control" placeholder="Enter reason of expense" >
                    </div>
                    <div class="col-sm-3">
                        <label>Amount<span class="text-red">*</span></label>
                        <input type="text" name="amount" class="form-control" placeholder="Enter amount" required> 
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-sm btn-success mt-33 ">Save</button>
                    </div>
                    
                </div>
            </form>
             
        </div>
        <div class="col-sm-12">
            <table id="roles_table" class="table">
                <thead>
                    <tr>
                        <th>{{ __('Date')}}</th>
                        <th>{{ __('Reason')}}</th>
                        <th>{{ __('Amount')}}</th>
                        <th>{{ __('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div> 
    </div>
</div>
@push('script')
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/Cell-edit/dataTables.cellEdit.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function()
        {
            var dTable = $('#roles_table').DataTable({

                order: [],
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                processing: true,
                responsive: false,
                serverSide: true,
                processing: true,
                language: {
                  processing: 'Loading....'
                },
                scroller: {
                    loadingIndicator: false
                },
                pagingType: "full_numbers",
                dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
                ajax: {
                    url: '/admin/get-expense',
                    type: "get"
                },
                columns: [
                    {data:'exp_date', name: 'exp_date'},
                    {data:'reason', name: 'reason'},
                    {data:'amount', name: 'amount'},
                    {data:'action', name: 'action'}

                ],
                buttons: [
                    {
                        extend: 'copy',
                        className: 'btn-sm btn-info',
                        title: 'Roles',
                        header: false,
                        footer: true,
                        exportOptions: {
                            // columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        className: 'btn-sm btn-success',
                        title: 'Roles',
                        header: false,
                        footer: true,
                        exportOptions: {
                            // columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        className: 'btn-sm btn-warning',
                        title: 'Roles',
                        header: false,
                        footer: true,
                        exportOptions: {
                            // columns: ':visible',
                        }
                    },
                    {
                        extend: 'pdf',
                        className: 'btn-sm btn-primary',
                        title: 'Roles',
                        pageSize: 'A2',
                        header: false,
                        footer: true,
                        exportOptions: {
                            // columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn-sm btn-danger',
                        title: 'Roles',
                        // orientation:'landscape',
                        pageSize: 'A2',
                        header: true,
                        footer: false,
                        orientation: 'landscape',
                        exportOptions: {
                            // columns: ':visible',
                            stripHtml: false
                        }
                    }
                ],
                createdRow: function ( row, data, index ) {
                    var td_index = data.DT_RowIndex;
                    $('td', row).eq(0).attr('id', 'perm_'+data.id);
                    $('td', row).eq(0).attr('title', 'Click to edit Date');
                    $('td', row).eq(1).attr('title', 'Click to edit Reason');
                    $('td', row).eq(2).attr('title', 'Click to edit Amount');
                 },
            });

            dTable.MakeCellsEditable({
                "onUpdate": update, //call function to update in backend
                "inputCss":'form-control',
                "columns": [0,1,2],
                "confirmationButton": { // could also be true
                    "confirmCss": 'btn btn-sm btn-success',
                    "cancelCss": 'btn btn-sm btn-danger'
                },
                "inputTypes": [
                    {
                        "column": 0,
                        "type": "text",
                        "options": null
                    },
                    {
                        "column": 1,
                        "type": "text",
                        "options": null
                    },
                    {
                        "column": 2,
                        "type": "text",
                        "options": null
                    }
                    
                ]
            });
            function update(updatedCell, updatedRow, oldValue) 
            {
                var id       = updatedRow.data().id;
                var exp_date = updatedRow.data().exp_date;
                var reason   = updatedRow.data().reason;
                var amount   = updatedRow.data().amount;
                $.ajax({
                    url: "/admin/collection/update",
                    method: "GET",
                    dataType: 'json',
                    data: {
                        'id'         : id,
                        'exp_date'   : exp_date,
                        'contact_no' : contact_no,
                        'amount'     : amount
                    },
                    success: function(data)
                    {
                        $('#perm'+updatedRow.data().id).text(data.exp_date);
                        updatedRow.data().exp_date = data.exp_date;
                        updatedRow.data().reason = data.reason;
                        updatedRow.data().amount = data.amount;
                        
                    }
                });
            }
        });
    </script>
@endpush
@endsection