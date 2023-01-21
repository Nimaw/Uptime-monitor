<template>
    <tr>
        <td class="whitespace-nowrap py-4 pl-4 sm:pl-6 px-3 text-sm font-medium text-gray-900">
            {{ check.created_at.datetime }}
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            <span class="inline-flex items-center rounded-md px-2.5 py-0.5 text-sm font-medium" :class="{
                'bg-green-100 tet-green-800': check.is_successfull,
                'bg-red-100 tet-red-800': !check.is_successfull
            }">
                {{ check.response_code }} {{ check.status_text }}
            </span>
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            <template v-if="check.response_body">
                <button v-on:click="showResponseBodyModal = true">View</button>
            </template>

            <template v-else>
                -
            </template>
        </td>
    </tr>

    <VueFinalModal v-model="showResponseBodyModal" classes="flex justify-center items-start pt-16 md:pt-24 mx-4"
        content-class="relative max-h-full rounded bg-white w-full max-w-2xl p-4 md:p-6"
        overlay-class="bg-gradient-to-r from-gray-800 to-gray-500 opacity-50" :esc-to-close="true">

        <textarea :value="check.response_body" class="border-gray-500 rounded-md w-full" readonly rows="self"></textarea>

    </VueFinalModal>
</template>

<script setup>
import { VueFinalModal } from 'vue-final-modal';
import { ref } from 'vue';

const props = defineProps({
    check: Object
})

const showResponseBodyModal = ref(false);

</script>