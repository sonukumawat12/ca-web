<script setup lang="ts">
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import DeleteUser from '@/components/DeleteUser.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { type BreadcrumbItem, type SharedData, type User } from '@/types';

interface Props {
    mustVerifyEmail: boolean;
    status?: string;
}

defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Profile settings',
        href: '/settings/profile',
    },
];

const page = usePage<SharedData>();
const user = page.props.auth.user as User;

const form = useForm({
    name: user.name,
    email: user.email,
});

const submit = () => {
    form.patch(route('profile.update'), {
        preserveScroll: true,
    });
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Profile settings" />

        <SettingsLayout>
            <div class="space-y-8">
                <div>
                    <HeadingSmall title="Profile Information" description="Update your account’s name and email address." />
                </div>

                <form @submit.prevent="submit" class="grid gap-6 max-w-xl">
                    <div>
                        <Label for="name">Full Name</Label>
                        <Input
                            id="name"
                            class="mt-2"
                            v-model="form.name"
                            required
                            autocomplete="name"
                            placeholder="Your full name"
                        />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div>
                        <Label for="email">Email Address</Label>
                        <Input
                            id="email"
                            type="email"
                            class="mt-2"
                            v-model="form.email"
                            required
                            autocomplete="username"
                            placeholder="you@example.com"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div v-if="mustVerifyEmail && !user.email_verified_at" class="space-y-2 text-sm text-muted-foreground">
                        <p>
                            Your email address is unverified.
                            <Link
                                :href="route('verification.send')"
                                method="post"
                                as="button"
                                class="text-blue-600 underline hover:text-blue-800"
                            >
                                Click here to resend verification email.
                            </Link>
                        </p>

                        <div v-if="status === 'verification-link-sent'" class="text-green-600 font-medium">
                            A new verification link has been sent to your email.
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <Button :disabled="form.processing" class="px-6 py-2">Save</Button>

                        <Transition
                            enter-active-class="transition-opacity duration-200"
                            enter-from-class="opacity-0"
                            leave-active-class="transition-opacity duration-200"
                            leave-to-class="opacity-0"
                        >
                            <p v-show="form.recentlySuccessful" class="text-sm text-green-600">Changes saved.</p>
                        </Transition>
                    </div>
                </form>

                <!-- Uncomment to show Delete option -->
                <!-- <DeleteUser /> -->
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
