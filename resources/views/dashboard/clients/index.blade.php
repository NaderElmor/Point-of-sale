@extends('layouts.dashboard.app') @section('content')

<div class="content-wrapper">

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <section class="content-header">

                    <ol class="breadcrumb">
                        <li>
                            <a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a>
                        </li>
                        <li class="active">@lang('site.clients')
                            <a href="{{route('dashboard.clients.index')}}"></a>
                        </li>
                    </ol>

                </section>

                <h3 class="box-title">@lang('site.clients')</h3>
                 {{-- <span class="label label-success ">{{$clients->total()}}</span> --}}
            </div>

            <form action="{{route('dashboard.clients.index')}}">
                <div class="row">
                    <div class="col-md-4">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search"
                            value="{{request()->search}}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-info btn-sm">
                            <i class="fa fa-search"></i>
                            @lang('site.search')
                        </button>

                        @if(auth()->user()->hasPermission('create_clients'))
                        <a
                            href="{{route('dashboard.clients.create')}}"
                            class="btn btn-primary btn-sm">@lang('site.add')
                            <i class='fa fa-plus'></i>
                        </a>
                        @else
                        <a href="#" class="btn btn-primary btn-sm disabled">@lang('site.add')
                            <i class='fa fa-plus'></i>
                        </a>
                        @endif
                    </div>

                </div>
            </form>

            @if($clients->count() > 0)
            <table class="table table-hover">

                <thead class="bold">
                    <tr>
                        <td>#</td>
                        <td>@lang('site.name')</td>
                        <td>@lang('site.address')</td>
                        <td>@lang('site.phone')</td>
                        <td>@lang('site.action')</td>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($clients as $index=>$client)
                    <tr>
                        <td>{{$index + 1 }}</td>
                        <td>{{$client->name}}</td>
                        <td>{{$client->address}}</td>
                        <td>{{ $client->phone }}</td>


                        {{-- //Actions --}}
                        <td>

                          @if(auth()->user()->hasPermission('update_clients'))
                            <a
                                href="{{route('dashboard.clients.edit', $client->id)}}"
                                class="btn btn-primary">@lang('site.edit')
                                <i class='fa fa-edit'></i>
                            </a>
                            @else
                            <a href="#" class="btn btn-primary disabled">@lang('site.edit')
                                <i class='fa fa-edit'></i>
                            </a>
                            @endif @if(auth()->user()->hasPermission('delete_clients'))
                            <form
                                action="{{route('dashboard.clients.destroy', $client->id)}}"
                                method="POST"
                                style="display: inline-block">

                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button type="submit" class="btn btn-danger delete">
                                    <i class="fa fa-remove"></i>
                                    @lang('site.delete')
                                </button>
                            </form>
                            @else
                            <button type="submit" class="btn btn-danger disabled">
                                @lang('site.delete')
                            </button>
                            @endif

                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
            {{ $clients->appends(request()->query())->links() }}
            @else
            <h2>
                @lang('site.no_data_found')</h2>
            @endif

        </div>
        <!-- end of box header -->

    </section>
    <!-- end of content -->

</div>
<!-- end of content wrapper -->

@endsection