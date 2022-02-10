<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@if (count($errors)>0)
    @foreach ($errors->all() as $error)
    <div class="p-4 bg-red-200" role="alert">
        {{$error}}
    </div>
    @endforeach
@endif

@if (session('success'))
<div class="p-2 flex justify-center w-full" role="alert">
    <p class="p-2 bg-green-300 rounded-lg w-full sm:w-1/2 text-center">{{session('success')}}<p>
</div>
@endif

@if (session('error'))
<div class="p-2 flex justify-center w-ful" role="alert">
    <p class="p-2 bg-red-300 rounded-lg w-full sm:w-1/2 text-center">{{session('error')}}</p>
</div>
@endif