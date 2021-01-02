<template>
    <form @submit.prevent="handleSubmit" class="col-md-8 bg-dark text-white py-3 rounded">
        <h3 class="text-center mb-3">
            <span v-if="team">Edit {{team.name}}</span>
            <span v-else>Add Team</span>
        </h3>
        <div class="form-group">
            <label for="team-logo">Logo</label>
            <b-form-file
                id="team-logo"
                v-model="logo"
            ></b-form-file>
        </div>
        <div class="form-group">
            <label for="team-name" class="form-label" required>Name</label>
            <input 
                name="name" 
                type="text" 
                id="team-name" 
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
        name: "TeamForm",
        mixins: [toasts],
        props: {
            team: {
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
                isLoading: false,
            }
        },
        created() {
            if (this.team)
                this.name = this.team.name;
        },
        methods: {
            handleSubmit() {
                this.isLoading = true;

                let data = new FormData();
                data.append('name', this.name);
                
                if (this.id)
                    data.append('id', this.id);
                
                if (this.logo)
                    data.append('logo', this.logo);

                this.$http.post(this.saveUrl, data).then(res => {
                    this.addToastSuccess('Team saved successfully.');

                    this.name = '';
                }).catch(err => {
                    this.addToastError(err, 'Error saving team.');
                }).finally(() => {
                    this.isLoading = false;
                });
            }
        }
    }
</script>