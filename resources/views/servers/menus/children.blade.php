@extends('layouts.serverLayout')

@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection


@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('assets/servers/js/library/menu.js')}}"></script>

@endsection


@section('content')
@php
$url = $config['method'] == 'children' ? route('menu.save.children', $menu->id) : route('menu.update', 0 );
@endphp

{!! Form::open(['method' => 'PUT', 'url' => $url, 'files' => true]) !!}
<div class="body d-flex py-3">

    <div class="container-xxl">

        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div
                    class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="fw-bold mb-0">{{$config['seo']['title'] . ' ' . $menu->languages->first()->pivot->name}}
                    </h3>
                    <button type="submit"
                        class="btn btn-primary py-2 px-5 text-uppercase btn-set-task w-sm-100">{{__('messages.saveButton')}}
                </div>
            </div>
        </div> <!-- Row end  -->



        <div class="row g-3 mb-3 justify-content-center ">

            @include('servers.includes.messageError')
            {{-- Aside --}}
            @include('servers.menus.blocks.aside')

            <div class="col-lg-8">
                {{-- List --}}
                @include('servers.menus.blocks.list')

            </div>

        </div><!-- Row end  -->

    </div>
</div>
{!! Form::close() !!}

@include('servers.menus.blocks.popup')
@endsection