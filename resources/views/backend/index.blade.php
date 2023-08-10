<x-guest-layout>

    <div class="grid grid-cols-2">
        <div class="border border-slate-400 p-3 text-bold">Request</div> 
        <div class="border border-slate-400 p-3 text-bold">Result</div>
    @foreach($customerOrders as $i => $order)
        <div class="border border-slate-400 p-3 break-words {{$i%2==0 ? "bg-slate-200" : ""}}">{{$order->order_detail}}</div>
        <div class="border border-slate-400 p-3 break-words {{$i%2==0 ? "bg-slate-200" : ""}}">{{$order->result}}</div>
    @endforeach
</x-guest-layout>    