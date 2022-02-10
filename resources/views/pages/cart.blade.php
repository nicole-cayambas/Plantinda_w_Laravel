@extends('layouts.app')
@section('content')
<div class="flex flex-col p-2 md:px-12 lg:px-32">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-md w-full sm:rounded-lg">
                @if(count($cart_items) > 0)
                <table class="min-w-full">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                Name
                            </th>
                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                Quantity x Price
                            </th>
                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                Shipping
                            </th>
                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                Total Price
                            </th>
                            <th scope="col" class="relative py-3 px-6">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        @foreach ($cart_items as $cart_item)
                            @php
                                $product = App\Models\Product::find($cart_item->product_id);
                            @endphp
                            <tr class="border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700 dark:border-gray-600">
                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$product->name}} <br> <br> <img src="{{$product->image}}" alt="{{$product->name}} picture" width="100px" height="100px">
                                </td>
                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                    {{$cart_item->quantity}} x Php {{number_format($cart_item->unit_price, 2)}}
                                </td>
                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                    Php {{$cart_item->shipping_price}}
                                </td>
                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                    Php {{$cart_item->total_price}}
                                </td>
                                <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                    <a href="#" class="text-blue-600 dark:text-blue-500 hover:underline">Edit</a><br>
                                    {{-- <a href="{{route('editCartItem'), ['id', $product->id]}}" class="text-blue-600 dark:text-blue-500 hover:underline">Edit</a><br> --}}
                                    <a href="{{route('deleteCartItem', ['id' => $product->id])}}" class="text-red-600 dark:text-red-500 hover:underline">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p>No items in cart</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection