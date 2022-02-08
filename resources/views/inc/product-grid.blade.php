<div class="h-96 lg:h-full">
    <div class="bg-white">
        <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
          {{-- {{ $products->links() }} --}}
          @if (count($products) > 0)
          @foreach ($products as $product)
              @include('inc.product-card')
          @endforeach
          @else
              <p>No products found</p>
          @endif
    
          <!-- More products... -->
        </div>
    </div>
      
  </div>