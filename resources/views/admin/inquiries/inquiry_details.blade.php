@extends('admin.admin_app')
@push('styles')
@endpush
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8 col-sm-8 col-xs-8">
        <h2> Inquiry Details </h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('admin') }}">Inquiries</a>
            </li>
            <li class="breadcrumb-item active">
                <strong> Inquiry Details </strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 col-sm-4 col-xs-4 text-right">
        <a class="btn btn-primary t_m_25" href="{{ url()->previous() }}">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
            Go Back
        </a>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-container">
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active show" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="ibox">
                                    <div class="row ibox-content" style="border: none !important;">
                                        <div class="col-md-12">
                                            <div class="ibox-title" style="border: none !important;">
                                                <h5>Inquiry Details</h5>
                                                <h5 class="float-right">{{ date_formated($inquiry->created_at) }}</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <div>
                                                    <div class="feed-activity-list">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="row">
                                                                    <strong class="col-sm-2 col-form-label">Name</strong>
                                                                    <div class="col-sm-4 col-form-label">
                                                                        {{$inquiry->name}}
                                                                    </div>
                                                                    <strong class="col-sm-3 col-form-label">Company</strong>
                                                                    <div class="col-sm-3 col-form-label">
                                                                        {{$inquiry->company ?? 'N/A'}}
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <strong class="col-sm-2 col-form-label">Email</strong>
                                                                    <div class="col-sm-4 col-form-label text-danger">
                                                                        {{$inquiry->email}}
                                                                    </div>
                                                                    <strong class="col-sm-3 col-form-label">Phone</strong>
                                                                    <div class="col-sm-3 col-form-label">
                                                                        {{$inquiry->phone}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="ibox-title" style="border: none !important;">
                                                <h5>Message</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <div>
                                                    <div class="feed-activity-list">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-form-label">
                                                                        {{ $inquiry->message ? $inquiry->message : 'N/A'}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
@endpush