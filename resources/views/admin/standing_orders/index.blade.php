@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">Public</a></li>
        <li><a href="#">Standing Order</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Customer Standing Order - DATA <small>clients data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <!-- <a href="{!! route('standing.order.create') !!}"> -->
                <button type="button" id='new-standing-order' data-toggle="modal" data-target="#standing-order-modal" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button>
            <!-- </a> -->
        </div>
        <!-- Modal -->
        <div class="modal fade" id="standing-order-modal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close"
                            data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Group</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" action="{!! route('standing.order.create') !!}" method="GET">
                            <div class="form-group">
                                <label for="Client" class="col-sm-3 control-label">Client</label>
                                <div class="col-sm-6">
                                    <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                        data-style="btn-white" name="client_id" id="client_id" required>
                                        <option value="" selected disabled>Select Client</option>
                                        @foreach ($data['clients'] as $client)
                                            <option value="{!! $client->id !!}">
                                                {!! strtoupper($client->client_number . ' - ' . $client->first_name . ' ' . $client->last_name) !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Proceed</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                                class="fa fa-expand"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i
                                class="fa fa-repeat"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i
                                class="fa fa-minus"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i
                                class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">DataForm - Autofill</h4>
                </div>
                <div class="panel-body">
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th># NUMBER</th>
                                <th>CATEGORY</th>
                                <th>CLIENT</th>
                                <th>ESCALATED BY</th>
                                <th>SOURCE ACCOUNT</th>
                                <th>DESTINATION ACCOUNT</th>
                                <th>FREQUENCY</th>
                                <th>START DATE</th>
                                <th>END DATE</th>
                                <th>AMOUNT</th>
                                <th>REASON</th>
                                <th>NARRATIVE</th>
                                <th>STATUS</th>
                                <th>CREATED</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data['lists'] as $list)
                            <tr class='{{ isset($list->deleted_at) ? 'danger' : '' }}'>
                                <td class='table-text'>
                                    <div class="label label-info">
                                        # {!! $list->_pid !!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        {!! isset($list->category) ? ucwords($list->category->name) : NULL!!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        {!! isset($list->client) ? ucwords($list->client->first_name . ' ' . $list->client->last_name) : NULL !!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        {!! isset($list->by) ? ucwords($list->by->name) : NULL !!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        <a>{!! isset($list->source) ? $list->source->id . ' - ' . $list->source->balance : NULL !!}</a>
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        <a>
                                            {!! isset($list->destination) ? strtoupper($list->destination->loan_number) . ' - ' . $list->destination->amount : NULL !!}
                                        </a>
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div class="label label-inverse">
                                        {!! $list->frequency !!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        {!! \Carbon\Carbon::parse($list->start_date)->toDateTimeString() !!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        {!! \Carbon\Carbon::parse($list->end_date)->toDateTimeString() !!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        {!! number_format($list->amount, 2) !!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        {!! ucwords($list->reason) !!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        {!! ucwords($list->_narrative) !!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div class="label label-info">
                                        {!! strtoupper($list->_status) !!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        {!! \Carbon\Carbon::parse($list->created_at)->diffForHumans() !!}
                                    </div>
                                </td>
                                <td>
                                    @if (!isset($list->deleted_at))
                                    <a href="{!! route('standing.order.show', $list->id) !!}"
                                        id='show-client-enquiry-{!! $list->id !!}' class='btn btn-sm btn-circle btn-info' data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="{!! ucwords(__('Show')) !!}">
                                        <i class='fa fa-btn fa-eye'></i>
                                    </a>
                                    @endif
                                    <a href="{!! route('standing.order.edit', $list->id) !!}"
                                        id='edit-client-enquiry-{!! $list->id !!}' class='btn btn-sm btn-circle btn-inverse' data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="{!! ucwords(__('Edit')) !!}">
                                        <i class='fa fa-btn fa-edit'></i>
                                    </a>
                                    @if (isset($list->deleted_at))
                                        <span data-bs-toggle="tooltip" data-bs-placement="left" title="{!! ucwords(__('Activate')) !!}" onclick="destroy({{ $list->id }}, 'activate')" class='btn btn-sm btn-circle btn-success'><i class="fa fa-btn fa-check"></i></span>
                                    @else
                                        <span data-bs-toggle="tooltip" data-bs-placement="left" title="{!! ucwords(__('Deactivate')) !!}" onclick="destroy({{ $list->id }}, 'deactivate')" class='btn btn-sm btn-circle btn-danger'><i class="fa fa-btn fa-trash"></i></span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <div class="col-md-12">
                                <div class="alert alert-light-primary">
                                    {!! __('no client enquiries found...') !!}
                                </div>
                            </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script language="javascript" type="text/javascript">
    function destroy(id, action) {
        // console.log(id);
        Swal.fire({
            title: 'Provide a reason to ' + action + ' this standing order.',
            input: 'textarea',
            // inputLabel: 'Narrative',
            inputPlaceholder: 'Type your comment here...',
            inputAttributes: {
                'aria-label': 'Type your comment here'
            },
            showCancelButton: true,
            confirmButtonText: action.toUpperCase(),
            showLoaderOnConfirm: true,
            preConfirm: (comment) => {
                const formData = new FormData()
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('_method', 'DELETE');
                formData.append('id', id);
                formData.append('action', action);
                formData.append('_narrative', comment);

                axios.post(
                    '/admin/standing/order/' + id,
                    formData,
                    {
                        headers: {
                            "Content-Type": "x-www-form-urlencoded",
                        }
                    }
                ).then((response) => {
                    Swal.fire({
                        position: 'top-end',
                        icon: response.data.icon,
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 3000
                    });
                }).catch((error) => {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Ops! Server error encountered, please try again!',
                        showConfirmButton: false,
                        timer: 3000
                    });
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                setTimeout(function(){
                    window.location.reload();
                }, 3000);
            }
        });
    }
</script>
@endsection