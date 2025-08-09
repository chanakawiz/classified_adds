@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-12 bg-white/90 rounded-2xl shadow-2xl p-10 border border-indigo-100">
    <h1 class="text-3xl font-extrabold mb-8 text-indigo-700 text-center drop-shadow">Create a New Ad</h1>

    @if ($errors->any())
        <div class="mb-6">
            <ul class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('ads.store') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf

        {{-- Image Upload --}}
        <div>
            <label class="block font-semibold text-indigo-700 mb-3">Upload Images <span class="text-xs text-gray-500">(Max 6)</span></label>
            <input type="file" name="images[]" id="imageInput" multiple accept="image/*" class="hidden">

            <div id="previewContainer" class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                @for ($i = 0; $i < 6; $i++)
                    <div class="relative border-2 border-dashed border-indigo-300 rounded-xl w-full aspect-square flex items-center justify-center cursor-pointer upload-frame overflow-hidden bg-indigo-50 hover:bg-indigo-100 transition"
                         onclick="document.getElementById('imageInput').click()" data-index="{{ $i }}">
                        <span class="text-indigo-300 text-xs text-center pointer-events-none">Click to Upload</span>
                    </div>
                @endfor
            </div>
            <small class="text-gray-500 block mt-2">Click a square to add or replace an image. Max 6 images.</small>
        </div>

        {{-- Title --}}
        <div>
            <label class="block font-semibold text-indigo-700 mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" required
                   class="w-full border border-indigo-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 bg-indigo-50 text-gray-800 font-medium transition">
        </div>

        {{-- Description --}}
        <div>
            <label class="block font-semibold text-indigo-700 mb-1">Description</label>
            <textarea name="description" required rows="4"
                      class="w-full border border-indigo-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 bg-indigo-50 text-gray-800 font-medium transition">{{ old('description') }}</textarea>
        </div>

        {{-- Category --}}
        <div>
            <label class="block font-semibold text-indigo-700 mb-1">Category</label>
            <select name="category_id" required
                    class="w-full border border-indigo-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 bg-indigo-50 text-gray-800 font-medium transition">
                <option value="">Select a Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Location --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-semibold text-indigo-700 mb-1">Province</label>
                <select name="province_id" id="province" required
                        class="w-full border border-indigo-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 bg-indigo-50 text-gray-800 font-medium transition">
                    <option value="">Select a Province</option>
                    @foreach ($provinces as $province)
                        <option value="{{ $province->id }}" {{ old('province_id') == $province->id ? 'selected' : '' }}>
                            {{ $province->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-semibold text-indigo-700 mb-1">District</label>
                <select name="district_id" id="district" required
                        class="w-full border border-indigo-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 bg-indigo-50 text-gray-800 font-medium transition">
                    <option value="">Select a District</option>
                </select>
            </div>
        </div>

        {{-- Price --}}
        <div>
            <label class="block font-semibold text-indigo-700 mb-1">Price (LKR)</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                   class="w-full border border-indigo-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 bg-indigo-50 text-gray-800 font-medium transition">
        </div>

        {{-- Contact Email --}}
        <div>
            <label class="block font-semibold text-indigo-700 mb-1">Contact Email</label>
            <input type="email" name="contact_email" value="{{ old('contact_email') }}"
                   class="w-full border border-indigo-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 bg-indigo-50 text-gray-800 font-medium transition">
        </div>

        {{-- Contact Phone --}}
        <div>
            <label class="block font-semibold text-indigo-700 mb-1">Contact Phone</label>
            <input type="text" name="contact_phone" value="{{ old('contact_phone') }}"
                   class="w-full border border-indigo-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 bg-indigo-50 text-gray-800 font-medium transition">
        </div>

        {{-- Submit --}}
        <div class="flex justify-center">
            <button type="submit"
                    class="flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-indigo-700 hover:to-blue-700 text-white px-8 py-3 rounded-full font-bold shadow-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <!-- Plus icon -->
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Post Ad
            </button>
        </div>
    </form>
</div>

<script>
    const imageInput = document.getElementById('imageInput');
    const previewContainer = document.getElementById('previewContainer');
    let selectedFiles = [];

    imageInput.addEventListener('change', function (e) {
        const newFiles = Array.from(e.target.files);

        if ((selectedFiles.length + newFiles.length) > 6) {
            alert("You can upload up to 6 images.");
            imageInput.value = "";
            return;
        }

        newFiles.forEach(file => {
            if (selectedFiles.length >= 6) return;

            const fileId = Date.now() + Math.random();
            selectedFiles.push({ id: fileId, file });

            const reader = new FileReader();
            reader.onload = function (event) {
                const emptyFrame = previewContainer.querySelector('.upload-frame:not(.has-image)');
                if (emptyFrame) {
                    emptyFrame.innerHTML = `
                        <img src="${event.target.result}" class="absolute inset-0 w-full h-full object-cover rounded-xl" />
                        <button type="button" class="absolute top-2 right-2 bg-red-600 text-white text-xs w-6 h-6 rounded-full flex items-center justify-center remove-btn shadow" data-id="${fileId}">×</button>
                    `;
                    emptyFrame.classList.add('has-image');
                }
            };
            reader.readAsDataURL(file);
        });

        updateFileInput();
    });

    previewContainer.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-btn')) {
            const id = e.target.getAttribute('data-id');
            selectedFiles = selectedFiles.filter(f => f.id != id);

            const frame = e.target.closest('.upload-frame');
            frame.classList.remove('has-image');
            frame.innerHTML = '<span class="text-indigo-300 text-xs text-center pointer-events-none">Click to Upload</span>';

            updateFileInput();
        }
    });

    function updateFileInput() {
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(fileObj => dataTransfer.items.add(fileObj.file));
        imageInput.files = dataTransfer.files;
    }

    // Province -> District dependent dropdown
    const provinceSelect = document.getElementById('province');
    const districtSelect = document.getElementById('district');
    const oldDistrict = "{{ old('district_id') }}";

    async function fetchDistricts(provinceId) {
        districtSelect.innerHTML = '<option value="">Loading...</option>';
        try {
            const res = await fetch(`/api/provinces/${provinceId}/districts`);
            const data = await res.json();
            districtSelect.innerHTML = '<option value="">Select a District</option>';
            data.forEach(d => {
                const opt = document.createElement('option');
                opt.value = d.id;
                opt.textContent = d.name;
                if (String(d.id) === String(oldDistrict)) opt.selected = true;
                districtSelect.appendChild(opt);
            });
        } catch (e) {
            districtSelect.innerHTML = '<option value="">Select a District</option>';
        }
    }

    provinceSelect?.addEventListener('change', (e) => {
        const val = e.target.value;
        if (val) fetchDistricts(val);
        else districtSelect.innerHTML = '<option value="">Select a District</option>';
    });

    // If province preselected (validation error), load districts
    if (provinceSelect && provinceSelect.value) {
        fetchDistricts(provinceSelect.value);
    }
</script>
@endsection
