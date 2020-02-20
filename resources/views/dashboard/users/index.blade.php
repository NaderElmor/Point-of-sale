@extends('layouts.dashboard.app')


@section('content')

    <div class="content-wrapper">




        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <section class="content-header">

                        <ol class="breadcrumb">
                             <li><a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a></li>
                             <li class="active">@lang('site.users') <a href="{{route('dashboard.users.index')}}"> </a></li>
                        </ol>

                    </section>

                    <h3 class="box-title">@lang('site.users')</h3>
                    </div>

                <form action="{{route('dashboard.users.index')}}">
                        <div class="row">
                            <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Search" value="{{request()->search}}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-info btn-sm"> <i class="fa fa-search"></i> @lang('site.search') </button>

                                @if(auth()->user()->hasPermission('create_users'))
                                     <a href="{{route('dashboard.users.create')}}" class="btn btn-primary btn-sm">@lang('site.add')  <i class='fa fa-plus'></i> </a>
                                @else
                                     <a href="#" class="btn btn-primary btn-sm disabled">@lang('site.add')  <i class='fa fa-plus'></i> </a>
                                @endif
                            </div>

                        </div>
                    </form>

                    @if($users->count() > 0)
                    <table class="table table-hover">

                        <thead class="bold">
                            <tr>
                                <td>#</td>
                                <td>@lang('site.name')</td>
                                <td>@lang('site.email')</td>
                                <td>@lang('site.action')</td>
                            </tr>


                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>

                                    {{-- //Actions --}}
                                    <td>

                                        @if(auth()->user()->hasPermission('update_users'))
                                         <a href="{{route('dashboard.users.edit', $user->id)}}" class="btn btn-primary">@lang('site.edit') <i class='fa fa-edit'></i> </a>
                                        @else
                                            <a href="#" class="btn btn-primary disabled">@lang('site.edit') <i class='fa fa-edit'></i> </a>
                                        @endif

                                        @if(auth()->user()->hasPermission('delete_users'))
                                            <form action="{{route('dashboard.users.destroy', $user->id)}}" method="POST" style="display: inline-block">

                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger delete"> @lang('site.delete') </button>
                                            </form>
                                        @else
                                            <button type="submit" class="btn btn-danger disabled"> @lang('site.delete') </button>
                                        @endif


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    {{$users->appends(request()->query())->links()}}
                @else
                    <h2> @lang('site.no_data_found')</h2>
                @endif
             
                </div><!-- end of box header -->


    </section><!-- end of content -->

</div><!-- end of content wrapper -->


@endsection
