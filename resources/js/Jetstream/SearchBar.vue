<template>
    <div>
        <form @submit.prevent="goToSearch">
            <div class="flex">
                <div class="w-full my-3">
                    <input type="text" v-model="text" class="w-1/3 m-2" placeholder="Enter Search Text ..." required>
                   <jet-button> Search</jet-button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
export default {
    components: {
            JetButton
    },
    data() {
        return {
            text : ''
        };
    },

    methods: {

        goToSearch() {
            this.$inertia.get('/listings/search', {text : this.text});
        }
    }
}
</script>