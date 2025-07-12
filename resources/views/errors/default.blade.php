@extends('admin.layouts.app')

@section('content')
    <div class="error">
        <div class="error-code m-b-10">403 <i class="fa fa-warning"></i></div>
        <div class="error-content">
            <div class="error-message">Access Denied...</div>
            <div class="error-desc m-b-20">
                The page you're looking for has a restricted access. <br />

            </div>
            <div>
                <a href="{{ url('/admin/dashboard') }}" class="btn btn-success">Go Back to Home Page</a>
            </div>
        </div>
    </div>
@endsection
