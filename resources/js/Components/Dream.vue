<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';

import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

import { usePut } from '@inertiajs/inertia-vue3';

dayjs.extend(relativeTime);

const props = defineProps(['dream']);

const form = useForm({
    message: props.dream.message,
});

const formComment = useForm({
    content: '',
});


const editing = ref(false);


        const isLiked = ref(false);
        const totalLikes = ref(props.dream.likes_count);

        const toggleLike = async (dreamId) => {
            const response = await fetch(`/dreams/${dreamId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({}),
            });

            if (response.ok) {
                const data = await response.json();
                isLiked.value = !isLiked.value;
                totalLikes.value = data.total_likes;
                console.log(totalLikes.value);
            }
        };



</script>
 
<template>
    <div class="p-6 flex space-x-2">
        <svg class="h-6 w-6 text-primary -scale-x-100" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z"></path>
        </svg>
        <div class="flex-1">
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-gray-800">{{ dream.user.name }}</span>
                    <small class="ml-2 text-sm text-gray-600">{{ dayjs(dream.created_at).fromNow() }}</small>
                    <small v-if="dream.created_at !== dream.updated_at" class="text-sm text-gray-600"> &middot; edited</small>
                </div>

                <Dropdown v-if="dream.user.id === $page.props.auth.user.id">
                    <template #trigger>
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </button>
                    </template>
                    <template #content>
                        <button class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:bg-gray-100 transition duration-150 ease-in-out" @click="editing = true">
                            Edit
                        </button>
                        <DropdownLink as="button" :href="route('dreams.destroy', dream.id)" method="delete">
                            Delete
                        </DropdownLink>
                    </template>
                </Dropdown>
            </div>
            <form v-if="editing" @submit.prevent="form.put(route('dreams.update', dream.id), { onSuccess: () => editing = false })">
                <textarea v-model="form.message" class="mt-4 w-full text-gray-900 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                <InputError :message="form.errors.message" class="mt-2" />
                <div class="space-x-2">
                    <PrimaryButton class="mt-4">Save</PrimaryButton>
                    <button class="mt-4" @click="editing = false; form.reset(); form.clearErrors()">Cancel</button>
                </div>
            </form>
            <p v-else class="rounded mt-4 p-3 text-lg text-gray-100 bg-transparentPrimary">{{ dream.message }}</p>

            <div class="flex mt-3">
              <button @click="toggleLike(dream.id)">
                <svg v-if="isLiked" class="w-6 fill-current text-primary" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                  <path d="M9.653 16.915l-.005-.003-.019-.01a20.759 20.759 0 01-1.162-.682 22.045 22.045 0 01-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 018-2.828A4.5 4.5 0 0118 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 01-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 01-.69.001l-.002-.001z"></path>
                </svg>
                <svg v-else class="w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"></path>
                </svg>
              </button>
              <p>{{ totalLikes }}</p>
            </div>


            <p class="mt-4 mb-1 text-sm">Add Your Comment:</p>
            <form @submit.prevent="formComment.post(route('comments.store', { dream: dream.id }), { onSuccess: () => formComment.reset() })">
              <input type="hidden" name="dream_id" :value="dream.id">
              <textarea class="w-full p-2 border rounded-md placeholder:text-sm" v-model="formComment.content" rows="1" placeholder="leave your comment here"></textarea>
              <InputError :message="formComment.errors.message" class="mt-2" />
              <br>
              <PrimaryButton class="mb-4">Comment</PrimaryButton>
            </form>


            <div class="text-sm rounded border border-primary p-3">
              <div v-if="dream.comments.length">
                <p class="mb-2">Comments:</p>
                <div class="bg-gray-50" v-for="comment in dream.comments" :key="comment.id">
                  <div class="flex space-x-4 mb-1">
                    <p class="">{{ comment.user.name }}</p>
                    <p>{{ comment.content }}</p>                
                  </div>
                </div>
              </div>
              <p v-else>No comments yet. Share yours!</p>
                
            </div>
        </div>
    </div>
</template>