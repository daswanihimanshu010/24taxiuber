@extends('admin.layout.base')

@section('title', 'Provider Documents ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">@lang('admin.provides.type_allocation')</h4>
                <h5>Driver: <b>{{ $Provider->first_name }} {{ $Provider->last_name }}</b> </h5>
                @can('provider-status')
                @if($Provider->status == 'approved')
                <a style="margin-left: 1em;margin-top: -30px" class="btn btn-danger pull-right"
                    href="{{ route('admin.provider.disapprove', $Provider->id ) }}"><i class="fa fa-power-off"></i>
                    Disable Driver</a>
                @else
                <a style="margin-left: 1em;margin-top: -30px" class="btn btn-success pull-right"
                    href="{{ route('admin.provider.approve', $Provider->id ) }}"><i class="fa fa-check"></i> Approve
                    Driver</a>
                @endcan
                @endif
                <a href="{{$backurl}}" style="margin-left: 1em;margin-top: -30px" class="btn btn-primary pull-right"><i
                        class="fa fa-arrow-left"></i> @lang('admin.back')</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        @if($ProviderService->count() > 0)
                        <hr><h6>Allocated Services :  </h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>@lang('admin.provides.service_name')</th>
                                        <th>@lang('admin.provides.service_number')</th>
                                        <th>@lang('admin.provides.service_model')</th>
                                        <th>@lang('admin.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ProviderService as $service)
                                    <tr>
                                        <td>{{ $service->service_type->name }}</td>
                                        <td>{{ $service->service_number }}</td>
                                        <td>{{ $service->service_model }}</td>
                                        <td>
                                            <form action="{{ route('admin.provider.document.service', [$Provider->id, $service->id]) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger btn-large btn-block">Delete</a>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>@lang('admin.provides.service_name')</th>
                                        <th>@lang('admin.provides.service_number')</th>
                                        <th>@lang('admin.provides.service_model')</th>
                                        <th>@lang('admin.action')</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                        @endif
                        <hr>
                    </div>
                </div>

                <div class="row"> 
                    <form action="{{ route('admin.provider.document.store', $Provider->id) }}" method="POST">
                        {{ csrf_field() }}
                        <div class="col">
                            <select class="form-control bmd-form-group input" name="service_type" required>
                                @forelse($ServiceTypes as $Type)
                                <option value="{{ $Type->id }}">{{ $Type->name }}</option>
                                @empty
                                <option>- Please Create a Service Type -</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col">
                            <input type="text" required name="service_number" class="form-control bmd-form-group" placeholder="Number (CY 98769)">
                        </div>
                        <div class="col">
                            <input type="text" required name="service_model" class="form-control bmd-form-group" placeholder="Model (Audi R8 - Black)">
                        </div>
                        <div class="col">
                            <button class="btn btn-primary btn-block bmd-form-group" type="submit">Update</button>
                        </div>
                    </form>
                </div>

        @can('provider-documents')
        <div class="card">
            <div class="card-header card-header-primary">
                <h5 class="card-title">
                    @lang('admin.provides.provider_documents')<br>
                    @can('provider-status')
                    @if($Provider->status != 'approved')
                    @if($Provider->documents()->count())
                    @if($Provider->documents->last()->status == "ACTIVE")
                    <a class="btn btn-success btn-block"
                        href="{{ route('admin.provider.approve', $Provider->id ) }}">Approve</a>
                    @endif
                    @endif
                    @endcan
                    @endif
                </h5>
            </div>
            @if( Setting::get('demo_mode', 0) == 0)
            @if(count($Provider->documents)>0)
            {{-- <a href="{{route('admin.download', $Provider->id)}}" style="margin-left: 1em;"
                class="btn btn-primary pull-right"><i class="fa fa-download"></i> @lang('admin.provides.download')</a> --}}
            @endif
            @endif
            <div class="card-body">
                <div class="table-responsive">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('admin.provides.document_type')</th>
                            <th>@lang('admin.status')</th>
                            <th>@lang('admin.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Provider->documents as $Index => $Document)
                        <tr>
                            <td>{{ $Index + 1 }}</td>
                            <td>{{ $Document->document->name }}</td>
                            <td>{{ $Document->status }}</td>
                            <td>
                                <div class="input-group-btn">
                                    <a href="{{ route('admin.provider.document.edit', [$Provider->id, $Document->id]) }}"><span class="btn btn-success btn-large">View</span></a>
                                    <button class="btn btn-danger btn-large" form="form-delete">Delete</button>
                                    <form action="{{ route('admin.provider.document.destroy', [$Provider->id, $Document->id]) }}" method="POST" id="form-delete">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>@lang('admin.provides.document_type')</th>
                            <th>@lang('admin.status')</th>
                            <th>@lang('admin.action')</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
                </div>
            </div>
        </div>
        @endcan
        </div>
    </div>
</div>
</div>
@endsection