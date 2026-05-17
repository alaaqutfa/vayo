@props(['name' => 'image', 'currentImage' => null, 'label' => 'Image', 'accept' => 'image/*', 'shape' => 'rounded-lg', 'size' => 'h-20 w-20'])

<div {{ $attributes->merge(['class' => '']) }}>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ $label }}</label>

    <!-- Upload Area - Full clickable container -->
    <div class="upload-container-{{ $name }} relative">
        <div class="mt-1 flex items-center justify-center rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 px-6 py-8 cursor-pointer hover:border-primary hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors"
             onclick="document.getElementById('{{ $name }}').click()">
            <div class="space-y-2 text-center w-full">
                <i class="bi bi-cloud-upload text-3xl text-gray-400"></i>
                <div class="flex flex-col text-sm text-gray-600 dark:text-gray-400">
                    <span class="font-medium text-primary">Click to upload</span>
                    <span class="text-xs">or drag and drop</span>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    @if($name === 'featured_image')
                        PNG, JPG, WEBP up to 2MB
                    @elseif($name === 'image' || $name === 'before_image' || $name === 'after_image')
                        Square image recommended (PNG, JPG, WEBP up to 2MB)
                    @else
                        Supported formats: PNG, JPG, WEBP up to 2MB
                    @endif
                </p>
            </div>
        </div>

        <!-- Hidden input -->
        <input id="{{ $name }}"
               name="{{ $name }}"
               type="file"
               accept="{{ $accept }}"
               class="sr-only"
               data-preview-id="preview-{{ $name }}"
               data-current-id="current-{{ $name }}">
    </div>

    <!-- Current Image Display -->
    @if($currentImage)
        <div id="current-{{ $name }}" class="mt-4 relative inline-block">
            <div class="flex items-end gap-3">
                <div class="flex flex-col">
                    <span class="text-xs text-gray-500 dark:text-gray-400 mb-2 block">Current image:</span>
                    <img src="{{ asset('public/storage/' . $currentImage) }}"
                         alt="Current {{ $label }}"
                         class="{{ $shape }} {{ $size }} object-cover shadow-sm">
                </div>
                <button type="button"
                        class="delete-image-btn mb-1 px-3 py-2 rounded-md bg-red-100 text-red-700 text-xs font-medium hover:bg-red-200 dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-900/50 transition-colors"
                        data-image-field="{{ $name }}"
                        data-current-id="current-{{ $name }}">
                    <i class="bi bi-trash3"></i> Delete
                </button>
            </div>
        </div>
    @endif

    <!-- Preview of new image -->
    <div id="preview-{{ $name }}" class="mt-4 hidden relative inline-block">
        <div class="flex items-end gap-3">
            <div class="flex flex-col">
                <span class="text-xs text-gray-500 dark:text-gray-400 mb-2 block">Preview:</span>
                <img id="preview-img-{{ $name }}"
                     alt="Preview {{ $label }}"
                     class="{{ $shape }} {{ $size }} object-cover shadow-sm">
            </div>
            <button type="button"
                    class="clear-new-image-btn mb-1 px-3 py-2 rounded-md bg-amber-100 text-amber-700 text-xs font-medium hover:bg-amber-200 dark:bg-amber-900/30 dark:text-amber-300 dark:hover:bg-amber-900/50 transition-colors"
                    data-input-id="{{ $name }}"
                    data-preview-id="preview-{{ $name }}">
                <i class="bi bi-x-circle"></i> Clear
            </button>
        </div>
    </div>

    <!-- Error message -->
    @error($name)
        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror

    <!-- Hidden input for deletion -->
    <input type="hidden" name="delete_{{ $name }}" id="delete-{{ $name }}" value="0">
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview on file selection
    const fileInput = document.getElementById('{{ $name }}');
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const previewImg = document.getElementById('preview-img-{{ $name }}');
                    const previewContainer = document.getElementById('preview-{{ $name }}');
                    const currentContainer = document.getElementById('current-{{ $name }}');

                    if (previewImg) {
                        previewImg.src = event.target.result;
                        previewContainer.classList.remove('hidden');
                        if (currentContainer) {
                            currentContainer.classList.add('hidden');
                        }
                    }
                };
                reader.readAsDataURL(file);
            }
        });

        // Drag and drop support
        const uploadContainer = fileInput.closest('.upload-container-{{ $name }}');
        if (uploadContainer) {
            const dropZone = uploadContainer.querySelector('[onclick*="click"]').parentElement;

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
            });

            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => {
                    dropZone.classList.add('border-primary', 'bg-blue-50', 'dark:bg-blue-900/20');
                });
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => {
                    dropZone.classList.remove('border-primary', 'bg-blue-50', 'dark:bg-blue-900/20');
                });
            });

            dropZone.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                const files = dt.files;
                fileInput.files = files;
                const event = new Event('change', { bubbles: true });
                fileInput.dispatchEvent(event);
            });
        }
    }

    // Clear new image selection
    const clearBtns = document.querySelectorAll('.clear-new-image-btn');
    clearBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const inputId = this.dataset.inputId;
            const previewId = this.dataset.previewId;
            const fileInput = document.getElementById(inputId);
            const previewContainer = document.getElementById(previewId);
            const currentContainer = document.getElementById('current-' + inputId);

            fileInput.value = '';
            previewContainer.classList.add('hidden');
            if (currentContainer) {
                currentContainer.classList.remove('hidden');
            }
        });
    });

    // Delete current image
    const deleteBtns = document.querySelectorAll('.delete-image-btn');
    deleteBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const imageField = this.dataset.imageField;
            const currentId = this.dataset.currentId;
            const deleteInput = document.getElementById('delete-' + imageField);
            const currentContainer = document.getElementById(currentId);
            const previewContainer = document.getElementById('preview-' + imageField);
            const fileInput = document.getElementById(imageField);

            if (confirm('Are you sure you want to delete this image?')) {
                deleteInput.value = '1';
                currentContainer.classList.add('hidden');
                fileInput.value = '';
                if (previewContainer) {
                    previewContainer.classList.add('hidden');
                }
            }
        });
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
});
</script>
