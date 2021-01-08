<template>

    <guest-layout>

        <template #header>
            <inertia-link :href="route('welcome')">
                Home
            </inertia-link>
        </template>

        <div class="m-10 w-4/5">

           <div class="w-full  bg-white shadow-md text-center p-5">
                <div class="flex">
                    <div class="w-1/2 m-3"> <b>Name : </b> {{listing.name}}</div>
                     <div class="w-1/2 m-3"> <b>Phone : </b> {{listing.phone}}</div>
                </div>

                 <div class="flex">
                    <div class="w-1/2 m-3"> <b>Email : </b> {{listing.email}}</div>
                     <div class="w-1/2 m-3"> <b>Website Url : </b> <a :href="listing.website_url"  target="_blank" class="p-4 text-gray-900 rounded-sm">{{listing.website_url}}</a></div>
                </div>

                 <div class="flex">
                    <div class="w-1/2 m-3"> <b>Address : </b> {{listing.address}}</div>
                     <div class="w-1/2 m-3"> <b>Description : </b> {{listing.description}}</div>
                </div>

                <div class="w-full">
                    <h1 class="text-3xl">Images Comming Soon *********</h1>
                </div>
           </div>
        </div>

        
    </guest-layout>
</template>

<script>
import GuestLayout from '@/Layouts/GuestLayout'
export default {
    props : ['listing'],
    components: {
            GuestLayout
    },
    data() {
        return {
            
        };
    }
}
</script>