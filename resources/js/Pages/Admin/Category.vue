<template>

    <app-layout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage Business Categories
            </h2>
        </template>

        <div v-if="$page.props.flash.message" class="text-green-500 max-w-7xl mx-auto  mt-5 bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
            
                {{$page.props.flash.message}}
           
        </div>

        <div v-if="$page.props.flash.errors" class="text-red-400 max-w-7xl mx-auto mt-5  bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
            
                <ul>
                    <li v-for="(error, index) in $page.props.flash.errors" :key="index">{{error}}</li>
                </ul>
           
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <inertia-link :href="route('dashboard')" class="text-sm text-gray-700 underline">
                     Back
                </inertia-link>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-10">
                     <h1 class="text-3xl">Business Categories</h1>

                     <div class="mt-5">
                         <jet-input type="text" v-model="newCategory"></jet-input>
                         <button @click="createCategory()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">save</button>
                     </div>
                    <!--  -->

                    <div class="mt-5 w-1/2">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="(category, index) in data" :key="index" class="flex">
                                    <td class="px-6 py-4"><span>{{category.name}}</span></td>
                                    <td class="px-6 py-4"><button   class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150" @click="deleteCategory(category.id)">delete</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            
                   
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import JetActionMessage from '@/Jetstream/ActionSection'
import JetInput from '@/Jetstream/Input'
import JetButton from '@/Jetstream/Button'

export default {
    props : ['data', 'errors'],
    components: {
            AppLayout,
            JetActionMessage,
            JetInput,
            JetButton
    },
    data() {
        return {
            newCategory : '',
            categories : []
        };
    },

    mounted() {

       
    },

    methods : {

        deleteCategory(id) {
            this.$inertia.delete('/categories/'+id);
        
        },

        createCategory() {
            let data = {name : this.newCategory};
            this.$inertia.post('/categories', data);
            this.newCategory = ""
        }
    }
}
</script>