<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    files: [],
});

const onChangeFiles = (e) => {
    if (e.target.files.length > 5) {
        form.errors.files = 'Maximum number of files is 5';
        return;
    }
    else {
        form.errors.files = null;
    }
    form.files = e.target.files;
}

const upload = async () => {
    if (form.errors.files) {
        return;
    }
    form.post('/upload');
};
</script>

<template>
    <div class="flex flex-col items-center justify-center">
        <div class="flex flex-col items-center justify-center">
            <!-- Upload Form -->
            <form
                class="flex flex-col items-center justify-center"
                enctype="multipart/form-data"
                method="post"
                @submit.prevent="upload"
            >
                <input
                    type="file"
                    accept="image/*"
                    class=""
                    multiple
                    name="files"
                    @input="onChangeFiles"
                />
                
                <div v-if="form.errors.files" class="mt-2 text-sm text-red-500">
                    {{ form.errors.files }}
                </div>

                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                    {{ form.progress.percentage }}%
                </progress>

                <div class="mt-2 text-sm text-gray-500">
                    <div v-for="file in form.files" :key="file.name">
                        <span class="text-gray-400 mr-2">{{ file.name }}</span>
                        <span class="text-gray-500">{{ file.size }}</span>
                    </div>
                </div>

                <div class="mt-2 text-sm text-gray-500">
                    Supported file types: JPG, PNG, GIF
                </div>

                <div class="mt-2 text-sm text-gray-500">
                    Maximum file size: 10MB
                </div>

                <button type="submit" class="mt-2 w-full inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-[#FF2D20] border border-transparent rounded-md shadow-sm hover:bg-[#FF2D20]/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF2D20]">
                    Upload
                </button>
            </form>
        </div>
    </div>
</template>