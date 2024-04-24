<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import UploadImages from '@/Components/UploadImages.vue';

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    photos: {
        type: Array,
    },
});

const sortByValue = ref(null);

const sorted = computed(() => {
    if (sortByValue.value === 'name') {
        return props.photos.sort((a, b) => a.name.localeCompare(b.name));
    }
    else if (sortByValue.value === 'date') {
        return props.photos.sort((a, b) => new Date(a.created_at)- new Date(b.created_at));
    }
    else {
        return props.photos;
    }
});

const sortBy = (sortBy) => {
    sortByValue.value = sortBy;
}
</script>

<template>
    <Head title="Welcome" />
    <div>
        <div>
            <div>
                <header>
                    <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                        >
                            Dashboard
                        </Link>

                        <template v-else>
                            <Link
                            >
                                Log in
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                            >
                                Register
                            </Link>
                        </template>
                    </nav>
                </header>

                <main class="mt-6">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <UploadImages />
                    </div>
                    <div class="mt-6">
                        <p class="text-center text-sm text-gray-600">
                            Photohost is a simple photo sharing app. You can upload your photos and share them with your friends.
                        </p>
                    </div>
                    <div class="mt-6" v-if="photos.length > 0">
                        <!-- Sorting by name, date -->
                        <button class="mt-2 ml-2 inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-[#FF2D20] border border-transparent rounded-md shadow-sm hover:bg-[#FF2D20]/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF2D20]" @click="sortBy('name')">
                            Sort by name
                        </button>
                        <button class="mt-2 ml-2 inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-[#FF2D20] border border-transparent rounded-md shadow-sm hover:bg-[#FF2D20]/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF2D20]" @click="sortBy('date')">
                            Sort by date
                        </button>
                    </div>
                    <div class="mt-6">
                        <div v-for="photo in sorted" :key="photo.id">
                            <div class="flex items-center">
                                <img :src="photo.path" class="h-48 w-48 rounded-lg object-cover">
                                <div class="ml-4">
                                    <p class="text-lg font-medium text-gray-900">
                                        {{ photo.name }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        {{ photo.created_at }}
                                    </p>
                                </div>
                            </div>
                        </div> 
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>
