@extends('layouts.app')
@section('content')
    <div class="flex justify-center">
        <div class="w-full bg-white p-6 rounded-lg">
            @if ($wishes==null)
                <p>No items on wishlist</p>
            @else
                @include('inc.product-grid', ['products' => $products])
            @endif
        </div>
    </div>
@endsection