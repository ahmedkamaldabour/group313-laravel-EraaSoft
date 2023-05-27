@php use App\Models\Product; @endphp
@extends('Admin.inc.master')

@section('title','Products')

@section('css')

@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">All Products</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                @if(session()->has('success'))
                    <div class="alert alert-success mt-3">
                        {{session()->get('success')}}
                    </div>
                @endif

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th style="width: 40px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <img src="{{asset(Product::PATH.$product->image)}}" width="100px" height="100px">
                            </td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>
                                <a href="{{ route( 'products.edit',$product->id ) }}" class="btn btn-info">Edit</a>
                                <form method="post" action="{{route('products.destroy',$product->id)}}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- /.container-fluid -->
            {{$products->links()}}

        </section>
        <!-- /.content -->
    </div>
@endsection

@section('js')

@endsection
