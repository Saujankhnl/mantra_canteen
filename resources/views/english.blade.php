<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantra Canteen</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary: #4a6bff;
            --primary-light: #e0e6ff;
            --secondary: #6c757d;
            --success: #28a745;
            --danger: #ff4757;
            --warning: #ffc107;
            --info: #17a2b8;
            --light: #f8f9fa;
            --dark: #343a40;
            --white: #ffffff;
            --gray: #e9ecef;
            --text: #2d3436;
            --text-light: #636e72;
            --background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            --card-shadow: 0 10px 30px -15px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--background);
            color: var(--text);
            line-height: 1.6;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .container {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 2rem;
            background: var(--white);
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            position: relative;
            /* Removed overflow: hidden; */
        }

        .container::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, var(--primary), #00d4ff);
        }

        .header {
            text-align: center;
            margin-bottom: 2.5rem;
            position: relative;
        }

        .header h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
            background: linear-gradient(90deg, var(--primary), #00d4ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }

        .header p {
            color: var(--text-light);
            font-size: 1rem;
        }

        .lang-toggle {
            position: absolute;
            top: 0.5rem;
            right: 1rem;
            display: flex;
            gap: 0.5rem;
            z-index: 10;
        }

        .lang-toggle button {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
            background: var(--light);
            color: var(--text);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .lang-toggle button i {
            font-size: 0.9rem;
        }

        .lang-toggle button.active {
            background: var(--primary);
            color: var(--white);
            box-shadow: 0 4px 12px rgba(74, 107, 255, 0.3);
        }

        .lang-toggle button:hover:not(.active) {
            background: var(--gray);
        }

        .filter-section {
            background: var(--light);
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        }

        .filter-switch {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            align-items: center;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            min-width: 150px;
        }

        .filter-switch label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .filter-switch select {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            background: var(--white);
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            transition: var(--transition);
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1rem;
        }

        .filter-switch select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(74, 107, 255, 0.2);
        }

        .filter-switch select:hover {
            border-color: var(--primary-light);
        }

        .data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 2.5rem 0;
            border-radius: 12px;
            /* Removed overflow: hidden; */
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            min-width: 600px; /* Added to ensure table doesn't shrink too much */
        }

        .data-table thead {
            background: linear-gradient(90deg, var(--primary), #4a8dff);
            color: var(--white);
        }

        .data-table th {
            padding: 1.25rem 1.5rem;
            text-align: left;
            font-weight: 600;
            position: relative;
        }

        .data-table th:not(:last-child)::after {
            content: '';
            position: absolute;
            right: 0;
            top: 25%;
            height: 50%;
            width: 1px;
            background: rgba(255, 255, 255, 0.2);
        }

        .data-table td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--gray);
            transition: var(--transition);
            white-space: normal; /* Allow text to wrap */
            word-wrap: break-word; /* Ensure long words break */
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .data-table tr:nth-child(even) {
            background-color: var(--light);
        }

        .data-table tr:hover td {
            background-color: var(--primary-light);
            transform: translateX(4px);
        }

        .action-btn {
            padding: 0.5rem 1rem; /* Reduced padding to decrease button width */
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }

        .remove-btn {
            background: var(--danger);
            color: var(--white);
            box-shadow: 0 2px 5px rgba(220, 53, 69, 0.2);
        }

        .remove-btn:hover {
            background: #e03545;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
        }

        .no-data {
            text-align: center;
            padding: 2rem;
            color: var(--text-light);
            font-size: 1.1rem;
        }

        .total-section {
            display: flex;
            justify-content: flex-end;
            margin-top: 2rem;
            padding: 1.5rem;
            background: var(--light);
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .total-amount {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .total-amount span:first-child {
            color: var(--text-light);
            font-weight: 500;
        }

        .refresh-btn {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            border: none;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(74, 107, 255, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            z-index: 100;
        }

        .refresh-btn:hover {
            transform: rotate(180deg) scale(1.1);
            box-shadow: 0 8px 25px rgba(74, 107, 255, 0.5);
        }

        .floating-notification {
            position: fixed;
            bottom: 1rem;
            left: 50%;
            transform: translateX(-50%);
            padding: 0.75rem 1.5rem;
            background: var(--primary);
            color: white;
            border-radius: 50px;
            font-weight: 500;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transition: var(--transition);
            z-index: 1000;
        }

        .floating-notification.show {
            opacity: 1;
            transform: translateX(-50%) translateY(-10px);
        }

        @media screen and (max-width: 768px) {
            .container {
                margin: 1rem;
                padding: 1.5rem;
                border-radius: 12px;
            }

            .header h2 {
                font-size: 2rem;
                margin-top: 2rem;
            }

            .filter-switch {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-group {
                width: 100%;
            }

            .data-table {
                display: block;
                overflow-x: auto; /* Ensure horizontal scrolling on small screens */
            }

            .lang-toggle {
                top: 0.5rem;
                right: 0.5rem;
            }
        }

        /* Animation for table rows */
        @keyframes fadeInRow {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .data-table tbody tr {
            animation: fadeInRow 0.5s ease-out forwards;
        }

        .data-table tbody tr:nth-child(1) { animation-delay: 0.1s; }
        .data-table tbody tr:nth-child(2) { animation-delay: 0.2s; }
        .data-table tbody tr:nth-child(3) { animation-delay: 0.3s; }
        .data-table tbody tr:nth-child(4) { animation-delay: 0.4s; }
        .data-table tbody tr:nth-child(5) { animation-delay: 0.5s; }
        /* Continue as needed */
    </style>
</head>
<body>

<!-- Language Toggle -->
<div class="lang-toggle">
    <form method="GET" action="{{ route('english', 'en') }}">
        <button type="submit" class="{{ app()->getLocale() == 'en' ? 'active' : '' }}">
            <i class="fas fa-globe"></i> English
        </button>
    </form>
    <form method="GET" action="{{ route('nepali', 'ne') }}">
        <button type="submit" class="{{ app()->getLocale() == 'ne' ? 'active' : '' }}">
            <i class="fas fa-globe-asia"></i> नेपाली
        </button>
    </form>
</div>

<div class="container">
    <div class="header">
        <h2>Mantra Canteen</h2>
        <p>Transaction Management System</p>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <form method="GET" action="{{ route('transactions.index') }}" class="filter-switch">
            <input type="hidden" name="locale" value="{{ app()->getLocale() }}">

            <div class="filter-group">
                <label for="year"><i class="fas fa-calendar-alt"></i> Year:</label>
                <select name="year_filter" id="year" onchange="this.form.submit()">
                    <option value="all">All Years</option>
                    @foreach ($years ?? [] as $year)
                        <option value="{{ $year }}" {{ request('year_filter') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group">
                <label for="month"><i class="fas fa-calendar"></i> Month:</label>
                <select name="month_filter" id="month" onchange="this.form.submit()">
                    <option value="all">All Months</option>
                    @foreach ($months ?? [] as $num => $month)
                        <option value="{{ $num }}" {{ request('month_filter') == $num ? 'selected' : '' }}>
                            {{ app()->getLocale() == 'en' ? $month : \Carbon\Carbon::create()->month($num)->locale('ne')->monthName }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group">
                <label for="date"><i class="fas fa-calendar-day"></i> Day:</label>
                <select name="date_filter" id="date" onchange="this.form.submit()">
                    <option value="all">All Days</option>
                    @foreach ($dates ?? [] as $date)
                        <option value="{{ $date }}" {{ request('date_filter') == $date ? 'selected' : '' }}>
                            {{ app()->getLocale() == 'en'
                                ? \Carbon\Carbon::parse($date)->format('F j, Y')
                                : \Carbon\Carbon::parse($date)->locale('ne')->translatedFormat('F j, Y') }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
    <!-- Transaction Table -->
    <table class="data-table">
        <thead>
            <tr>
                <th>SN</th>
                <th>Date</th>
                <th>Day</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions ?? [] as $index => $transaction)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ app()->getLocale() == 'en' ? $transaction->date : \Carbon\Carbon::parse($transaction->date)->locale('ne')->translatedFormat('Y-m-d') }}</td>
                    <td>{{ app()->getLocale() == 'en' ? $transaction->day : \Carbon\Carbon::parse($transaction->date)->locale('ne')->dayName }}</td>
                    <td>{{ number_format($transaction->amount, 2) }}</td>
                    <td>
                        <button class="action-btn remove-btn" onclick="removeTransaction(this)">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="no-data">{{ __('No transactions found.') }}</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="total-section">
        <div class="total-amount">
            <span>{{ __('Total') }}:</span>
            <span>{{ isset($total) ? number_format($total, 2) : '0.00' }}</span>
        </div>
    </div>
</div>

<button class="refresh-btn" onclick="window.location.reload()">
    <i class="fas fa-sync-alt"></i>
</button>

<div class="floating-notification" id="notification"></div>

<script>
    function removeTransaction(button) {
        const row = button.closest('tr');
        const amount = parseFloat(row.cells[3].textContent) || 0;

        // Add animation before removal
        row.style.transition = 'all 0.3s ease';
        row.style.opacity = '0';
        row.style.transform = 'translateX(100px)';

        setTimeout(() => {
            row.remove();
            updateTotal();
            updateSerialNumbers();
            checkNoData();
            showNotification('Transaction removed successfully', 'success');
        }, 300);
    }

    function updateTotal() {
        let total = 0;
        document.querySelectorAll('.data-table tbody tr').forEach(row => {
            if (row.cells.length > 1) {
                total += parseFloat(row.cells[3]?.textContent.replace(/,/g, '')) || 0;
            }
        });

        const totalElement = document.querySelector('.total-amount span:last-child');
        totalElement.textContent = total.toFixed(2);

        // Add animation to total update
        totalElement.style.transform = 'scale(1.2)';
        setTimeout(() => {
            totalElement.style.transform = 'scale(1)';
        }, 300);
    }

    function updateSerialNumbers() {
        let index = 0;
        document.querySelectorAll('.data-table tbody tr').forEach(row => {
            if (row.cells.length > 1) {
                row.cells[0].textContent = ++index;
            }
        });
    }

    function checkNoData() {
        const rows = document.querySelectorAll('.data-table tbody tr');
        const hasData = Array.from(rows).some(row => row.cells.length > 1);
        const tbody = document.querySelector('.data-table tbody');

        if (!hasData && !tbody.querySelector('.no-data')) {
            tbody.innerHTML = '<tr><td colspan="5" class="no-data">No transactions found.</td></tr>';
        }
    }

    function showNotification(message, type) {
        const notification = document.getElementById('notification');
        notification.textContent = message;
        notification.className = `floating-notification show ${type}`;

        setTimeout(() => {
            notification.classList.remove('show');
        }, 3000);
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateTotal();
        checkNoData();

        // Add hover effect to table rows
        const rows = document.querySelectorAll('.data-table tbody tr');
        rows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(4px)';
            });
            row.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
            });
        });
    });
</script>

</body>
</html>
