@extends('layouts.layout')

@section('header')
<x-header>
    <x-status />
</x-header>
@endsection

@section('content')
<div class="flex gap-5 p-8 flex-wrap">
    <!-- Progress Status -->
    <div class="bg-white p-4 rounded-3xl flex-1 ">
        <div class="flex justify-between items-center mb-5">
            <h4 class="font-semibold">All transactions</h4>
            <div class="flex gap-1.5 p-1 rounded-full chart">
                <input type="radio" class="hidden" name="btnradio" id="btnradio1" autocomplete="off" value="12" checked>
                <label class="cursor-pointer py-1 px-3 text-xs text-black bg-white rounded-full font-semibold transition-all duration-300" for="btnradio1">1Y</label>

                <input type="radio" class="hidden" name="btnradio" id="btnradio6" autocomplete="off" value="6">
                <label class="cursor-pointer py-1 px-3 text-xs text-black bg-white rounded-full font-semibold transition-all duration-300" for="btnradio6">6M</label>

                <input type="radio" class="hidden" name="btnradio" id="btnradio3" autocomplete="off" value="3">
                <label class="cursor-pointer py-1 px-3 text-xs text-black bg-white rounded-full font-semibold transition-all duration-300" for="btnradio3">3M</label>
            </div>
        </div>

        <div class="flex mb-7 gap-4">
            <div class="flex-1 text-center">
                <h5 class="font-bold text-xl">RM</h5>
                <h2 class="text-3xl font-normal" id="spending-total">0.00</h2>
                <p class="text-xs text-gray-500">Spending</p>
            </div>
            <div class="w-0.5 h-18 bg-gray-200"></div>
            <div class="flex-1 text-center">
                <h5 class="font-bold text-xl">RM</h5>
                <h2 class="text-3xl font-normal" id="saving-total">0.00</h2>
                <p class="text-xs text-gray-500">Saving</p>
            </div>
        </div>

        <div>
            <canvas id="myChart" width="150" height="150" class="border"></canvas>
        </div>
    </div>

    <!-- Popular -->
    <div class="relative bg-white p-4 rounded-3xl flex-1">
        <div class="mb-3 flex justify-between items-center">
            <h4 class="font-semibold">Recent</h4>
        </div>

        <div class="flex flex-col gap-2" id="recentTransactions">
            @if($recentTransactions->isEmpty())
            <p>Transaction Empty</p>
        @else
            @foreach ($recentTransactions as $newTransaction)
            <a href="{{route('transactions.edit', $newTransaction->id)}}">
                <div class="flex justify-between items-center border-b py-2">
                    <div>
                        <h5 class="text-black font-bold">{{ $newTransaction->title }}</h5>
                        <p class="text-sm text-gray-500">{{ $newTransaction->date->format('d M, Y') }}</p>
                    </div>
                    <div class="text-right">
                        <span class="{{ $newTransaction->type === 'Income' ? 'text-green-500' : 'text-red-500' }}">
                            RM {{ number_format($newTransaction->amount, 2) }}
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        @endif
    </div>
      
        <a href="{{ route('transactions.index') }}">
            <button class="w-11/12 bg-[#031224] text-white py-1.5 px-4 rounded-lg flex items-center justify-center absolute bottom-5 left-1/2 transform -translate-x-1/2">
                All <i class='bx bx-right-arrow-alt'></i>
            </button>
        </a>
    </div>

    <!-- Upcoming -->
    <div class="bg-white p-4 rounded-3xl flex-1">
        <div class="mb-10 flex justify-between items-center">
            <h4 class="font-semibold">Events</h4>
        </div>
    
        <!-- Date Selection -->
        <div class="flex justify-between mb-10" id="dateSelection">
            <!-- Dates will be dynamically inserted here -->
        </div>
    
        <!-- Event List -->
        <div class="flex flex-col gap-2" id="eventList">
            <!-- Events will be dynamically inserted here -->
        </div>
    </div>
    
</div>

{{-- chart --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const spendingData = @json($spending); // Data for spending
    const savingData = @json($saving); // Data for saving

    // Function to get data based on the selected period
    function getDataForPeriod(period) {
        // Filter the data by the selected period (1Y, 6M, 3M)
        let now = new Date();
        let startDate = new Date(now.setMonth(now.getMonth() - period));
        return transactions.filter((t) => new Date(t.date) >= startDate);
    }

    // Prepare the data for the chart
    let months = spendingData.map(data => data.month);
    let spendingAmounts = spendingData.map(data => data.total_amount);
    console.log(spendingAmounts);
    let savingAmounts = savingData.map(data => data.total_amount);

    // Initialize Chart.js
    let ctx = document.getElementById('myChart').getContext('2d');
    let myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'Spending',
                    data: spendingAmounts,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                },
                {
                    label: 'Saving',
                    data: savingAmounts,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                }
            ]
        },
        options: {
            scales: {
                y: {
                    grid: {
                        display: false // Disable Y-axis gridlines
                        },
                    beginAtZero: true
                },
                x: {
                    grid: {
                        display:false
                    },
                }
            }
        }
    });

    // Update the total amount for Spending and Saving
    function updateTotals() {
        let totalSpending = spendingAmounts.reduce((acc, value) => acc + parseFloat(value), 0);
        let totalSaving = savingAmounts.reduce((acc, value) => acc + parseFloat(value), 0);

        document.getElementById('spending-total').textContent = totalSpending.toFixed(2);
        document.getElementById('saving-total').textContent = totalSaving.toFixed(2);
    }

    // Call the function to set the initial totals
    updateTotals();

    // Optionally, if you want to handle radio button clicks and update the chart data
    document.querySelectorAll('input[name="btnradio"]').forEach(radio => {
        radio.addEventListener('change', function () {
            let period;
            switch (this.id) {
                case 'btnradio1y':
                    period = 12; // 1 year
                    break;
                case 'btnradio6m':
                    period = 6; // 6 months
                    break;
                case 'btnradio3m':
                    period = 3; // 3 months
                    break;
            }

            let filteredData = getDataForPeriod(period);
            myChart.data.datasets[0].data = filteredData.spendingAmounts;
            myChart.data.datasets[1].data = filteredData.savingAmounts;
            myChart.update();

            updateTotals();
        });
    });
});

</script>


{{-- event list --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const events = @json($events);
    const today = new Date('{{ $today }}');

    // Function to format date as 'YYYY-MM-DD'
    function formatDate(date) {
        const year = date.getFullYear();
        const month = ('0' + (date.getMonth() + 1)).slice(-2);
        const day = ('0' + date.getDate()).slice(-2);
        return `${year}-${month}-${day}`;
    }

    // Get dates for today ± 2 days
    function getDates() {
        const dates = [];
        for (let i = -2; i <= 2; i++) {
            const date = new Date(today);
            date.setDate(today.getDate() + i);
            dates.push(date);
        }
        return dates;
    }

    // Render date selection buttons
function renderDateSelection() {
    const dateSelection = document.getElementById('dateSelection');
    dateSelection.innerHTML = ''; // Clear existing content

    getDates().forEach((date, index) => {
        const formattedDate = formatDate(date);
        const button = document.createElement('button');
        button.classList.add('btn-date');
        if (index === 2) {
            button.classList.add('selected'); // Highlight today's date
        }
        button.textContent = date.toLocaleDateString('default', { month: 'short', day: 'numeric' });

        // Add click event to update events and highlight the selected date
        button.addEventListener('click', () => {
            renderEvents(formattedDate);

            // to highlight selected date
            document.querySelectorAll('.btn-date').forEach(btn => btn.classList.remove('selected'));
            button.classList.add('selected');
        });

        dateSelection.appendChild(button);
    });

}

    // Render events for the selected date
    function renderEvents(selectedDate) {
        const eventList = document.getElementById('eventList');
        eventList.innerHTML = ''; // Clear existing events

        // Filter events by selected date
        const filteredEvents = events.filter(event => formatDate(new Date(event.date)) === selectedDate);
        console.log(`Filtered events for ${selectedDate}:`, filteredEvents);        
        
        if (filteredEvents.length === 0) {
            const noEventMessage = document.createElement('p');
            noEventMessage.textContent = 'No events for this date.';
            noEventMessage.classList.add('text-gray-500', 'text-sm');
            eventList.appendChild(noEventMessage);
            return;
        }

        // Display events for the selected date
        filteredEvents.forEach(event => {
            const eventDiv = document.createElement('div');
            eventDiv.classList.add('p-3', 'bg-gray-100', 'rounded-lg');

            const eventIcon = document.createElement('i');
            eventIcon.classList.add('bx', 'bx-time-five', 'mr-2', 'text-2xl'); // Add the icon

            const eventTitle = document.createElement('h5');
            eventTitle.textContent = event.title;
            eventTitle.classList.add('font-semibold');

            const eventLocation = document.createElement('p');
            eventLocation.textContent = `Location: ${event.location}`;
            eventLocation.classList.add('text-sm', 'text-gray-500', 'ml-auto');

                // Create a container for the icon and title
            const eventInfo = document.createElement('div');
            eventInfo.classList.add('flex', 'items-center');
            eventInfo.appendChild(eventIcon);
            eventInfo.appendChild(eventTitle);
            eventInfo.appendChild(eventLocation);

            eventDiv.appendChild(eventInfo);
            eventList.appendChild(eventDiv);
        });
    }

    // Initialize the display with today's date and events
    renderDateSelection();
    renderEvents(formatDate(today));
    console.log('Events:', events);

});

</script>


@endsection
