<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 ">
        <div class="max-w-[70%] mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="grid grid-cols-2">
                    <div class="border border-slate-400 p-3 text-bold">Request</div> 
                    <div class="border border-slate-400 p-3 text-bold">Result</div>
                @foreach($customerOrders as $i => $order)
                    <div class="border border-slate-400 p-3 break-words {{$i%2==0 ? "bg-slate-200" : ""}}">{{$order->order_detail}}</div>
                    <div class="border border-slate-400 p-3 break-words {{$i%2==0 ? "bg-slate-200" : ""}}">{{$order->result}}</div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



  