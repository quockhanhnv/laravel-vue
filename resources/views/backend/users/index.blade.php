@extends('layouts.master')

@section('page_title')
    User
@endsection

@section('main')
	<h2>User</h2>
	@include('backend.partitions.table_view', ['data' => $users ?? null])
@endsection