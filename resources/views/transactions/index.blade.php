@extends('layouts.layout')

@section('header')
<x-header>
</x-header>
@endsection

       
    
@section('content')
<div class="content-wrapper p-6">
    @if (session('success'))
    <p class="bg-green-500 text-white p-2 rounded mb-4">{{ session('success') }}</p>
    @endif
    <div class="flex justify-between mb-3">
        <div class="text-white ml-3">
            Manage transaction
        </div>
        <div class="mb-3">
        <a href="{{ route('transactions.create') }}" class=" bg-teal-900 text-white p-3 rounded hover:bg-teal-600 transition">Add Transaction</a>
        </div>
    </div>
    <!-- Table -->
    <table class="min-w-full bg-[#1e293b] rounded-lg overflow-hidden shadow-lg" id="myTable2">
        <thead class="bg-[#031224] text-white">
            <tr>
                <th class="py-3 px-4 text-center">#</th>
                <th class="py-3 px-4 text-center">Title</th>
                <th class="py-3 px-4 text-center">Type</th>
                <th class="py-3 px-4 text-center">Category</th>
                <th class="py-3 px-4 text-center">Amount</th>
                <th class="py-3 px-4 text-center">Date</th>
                <th class="py-3 px-4 text-center">Attachment</th>
                <th class="py-3 px-4 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="text-white">
            @foreach ($transactions as $transaction)
            <tr class="border-b border-[#1e293b] hover:bg-[#b461f4] transition duration-300 text-center">
                <td class="py-3 px-4">{{ $transaction->id }}</td>
                <td class="py-3 px-4">{{ $transaction->title }}</td>
                <td class="py-3 px-4">{{ $transaction->type }}</td>
                <td class="py-3 px-4">{{ $transaction->transactionCategory->name }}</td>
                <td class="py-3 px-4">{{ $transaction->amount ?? 'Free' }}</td>
                <td class="py-3 px-4">{{ $transaction->getDateMonth($transaction->date) }}</td>
                <td class="py-3 px-4">
                    @if($transaction->attachment)
                        <a href="{{asset('storage/' . $transaction->attachment)}}" target="_blank">
                            <i class='bx bx-image text-3xl'></i>
                        </a>
                    @else
                        No Attachment
                    @endif
                </td>
                <td class="py-3 px-4 flex justify-center">
                    <a href="{{ route('transactions.edit', $transaction->id) }}" class=" bg-teal-900 text-white py-1 px-3 rounded hover:bg-teal-600 transition">Edit</a>
                    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" onclick="return confirmDelete({{$transaction->id}})" class="bg-red-800 text-white py-1 px-3 rounded hover:bg-red-500 transition ml-2">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

 <script>
    function confirmDelete(id) {
     return confirm('Are you sure you want to delete this apparel? This action cannot be undone.') 
        // event.preventDefault();
    // return true;
}


 </script>
    @endsection





