@extends("home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">Public</a></li>
        <li><a href="#">Modules</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Modules - Table <small>modules data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('modules.create') }}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            <a href="{{ url('modulesreport') }}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">DataTable - Autofill</h4>
                </div>
                <div class="panel-body">
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($modulesdata as $modules)
                            <tr>
                                <td class='table-text'><div>{{ $modules->name }}</div></td>
                                <td class='table-text'><div>{{ $modules->description }}</div></td>
                                <td>
                                        <a href="{{ route('modules.edit',$modules->id) }}" id='edit-modules-{{ $modules->id }}' class='btn btn-warning'>
                                            <i class='fa fa-btn fa-edit'></i>
                                        </a>
                <form action="{{ route('modules.destroy',$modules->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type='submit' id='delete-modules-{{ $modules->id }}' class='btn btn-danger'>
                                            <i class='fa fa-btn fa-trash'></i>
                                        </button>
                </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection