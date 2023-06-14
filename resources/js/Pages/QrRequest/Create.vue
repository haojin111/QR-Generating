<script setup>
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import QrCard from '@/Components/QrCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    qr_request: Object | null
});

const form = useForm({
    title: props.qr_request?.title || '',
    resource: props.qr_request?.resource || '',
    type: props.qr_request?.type || '',
    owner: props.qr_request?.owner || '',
    is_locked: props.qr_request?.is_locked || 0,
    access_count: props.qr_request?.access_count || 0
});

const submit = () => {
    form.data.is_locked = form.data.is_locked? 1: 0;
    form.post(route('qrs.store'), {
        onFinish: (respond) => {
            console.log(respond);
            // form.reset()
        },
    });
};

const switchToList = (team) => {
    router.get(route('qrs.index'));
};

</script>

<template>
    <Head title="QR Request" />

    <QrCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="title" value="Title" />
                <TextInput
                    id="title"
                    v-model="form.title"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="title"
                />
                <InputError class="mt-2" :message="form.errors.title" />
            </div>

            <div class="mt-4">
                <InputLabel for="resource" value="Resource" />
                <TextInput
                    id="resource"
                    v-model="form.resource"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="resource"
                />
                <InputError class="mt-2" :message="form.errors.resource" />
            </div>

            <div class="mt-4">
                <InputLabel for="type" value="Type" />
                <select id="type" name="type" v-model="form.type" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="Dynamic">Dynamic</option>
                    <option value="Resource">Resource</option>
                    <option value="Remote">Remote</option>
                </select>
                <InputError class="mt-2" :message="form.errors.type" />
            </div>

            <div class="mt-4">
                <InputLabel for="is_locked">
                    <div class="flex items-center">
                        <Checkbox id="is_locked" v-model:checked="form.is_locked" name="is_locked" />

                        <div class="ml-2">
                            Is Locked?
                        </div>
                    </div>
                    <InputError class="mt-2" :message="form.errors.is_locked" />
                </InputLabel>
            </div>

            <div class="mt-4">
                <InputLabel for="owner" value="Owner" />
                <select id="owner" name="owner" v-model="form.owner" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="User">User</option>
                    <option value="Pincode">Pincode</option>
                    <option value="Email">Email</option>
                </select>
                <InputError class="mt-2" :message="form.errors.type" />
            </div>

            <div class="mt-4">
                <InputLabel for="access_count" value="Access Count" />
                <TextInput
                    id="access_count"
                    v-model="form.access_count"
                    type="number"
                    class="mt-1 block w-full"
                    required
                    autocomplete="access_count"
                />
                <InputError class="mt-2" :message="form.errors.access_count" />
            </div>

            

            <div class="flex items-center justify-end mt-4">
                <SecondaryButton @click="switchToList()" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Cancel
                </SecondaryButton>

                <PrimaryButton type="submit" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </PrimaryButton>
            </div>
        </form>
    </QrCard>
</template>
