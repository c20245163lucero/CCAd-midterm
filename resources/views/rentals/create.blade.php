
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Equipment Rental</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen">

<div class="max-w-3xl mx-auto px-6 py-10">

    <div class="bg-white rounded-xl shadow-md p-8">
        <h1 class="text-2xl font-bold text-blue-800 mb-2">
            Create Equipment Rental
        </h1>

            Enter the rental details and select the equipment.
        </p>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-5">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
        <p class="text-gray-500 mb-6">
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('rentals.store') }}" method="POST">
            @csrf

            <div class="mb-5">
                <label class="block font-semibold mb-2">Select Diver</label>
                <select name="diver_id" required
                    class="w-full border rounded-lg p-3">
                    <option value="">Choose Diver</option>
                    @foreach ($divers as $diver)
                        <option value="{{ $diver->id }}"
                            {{ old('diver_id') == $diver->id ? 'selected' : '' }}>
                            {{ $diver->diver_name }}
                            ({{ $diver->certification_level }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-5">
                <label class="block font-semibold mb-2">Select Dive Site</label>
                <select name="dive_site_id" required
                    class="w-full border rounded-lg p-3">
                    <option value="">Choose Dive Site</option>
                    @foreach ($diveSites as $site)
                        <option value="{{ $site->id }}"
                            {{ old('dive_site_id') == $site->id ? 'selected' : '' }}>
                            {{ $site->site_name }}
                            ({{ $site->required_max_depth }} meters)
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                <div>
                    <label class="block font-semibold mb-2">Rental Start</label>
                    <input type="date" name="rental_start"
                        value="{{ old('rental_start') }}" required
                        class="w-full border rounded-lg p-3">
                </div>

                <div>
                    <label class="block font-semibold mb-2">Rental End</label>
                    <input type="date" name="rental_end"
                        value="{{ old('rental_end') }}" required
                        class="w-full border rounded-lg p-3">
                </div>
            </div>

            <div class="mb-6">
                <h2 class="font-bold text-lg text-blue-800 mb-3">
                    Available Equipment
                </h2>

                @forelse ($equipment as $item)
                    <label class="flex items-center justify-between border rounded-lg p-4 mb-3 hover:bg-blue-50">
                        <div class="flex items-center gap-3">
                            <input
                                type="checkbox"
                                name="items[][dive_equipment_id]"
                                value="{{ $item->id }}"
                                {{ in_array($item->id, old('items', []) ?? []) ? 'checked' : '' }}
                                class="w-4 h-4 text-blue-600">

                            <div>
                                <p class="font-semibold">
                                    {{ $item->gear_item_name }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    Serial: {{ $item->gear_serial }}
                                </p>
                            </div>
                        </div>

                        <span class="font-semibold text-blue-700">
                            ₱{{ number_format($item->daily_fee, 2) }}/day
                        </span>
                    </label>
                @empty
                    <p class="text-gray-500 bg-gray-100 p-4 rounded-lg">
                        No available equipment at the moment.
                    </p>
                @endforelse
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 rounded-lg font-semibold">
                    Save Rental
                </button>

                <a href="{{ route('rentals.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 px-6 py-3 rounded-lg">
                    Cancel
                </a>
            </div>
        </form>
    </div>

</div>

</body>
</html>
