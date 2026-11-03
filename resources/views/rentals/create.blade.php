<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Equipment Rental</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="container mx-auto px-6 py-10 max-w-4xl">

        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('rentals.index') }}"
               class="text-blue-600 hover:underline">
                ← Back to Rentals
            </a>

            <h1 class="text-3xl font-bold text-blue-900 mt-4">
                Add New Equipment Rental
            </h1>

            <p class="text-gray-600 mt-2">
                Enter the diver, dive site, and rental information.
            </p>
        </div>

        <!-- Form Card -->
        <div class="bg-white shadow-lg rounded-xl p-8">

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
                    <strong>Please fix the following errors:</strong>

                    <ul class="list-disc ml-6 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('rentals.store') }}" method="POST">

                @csrf

                <!-- Diver -->
                <div class="mb-6">
                    <label class="block font-semibold text-gray-700 mb-2">
                        Select Diver
                    </label>

                    <select name="diver_id"
                            class="w-full border border-gray-300 rounded-lg p-3"
                            required>

                        <option value="">-- Select Diver --</option>

                        @foreach ($divers as $diver)
                            <option value="{{ $diver->id }}"
                                {{ old('diver_id') == $diver->id ? 'selected' : '' }}>
                                {{ $diver->diver_name }}
                                - {{ $diver->certification_level }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <!-- Dive Site -->
                <div class="mb-6">
                    <label class="block font-semibold text-gray-700 mb-2">
                        Select Dive Site
                    </label>

                    <select name="dive_site_id"
                            class="w-full border border-gray-300 rounded-lg p-3"
                            required>

                        <option value="">-- Select Dive Site --</option>

                        @foreach ($diveSites as $site)
                            <option value="{{ $site->id }}"
                                {{ old('dive_site_id') == $site->id ? 'selected' : '' }}>
                                {{ $site->dive_site_name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <!-- Rental Start -->
                <div class="mb-6">
                    <label class="block font-semibold text-gray-700 mb-2">
                        Rental Start Date
                    </label>

                    <input type="date"
                           name="rental_start"
                           value="{{ old('rental_start') }}"
                           class="w-full border border-gray-300 rounded-lg p-3"
                           required>
                </div>

                <!-- Rental End -->
                <div class="mb-6">
                    <label class="block font-semibold text-gray-700 mb-2">
                        Rental End Date
                    </label>

                    <input type="date"
                           name="rental_end"
                           value="{{ old('rental_end') }}"
                           class="w-full border border-gray-300 rounded-lg p-3"
                           required>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-3 mt-8">

                    <a href="{{ route('rentals.index') }}"
                       class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600">
                        Cancel
                    </a>

                    <button type="submit"
                            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                        Save Rental
                    </button>

                </div>

            </form>

        </div>

    </div>

</body>
</html>
