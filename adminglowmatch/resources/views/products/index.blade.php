@extends('layouts.master')

@push('css')
<link rel="stylesheet" href="{{ asset('/AdminLTE-2/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endpush

@section('title')
    Products
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Products</li>
@endsection

@section('content')
<div class="container mt-4">
        <h2 class="text-center mb-4">Product List</h2>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Skin Type</th>
                    <th>Concern Type</th>
                    <th>Product Type</th>
                    <th>Key Ingredients</th>
                    <th>Short Description</th>
                    <th>More Description</th>
                    <th>Product Benefits</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->ProductID }}</td>
                    <td>{{ $product->ProductName }}</td>
                    <td>{{ $product->SkinType }}</td>
                    <td>{{ $product->ConcernType }}</td>
                    <td>{{ $product->ProductType }}</td>
                    <td>{{ $product->KeyIngredients }}</td>
                    <td>{{ $product->ShortDesrciption }}</td>
                    <td>{{ $product->MoreDescription }}</td>
                    <td>{{ $product->ProductBenefits }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->ProductID) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('products.destroy', $product->ProductID) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
