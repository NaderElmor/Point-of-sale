@extends('layouts.dashboard.app')


@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>Admin</h1>

            <ol class="breadcrumb">
               <a href="{{route('dashboard.index')}}"> <li class="active">@lang('site.dashboard')</li></a>
            </ol>
        </section>


        <section class="content">
            <h1>this is dashboard</h1>
        </section>


@endsection
