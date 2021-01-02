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
        <div class="form-group">
            <label for="league-logo" class="form-label" required>Logo</label>
            <b-form-file
                id="league-logo"
                v-model="logo"
            ></b-form-file>
        </div>
        <div class="form-group">
            <label for="league-cover" class="form-label" required>Cover Image</label>
            <b-form-file
                id="league-cover"
                v-model="cover"
            ></b-form-file>
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
                logo: null,
                cover: null,
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

                const data = new FormData();

                data.append('name', this.name);

                if (this.id)
                    data.append('id', this.id);

                if (this.logo)
                    data.append('logo', this.logo);
                
                if (this.cover)
                    data.append('cover', this.cover);

                this.$http.post(this.saveUrl, data).then(res => {
                    this.addToastSuccess('League saved successfully.');

                    if (!this.id) {
                        this.name = '';
                        this.logo = null;
                        this.cover = null;
                    }
                }).catch(err => {
                    this.addToastError(err, 'Error saving league.');
                }).finally(() => {
                    this.isLoading = false;
                });
            }
        }
    }
</script>