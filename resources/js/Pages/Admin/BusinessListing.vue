<template>

    <app-layout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage Business Listings
            </h2>
        </template>

        <div v-if="$page.props.flash.message" class="text-green-500 max-w-7xl mx-auto  mt-5 bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
            
                {{$page.props.flash.message}}
           
        </div>

        <div v-if="$page.props.errors" class="text-red-400 max-w-7xl mx-auto mt-5  bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
            
                <ul>
                    <li v-for="(error, index) in $page.props.errors" :key="index">{{error}}</li>
                </ul>
           
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <inertia-link :href="route('dashboard')" class="text-sm text-gray-700 underline">
                     Back
                </inertia-link>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-10">
                     <h1 class="text-3xl">Business Listings</h1>

                     <div class="mt-5 w-full" v-if="!editMode">
                         <h1 class="text-3xl m-5"> Add a New Listing</h1>
                         <form @submit.prevent="createListing">
                             <div class="flex my-3">
                                <input type="text" v-model="newListing.name" class="w-1/3 m-2" placeholder="Business Name" required>
                                <input type="text" v-model="newListing.email" class="w-1/3 m-2" placeholder="Business Email" required>
                                <input type="text" v-model="newListing.phone" class="w-1/3 m-2" placeholder="Business Phone" required>
                             </div>
                             <div class="flex my-3">
                                 <input type="text" v-model="newListing.address" class="w-2/3 m-2" placeholder="Business Address" required>
                                 <input type="text" v-model="newListing.website_url" class="w-1/3 m-2" placeholder="Business Website Url" required>
                             </div>
                             <div class="flex my-3">
                                 <textarea class="w-full m-2s" v-model="newListing.description" placeholder="Describe Business" required></textarea>
                             </div>

                             <div class="my-3">
                                 <jet-label class="block">Choose Listing Categories</jet-label>
                                 <select class="w-2/3 block" multiple v-model="newListing.categories" required>
                                    <option v-for="(category, index) in categories" :key="index" :value="category.id">{{category.name}}</option>
                                 </select>
                             </div>
                             <div>
                                 <jet-button>Create Listing</jet-button> <button type="button" @click="emptyListing()"> Clear Data</button>
                             </div>
                         </form>
                     </div>

                     <div class="mt-5 w-full" v-else>
                         <h1 class="text-3xl m-5"> Edit {{updateListing.name}}</h1>
                         <form @submit.prevent="updateListingMethod">
                             <div class="flex my-3">
                                <input type="text" v-model="updateListing.name" class="w-1/3 m-2" placeholder="Business Name" required>
                                <input type="text" v-model="updateListing.email" class="w-1/3 m-2" placeholder="Business Email" required>
                                <input type="text" v-model="updateListing.phone" class="w-1/3 m-2" placeholder="Business Phone" required>
                             </div>
                             <div class="flex my-3">
                                 <input type="text" v-model="updateListing.address" class="w-2/3 m-2" placeholder="Business Address" required>
                                 <input type="text" v-model="updateListing.website_url" class="w-1/3 m-2" placeholder="Business Website Url" required>
                             </div>
                             <div class="flex my-3">
                                 <textarea class="w-full m-2s" v-model="updateListing.description" placeholder="Describe Business" required></textarea>
                             </div>

                             <div class="my-3">
                                 <jet-label class="block">Choose Listing Categories</jet-label>
                                 <select class="w-2/3 block" multiple v-model="updateListing.categoryIds" required>
                                    <option v-for="(category, index) in categories" :key="index" :value="category.id" >{{category.name}}</option>
                                 </select>
                             </div>

                             <div class="my-3">
                                 <input type="checkbox" v-model="updateListing.is_active" :checked="is_active"> Keep Active
                             </div>

                             <div>
                                 <jet-button>Update Listing</jet-button>  <button type="button" @click="editMode = false; updateListing = {};">Exit Edit Mode</button>
                             </div>
                         </form>
                     </div>
                    <!--  -->

                    <div class="mt-5 w-full">
                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Name
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Phone
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Email
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Views
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Website Url
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Address
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Status
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Description
                                                </th>
                                                <th scope="col" class="relative px-6 py-3">
                                                    <span class="sr-only">Edit</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr v-for="(listing, index) in listings" :key="listing">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                   <div class="text-sm text-gray-900">{{listing.name}}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{listing.phone}}</div>
                                                </td>
                                                 <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{listing.email}}</div>
                                                </td>
                                                 <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{listing.views}}</div>
                                                </td>
                                                 <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{listing.website_url}}</div>
                                                </td>
                                                 <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{listing.address}}</div>
                                                </td>
                                                

                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span v-if="listing.is_active" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Active
                                                    </span>
                                                    <span v-else class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        Inactive
                                                    </span>
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{listing.description}}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="#"  @click="editMode = true; updateListing = listing" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                     <a href="#"  @click="deleteListing(listing.id)" class="text-indigo-600 hover:text-indigo-900">Delete</a>
                                                </td>
                                            </tr>

                                            <!-- More rows... -->
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                        </div>
                           
                    </div>
                                        
                                            
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import JetButton from '@/Jetstream/Button'
import JetLabel from '@/Jetstream/Label.vue';

export default {
    props : ['categories', 'listings'],
    components: {
            AppLayout,
            JetButton,
            JetLabel
    },
    data() {
        return {
            newListing : this.emptyListing(),
            updateListing : {},
            editMode : false
        };
    },

    methods : {

        deleteListing(id) {
            this.$inertia.delete('/listings/'+id);
        
        },

        createListing() {
          
            this.$inertia.post('/listings', this.newListing);
            this.newListing = this.emptyListing();
        },

        updateListingMethod() {
          
            this.$inertia.patch('/listings/'+this.updateListing.id, this.updateListing);
            this.editMode = false;
        },

        emptyListing() {
            return {
                name : '',
                phone : '',
                email : '',
                address : '',
                website_url : '',
                description : '',
                categories : []
            };
        }
    }
}
</script>