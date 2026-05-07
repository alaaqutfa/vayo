<div x-data="mediaManager(@json($modelType), @json($modelId), @json($collection))" class="mt-6">
    <h3 class="text-lg font-medium text-gray-900 mb-3">Media Gallery ({{ ucfirst($collection) }})</h3>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="media-grid" x-ref="grid">
        <template x-for="(media, index) in mediaItems" :key="media.id">
            <div class="relative group border rounded-lg overflow-hidden bg-gray-100" :data-id="media.id"
                :data-order="media.order">
                <img :src="media.url" class="w-full h-32 object-cover">
                <div
                    class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-2">
                    <button @click="deleteMedia(media.id)" class="text-white bg-red-600 p-1 rounded"><i
                            class="bi bi-trash"></i></button>
                </div>
                <input type="hidden" name="media_order[]" :value="media.id" class="media-order-input">
            </div>
        </template>
    </div>

    <div class="mt-4">
        <input type="file" id="media-upload" accept="image/*" multiple class="hidden">
        <button type="button" @click="triggerUpload"
            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
            <i class="bi bi-plus mr-2"></i> Upload Images
        </button>
        <p class="text-xs text-gray-500 mt-1">Supports JPG, PNG, WebP. Max 5MB each.</p>
    </div>
</div>

@push('scripts')
    <script>
        function mediaManager(modelType, modelId, collection) {
            return {
                mediaItems: [],
                init() {
                    this.fetchMedia();
                    this.initSortable();
                },
                fetchMedia() {
                    fetch(`/admin/api/media?model_type=${modelType}&model_id=${modelId}&collection=${collection}`)
                        .then(res => res.json())
                        .then(data => { this.mediaItems = data; this.$nextTick(() => this.initSortable()); });
                },
                initSortable() {
                    const grid = this.$refs.grid;
                    if (!grid) return;
                    new Sortable(grid, {
                        animation: 150,
                        onEnd: () => this.updateOrder()
                    });
                },
                updateOrder() {
                    const items = document.querySelectorAll('#media-grid > div');
                    const orders = [];
                    items.forEach((item, idx) => {
                        const id = item.dataset.id;
                        orders.push({ id: parseInt(id), order: idx + 1 });
                    });
                    fetch('{{ route("admin.media.reorder") }}', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        body: JSON.stringify({ items: orders })
                    }).then(() => this.fetchMedia());
                },
                triggerUpload() {
                    const input = document.getElementById('media-upload');
                    input.click();
                    input.onchange = (e) => {
                        const files = e.target.files;
                        Array.from(files).forEach(file => {
                            const formData = new FormData();
                            formData.append('file', file);
                            formData.append('model_type', modelType);
                            formData.append('model_id', modelId);
                            formData.append('collection', collection);
                            fetch('{{ route("admin.media.upload") }}', {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                body: formData
                            }).then(res => res.json()).then(data => {
                                if (data.success) this.fetchMedia();
                            });
                        });
                        input.value = '';
                    };
                },
                deleteMedia(id) {
                    if (!confirm('Delete this image?')) return;
                    fetch(`{{ url('admin/media') }}/${id}`, {
                        method: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                    }).then(() => this.fetchMedia());
                }
            }
        }
    </script>
@endpush
