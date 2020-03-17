@extends('layouts.master')

@section('page_title')
    Product
@endsection

@section('main')
    <h2>Product</h2>
    @include('backend.partitions.table_view', ['data' => $products ?? null])
@endsection