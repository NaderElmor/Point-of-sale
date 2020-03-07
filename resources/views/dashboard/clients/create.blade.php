@extends('layouts.dashboard.app') @section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.clients')</h1>

        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard.welcome') }}">
                    <i class="fa fa-dashboard"></i>
                    @lang('site.dashboard')</a>
            </li>
            <li>
                <a href="{{ route('dashboard.clients.index') }}">
                    @lang('site.clients')</a>
            </li>
            <li class="active">@lang('site.add')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">@lang('site.add')</h3>
            </div>
            <!-- end of box header -->

            <div class="box-body">

                @include('partials._errors')

                <div class="col-sm-6">
                <form action="{{ route('dashboard.clients.store') }}" method="post">

                    {{ csrf_field() }}
                    {{ method_field('post') }}

                    <div class="form-group">

                        <label>@lang('site.name')</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">

                        <label>@lang('site.address')</label>
                        <textarea name="address" class="form-control" >{{ old('address')}}</textarea>

                        <label>@lang('site.phone')</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">


                         


                    </div>
                    <!-- /.col -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus"></i>
                            @lang('site.add')</button>
                    </div>
                </div>
                <!-- /.row -->
                <!-- END CUSTOM TABS -->

            </form>
        </div>
            <!-- end of form -->

        </div>
        <!-- end of box body -->

    </div>
    <!-- end of box -->

</section>
<!-- end of content -->

</div>
<!-- end of content wrapper -->

@endsection