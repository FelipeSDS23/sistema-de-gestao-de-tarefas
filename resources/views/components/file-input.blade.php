<div x-data="{ preview: null }">
    <input type="file" name="{{ $name ?? 'file' }}" 
           class="block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
           @change="preview = URL.createObjectURL($event.target.files[0])">

    <template x-if="preview">
        <img :src="preview" class="mt-2 w-20 h-20 rounded-md">
    </template>
</div>
