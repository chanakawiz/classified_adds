@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Create a New Ad</h1>

        @if ($errors->any())
            <div class="mb-6">
                <ul class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('ads.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Image Upload --}}
            <div>
                <label class="block font-medium text-gray-700 mb-2">Upload Images (Max 6)</label>

                <input type="file" name="images[]" id="imageInput" multiple accept="image/*" class="hidden">

                <div id="previewContainer" class="grid grid-cols-3 gap-4">
                    @for ($i = 0; $i < 6; $i++)
                        <div class="relative border-2 border-dashed border-gray-400 rounded-md w-full aspect-square flex items-center justify-center cursor-pointer upload-frame overflow-hidden"
                             onclick="document.getElementById('imageInput').click()" data-index="{{ $i }}">
                            <span class="text-gray-400 text-xs text-center pointer-events-none">Click to Upload</span>
                        </div>
                    @endfor
                </div>

                <small class="text-gray-500 block mt-2">Click a square to add or replace an image. Max 6 images.</small>
            </div>

            {{-- Title --}}
            <div>
                <label class="block font-medium text-gray-700">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" required
                       class="w-full mt-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Description --}}
            <div>
                <label class="block font-medium text-gray-700">Description</label>
                <textarea name="description" required rows="4"
                          class="w-full mt-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
            </div>

            {{-- Category --}}
            <div>
                <label class="block font-medium text-gray-700">Category</label>
                <select name="category_id" required
                        class="w-full mt-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
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
                <label class="block font-medium text-gray-700">Price (LKR)</label>
                <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                       class="w-full mt-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Contact Email --}}
            <div>
                <label class="block font-medium text-gray-700">Contact Email</label>
                <input type="email" name="contact_email" value="{{ old('contact_email') }}"
                       class="w-full mt-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Contact Phone --}}
            <div>
                <label class="block font-medium text-gray-700">Contact Phone</label>
                <input type="text" name="contact_phone" value="{{ old('contact_phone') }}"
                       class="w-full mt-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Submit --}}
            <div>
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-semibold transition">
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
                            <img src="${event.target.result}" class="absolute inset-0 w-full h-full object-cover rounded-md" />
                            <button type="button" class="absolute top-1 right-1 bg-red-600 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center remove-btn" data-id="${fileId}">×</button>
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
                frame.innerHTML = '<span class="text-gray-400 text-xs text-center pointer-events-none">Click to Upload</span>';

                updateFileInput();
            }
        });

        function updateFileInput() {
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(fileObj => dataTransfer.items.add(fileObj.file));
            imageInput.files = dataTransfer.files;
        }
    </script>
@endsection
