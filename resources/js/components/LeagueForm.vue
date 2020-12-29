<template>
    <form @submit.prevent="handleSubmit" class="col-md-8 bg-dark text-white py-3 rounded">
        <h3 class="text-center mb-3">
            <span v-if="league">Edit {{league.name}}</span>
            <span v-else>Add League</span>
        </h3>
        <div class="form-group">
            <label for="league-name" class="form-label" required>Name</label>
            <input 
                name="name" 
                type="text" 
                id="league-name" 
                class="form-control bg-dark text-white" 
                v-model="name"
                required
            >
        </div>
        <button class="btn btn-primary" type="submit" :disabled="isLoading">Save</button>
    </form>
</template>
<script>
    import toasts from '../mixins/toasts';

    export default {
        name: "LeagueForm",
        mixins: [toasts],
        props: {
            league: {
                type: Object | null,
                required: true
            },
            id: {
                type: String | null,
                required: true
            },
            saveUrl: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                name: '',
                isLoading: false,
            }
        },
        created() {
            if (this.league)
                this.name = this.league.name;
        },
        methods: {
            handleSubmit() {
                this.isLoading = true;

                this.$http.post(this.saveUrl, { 
                    name: this.name,
                    id: this.id 
                }).then(res => {
                    this.addToastSuccess('League saved successfully.');

                    this.name = '';
                }).catch(err => {
                    this.addToastError(err, 'Error saving league.');
                }).finally(() => {
                    this.isLoading = false;
                });
            }
        }
    }
</script>