<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-10">

                    <nav>
                        <ul>
                            <li>
                                 <inertia-link :href="route('categories.index')" class="text-sm text-gray-700 underline">
                                    Manage Categories
                                </inertia-link>
                            </li>

                             <li>
                                 <inertia-link :href="route('listings.index')" class="text-sm text-gray-700 underline">
                                    Manage Business Listings
                                </inertia-link>
                            </li>

                        </ul>
                    </nav>
                   
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    

    export default {
        components: {
            AppLayout,
        },
    }
</script>
