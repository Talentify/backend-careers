@extends('layouts.admin')

@section('content')
    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.bootstrap4.min.css">

    <div class="container">
        <div class="row">
            <div class="col-md-4 pull-right">
                <a href="{{route('admin.opportunity.create')}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true"><i class="fa fa-plus"></i>&nbsp; New opportunity</a>
            </div>
        </div>
        <div class="dashboard-main-table">
            <table id="table" class="table table-striped table-bordered wrap" style="width:100%">
                <thead>
                <tr>
                    <th>Job title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Workplace</th>
                    <th>Salary</th>
                    <th>Actions</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js" defer></script>

    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                columnDefs: [
                    {
                        targets: -1,
                        className: 'dt-body-right'
                    }
                ],
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.opportunity.search') }}',
                columns: [
                    { data: 'title', name: 'title' },
                    { data: 'description', name: 'description' },
                    { data: 'status', name: 'status' },
                    { data: 'workplace', name: 'workplace' },
                    { data: 'salary', function(data) {
                        return '$'+ data;
                        }
                    },
                    { data: 'actions',
                        render: function(data){
                            return htmlDecode(data);
                        }
                    }
                ]
            });
            $.fn.dataTable.ext.errMode = 'throw';
        });
    </script>
@endsection
