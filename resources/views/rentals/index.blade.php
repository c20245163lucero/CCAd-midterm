<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment Rental Management</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="container mx-auto px-6 py-10">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-blue-900">
                    Scuba Diving Resort
                </h1>
                <p class="text-gray-600">
                    Equipment Rental Management System
                </p>
            </div>

            <a href="{{ route('rentals.create') }}"
               class="bg-blue-600 text-white px-5 py-3 rounded-lg hover:bg-blue-700">
                + Add New Rental
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-5">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-5">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="bg-white rounded-xl shadow overflow-x-auto">

            <table class="w-full text-left">
                <thead class="bg-blue-900 text-white">
                    <tr>
                        <th class="p-4">Rental ID</th>
                        <th class="p-4">Diver</th>
                        <th class="p-4">Dive Site</th>
                        <th class="p-4">Start Date</th>
                        <th class="p-4">End Date</th>
                        <th class="p-4">Total Charge</th>
                        <th class="p-4">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($rentals as $rental)
                        <tr class="border-b hover:bg-gray-50">

                            <td class="p-4">
                                {{ $rental->id }}
                            </td>

                            <td class="p-4">
                                {{ $rental->diver->diver_name ?? 'N/A' }}
                            </td>

                            <td class="p-4">
                                {{ $rental->diveSite->dive_site_name ?? 'N/A' }}
                            </td>

                            <td class="p-4">
                                {{ $rental->rental_start }}
                            </td>

                            <td class="p-4">
                                {{ $rental->rental_end }}
                            </td>

                            <td class="p-4">
                                ₱{{ number_format((float) $rental->total_charge, 2) }}
                            </td>

                            <td class="p-4">
                                <form action="{{ route('rentals.destroy', $rental->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this rental?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="bg-red-600 text-white px-3 py-2 rounded hover:bg-red-700">
                                        Delete
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-6 text-center text-gray-500">
                                No equipment rentals found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="p-4">
                {{ $rentals->links() }}
            </div>

        </div>

    </div>

</body>
</html>
