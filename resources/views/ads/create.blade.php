@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-8 sm:py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
            <div class="p-6 sm:p-8 lg:p-10">
                <h1 class="text-2xl sm:text-3xl font-extrabold mb-6 text-indigo-700 text-center drop-shadow">Create a New Ad</h1>

                @if ($errors->any())
                    <div class="mb-6">
                        <ul class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-md">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm font-medium">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('ads.store') }}" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    {{-- Image Upload --}}
                    <div class="p-6 border border-gray-200 rounded-xl bg-gray-50">
                        <label class="block font-semibold text-indigo-700 mb-3 text-lg">Upload Images <span class="text-sm text-gray-500 font-normal">(Max 6)</span></label>
                        <input type="file" name="images[]" id="imageInput" multiple accept="image/*" class="hidden">

                        <div id="previewContainer" class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3 sm:gap-4">
                            @for ($i = 0; $i < 6; $i++)
                                <div class="relative border-2 border-dashed border-indigo-300 rounded-xl w-full aspect-square flex items-center justify-center cursor-pointer upload-frame overflow-hidden bg-white hover:bg-indigo-50 transition"
                                     onclick="document.getElementById('imageInput').click()" data-index="{{ $i }}">
                                    <div class="text-center text-indigo-400 pointer-events-none p-1">
                                        <svg class="w-6 h-6 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"></path></svg>
                                        <span class="text-xs font-semibold">Upload</span>
                                    </div>
                                </div>
                            @endfor
                        </div>
                        <small class="text-gray-500 block mt-3">Click a square to add an image. The first image will be the main one.</small>
                    </div>

                    {{-- Ad Details Section --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        {{-- Title --}}
                        <div class="md:col-span-2">
                            <label for="title" class="block font-semibold text-indigo-700 mb-1">Title</label>
                            <input id="title" type="text" name="title" value="{{ old('title') }}" required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 bg-white text-gray-800 font-medium transition shadow-sm">
                        </div>

                        {{-- Description --}}
                        <div class="md:col-span-2">
                            <label for="description" class="block font-semibold text-indigo-700 mb-1">Description</label>
                            <textarea id="description" name="description" required rows="5"
                                      class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 bg-white text-gray-800 font-medium transition shadow-sm">{{ old('description') }}</textarea>
                        </div>

                        {{-- Category --}}
                        <div>
                            <label for="category_id" class="block font-semibold text-indigo-700 mb-1">Category</label>
                            <select id="category_id" name="category_id" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 bg-white text-gray-800 font-medium transition shadow-sm">
                                <option value="">Select a Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Price --}}
                        <div>
                            <label for="price" class="block font-semibold text-indigo-700 mb-1">Price (LKR)</label>
                            <input id="price" type="number" step="0.01" name="price" value="{{ old('price') }}" required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 bg-white text-gray-800 font-medium transition shadow-sm">
                        </div>

                        {{-- Province --}}
                        <div>
                            <label for="province" class="block font-semibold text-indigo-700 mb-1">Province</label>
                            <select id="province" name="province_id" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 bg-white text-gray-800 font-medium transition shadow-sm">
                                <option value="">Select a Province</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}" {{ old('province_id') == $province->id ? 'selected' : '' }}>
                                        {{ $province->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- District --}}
                        <div>
                            <label for="district" class="block font-semibold text-indigo-700 mb-1">District</label>
                            <select id="district" name="district_id" required disabled
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 bg-white text-gray-800 font-medium transition shadow-sm disabled:opacity-60 disabled:bg-gray-100">
                                <option value="">Select a Province first</option>
                            </select>
                        </div>

                        {{-- Contact Email --}}
                        <div>
                            <label for="contact_email" class="block font-semibold text-indigo-700 mb-1">Contact Email</label>
                            <input id="contact_email" type="email" name="contact_email" value="{{ old('contact_email', auth()->user()->email) }}" required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 bg-white text-gray-800 font-medium transition shadow-sm">
                        </div>

                        {{-- Contact Phone --}}
                        <div>
                            <label for="contact_phone" class="block font-semibold text-indigo-700 mb-1">Contact Phone</label>
                            <input id="contact_phone" type="text" name="contact_phone" value="{{ old('contact_phone') }}" required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 bg-white text-gray-800 font-medium transition shadow-sm">
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="flex justify-center pt-4">
                        <button type="submit"
                                class="flex items-center gap-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-indigo-700 hover:to-blue-700 text-white px-10 py-4 rounded-full font-bold text-lg shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                            </svg>
                            Post Your Ad
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('imageInput');
    const previewContainer = document.getElementById('previewContainer');
    const uploadFrames = Array.from(previewContainer.querySelectorAll('.upload-frame'));
    let files = new DataTransfer();

    function updatePreviews() {
        const fileArray = Array.from(files.files);
        uploadFrames.forEach((frame, i) => {
            const file = fileArray[i];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    frame.innerHTML = `
                        <img src="${e.target.result}" class="absolute inset-0 w-full h-full object-cover rounded-xl" />
                        <button type="button" class="absolute top-1 right-1 bg-red-600 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center remove-btn shadow-md" data-index="${i}">×</button>
                    `;
                    frame.classList.add('has-image');
                };
                reader.readAsDataURL(file);
            } else {
                frame.classList.remove('has-image');
                frame.innerHTML = `
                    <div class="text-center text-indigo-400 pointer-events-none p-1">
                        <svg class="w-6 h-6 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"></path></svg>
                        <span class="text-xs font-semibold">Upload</span>
                    </div>
                `;
            }
        });
        imageInput.files = files.files;
    }

    imageInput.addEventListener('change', (e) => {
        const newFiles = Array.from(e.target.files);
        const availableSlots = 6 - files.files.length;

        if (newFiles.length > availableSlots) {
            alert(`You can only upload ${availableSlots} more image(s).`);
        }

        newFiles.slice(0, availableSlots).forEach(file => files.items.add(file));
        updatePreviews();
        imageInput.value = ''; // Clear input to allow re-adding same file
    });

    previewContainer.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-btn')) {
            e.preventDefault();
            const indexToRemove = parseInt(e.target.dataset.index, 10);
            const newFiles = new DataTransfer();
            Array.from(files.files).forEach((file, i) => {
                if (i !== indexToRemove) {
                    newFiles.items.add(file);
                }
            });
            files = newFiles;
            updatePreviews();
        } else if (e.target.closest('.upload-frame')) {
            imageInput.click();
        }
    });

    // Province -> District dependent dropdown
    const provinceSelect = document.getElementById('province');
    const districtSelect = document.getElementById('district');
    const oldDistrict = "{{ old('district_id') }}";

    async function fetchDistricts(provinceId) {
        if (!provinceId) {
            districtSelect.innerHTML = '<option value="">Select a Province first</option>';
            districtSelect.disabled = true;
            return;
        }

        districtSelect.disabled = true;
        districtSelect.innerHTML = '<option value="">Loading...</option>';

        try {
            const res = await fetch(`/api/provinces/${provinceId}/districts`);
            if (!res.ok) throw new Error('Network response was not ok.');
            const data = await res.json();

            districtSelect.innerHTML = '<option value="">Select a District</option>';
            data.forEach(d => {
                const opt = document.createElement('option');
                opt.value = d.id;
                opt.textContent = d.name;
                if (String(d.id) === String(oldDistrict)) {
                    opt.selected = true;
                }
                districtSelect.appendChild(opt);
            });
        } catch (e) {
            console.error("Failed to fetch districts:", e);
            districtSelect.innerHTML = '<option value="">Could not load districts</option>';
        } finally {
            districtSelect.disabled = false;
        }
    }

    provinceSelect?.addEventListener('change', (e) => fetchDistricts(e.target.value));

    if (provinceSelect && provinceSelect.value) {
        fetchDistricts(provinceSelect.value);
    }
});
</script>
@endpush
@endsection
