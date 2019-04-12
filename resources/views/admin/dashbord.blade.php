@extends('admin.layouts.master')
@section('content')
<div>
    <router-view></router-view>

    <vue-progress-bar></vue-progress-bar>
</div>
@endsection
