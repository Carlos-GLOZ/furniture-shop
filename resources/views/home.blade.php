@extends('layouts.app')

@section('content')
    <x-header :title="'Encuentra el mueble que mejor se adapte a ti!'" />
    <x-search_filters />
    <x-product_showcase />
@endsection