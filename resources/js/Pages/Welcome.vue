<template>

    <guest-layout>

        <template #header>
             <jet-search-bar></jet-search-bar>
        </template>

        <div class="m-10 w-4/5">
           <div v-if="listings && listings.length > 0" class="flex">
               <div v-for="(listing, index) in listings" :key="index" class="bg-white p-5 shadow-md w-1/3 m-4">
                 
                    <div>Name : {{listing.name}}</div>
                    <div>Phone : {{listing.phone}}</div>
                
                    <div>Email : {{listing.email}}</div>
                    <div><a :href="listing.url">View Full Details</a></div>
                   
               </div>
           </div>
           <div v-else class="w-full m-14 bg-white shadow-md text-center">
                <h1 class="text-2xl text-gray-900 p-5">No Listing is currently found</h1>
           </div>
        </div>

        
    </guest-layout>
</template>

<script>
import JetSearchBar from '@/Jetstream/SearchBar.vue';
import GuestLayout from '@/Layouts/GuestLayout'
export default {
    props : ['listings'],
    components: {
            GuestLayout,
            JetSearchBar
    },
    data() {
        return {
            
        };
    }
}
</script>