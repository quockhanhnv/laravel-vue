@extends('layouts.master')

@section('page_title')
	Category
@endsection

@section('main')
	<h2>Category</h2>
	<div class="grid-view">
		@include('backend.partitions.table_view', ['data' => $categories ?? null])
	</div>
@endsection