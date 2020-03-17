@extends('layouts.master')

@section('page_title')
	News
@endsection

@section('main')
	<h2>News</h2>
	@include('backend.partitions.table_view', ['data' => $news ?? null])
@endsection