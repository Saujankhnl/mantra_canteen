<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantra Canteen</title>
    <style>
        :root {
            --primary: #007bff;
            --background: #f0f4f8;
            --white: #ffffff;
            --gray: #f8f9fa;
            --text: #333;
            --danger: #dc3545;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--background);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        .container {
            background: var(--white);
            margin-top: 40px;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            width: 90%;
            max-width: 900px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h2 {
            margin: 0;
            font-size: 32px;
            color: var(--primary);
            font-weight: bold;
        }

        .lang-toggle {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .lang-toggle form {
            display: inline;
        }

        .lang-toggle button {
            padding: 8px 14px;
            margin: 0 3px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            background-color: var(--gray);
            color: var(--text);
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .lang-toggle button.active {
            background-color: var(--primary);
            color: white;
        }

        .filter-switch {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
            align-items: center;
        }

        .filter-switch label {
            font-weight: 600;
            margin-right: 5px;
            color: var(--text);
        }

        .filter-switch select {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            min-width: 120px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
        }

        th, td {
            padding: 14px;
            text-align: left;
        }

        th {
            background-color: var(--primary);
            color: white;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: var(--gray);
        }

        tr:hover {
            background-color: #eaf1fb;
        }

        .remove-btn {
            padding: 6px 12px;
            background-color: var(--danger);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .remove-btn:hover {
            background-color: #b92b38;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            color: #777;
        }

        .total {
            text-align: right;
            margin-top: 20px;
            font-weight: bold;
            font-size: 18px;
            color: var(--primary);
        }

        @media screen and (max-width: 600px) {
            .filter-switch {
                flex-direction: column;
                align-items: flex-start;
            }

            .filter-switch label {
                margin-top: 10px;
            }

            .lang-toggle {
                top: 10px;
                right: 10px;
            }
        }
    </style>
</head>
<body>

<!-- Language Toggle -->
<div class="lang-toggle">
    <form method="GET" action="{{ route('lang.switch', 'en') }}">
        <button type="submit" class="{{ app()->getLocale() == 'en' ? 'active' : '' }}">English</button>
    </form>
    <form method="GET" action="{{ route('lang.switch', 'ne') }}">
        <button type="submit" class="{{ app()->getLocale() == 'ne' ? 'active' : '' }}">नेपाली</button>
    </form>
</div>

<div class="container">
    <div class="header">
        <h2>Mantra Canteen</h2>
    </div>

    <!-- Filter Section -->
    <form method="GET" action="{{ route('transactions.index') }}" class="filter-switch">
        <input type="hidden" name="locale" value="{{ app()->getLocale() }}">

        <label for="year">Year:</label>
        <select name="year_filter" id="year" onchange="this.form.submit()">
            <option value="all">Year</option>
            @foreach ($years ?? [] as $year)
                <option value="{{ $year }}" {{ request('year_filter') == $year ? 'selected' : '' }}>
                    {{ $year }}
                </option>
            @endforeach
        </select>

        <label for="month">Month:</label>
        <select name="month_filter" id="month" onchange="this.form.submit()">
            <option value="all">Month</option>
            @foreach ($months ?? [] as $num => $month)
                <option value="{{ $num }}" {{ request('month_filter') == $num ? 'selected' : '' }}>
                    {{ app()->getLocale() == 'en' ? $month : \Carbon\Carbon::create()->month($num)->locale('ne')->monthName }}
                </option>
            @endforeach
        </select>

        <label for="date">Day:</label>
        <select name="date_filter" id="date" onchange="this.form.submit()">
            <option value="all">Day</option>
            @foreach ($dates ?? [] as $date)
                <option value="{{ $date }}" {{ request('date_filter') == $date ? 'selected' : '' }}>
                    {{ app()->getLocale() == 'en'
                        ? \Carbon\Carbon::parse($date)->format('F j, Y')
                        : \Carbon\Carbon::parse($date)->locale('ne')->translatedFormat('F j, Y') }}
                </option>
            @endforeach
        </select>
    </form>

    <!-- Transaction Table -->
    <table>
        <tr>
            <th>SN</th>
            <th>Date</th>
            <th>Day</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
        @forelse ($transactions ?? [] as $index => $transaction)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ app()->getLocale() == 'en' ? $transaction->date : \Carbon\Carbon::parse($transaction->date)->locale('ne')->translatedFormat('Y-m-d') }}</td>
                <td>{{ app()->getLocale() == 'en' ? $transaction->day : \Carbon\Carbon::parse($transaction->day)->locale('ne')->dayName }}</td>
                <td>{{ number_format($transaction->amount, 2) }}</td>
                <td><button class="remove-btn" onclick="removeTransaction(this)">हटाउनुहोस्</button></td>
            </tr>
        @empty
            <tr><td colspan="5" class="no-data">{{ __('No data found.') }}</td></tr>
        @endforelse
    </table>

    <div class="total">
        {{ __('Total') }}: {{ isset($total) ? number_format($total, 2) : 'N/A' }}
    </div>
</div>

<script>
    function removeTransaction(button) {
        const row = button.closest('tr');
        const amount = parseFloat(row.cells[3].textContent) || 0;
        row.remove();
        updateTotal(amount);
        updateSerialNumbers();
        checkNoData();
    }

    function updateTotal(removedAmount = 0) {
        let total = 0;
        document.querySelectorAll('table tr').forEach(row => {
            if (row.cells.length > 1) {
                total += parseFloat(row.cells[3]?.textContent) || 0;
            }
        });
        total -= removedAmount;
        document.querySelector('.total').textContent = 'Total: ' + total.toFixed(2);
    }

    function updateSerialNumbers() {
        let index = 0;
        document.querySelectorAll('table tr').forEach(row => {
            if (row.cells.length > 1) {
                row.cells[0].textContent = ++index;
            }
        });
    }

    function checkNoData() {
        const rows = document.querySelectorAll('table tr');
        const hasData = Array.from(rows).some(row => row.cells.length > 1);
        if (!hasData) {
            const tbody = document.querySelector('table');
            tbody.innerHTML = '<tr><td colspan="5" class="no-data">No data found.</td></tr>';
        }
    }

    window.onload = function () {
        updateTotal();
        checkNoData();
    };
</script>

</body>
</html>
