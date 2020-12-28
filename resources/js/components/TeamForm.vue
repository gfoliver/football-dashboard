<template>
    <form @submit.prevent="handleSubmit" class="col-md-8 bg-dark text-white py-3 rounded">
        <h3 class="text-center mb-3">
            <span v-if="team">Edit {{team.name}}</span>
            <span v-else>Add Team</span>
        </h3>
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
        <input type="hidden" name="id" :value="id">
        <button class="btn btn-primary" type="submit" :disabled="isLoading">Save</button>
    </form>
</template>
<script>
    export default {
        name: "TeamForm",
        props: {
            team: {
                type: Object | null,
                required: true
            },
            id: {
                type: String | null,
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
            if (this.team)
                this.name = this.team.name;
        },
        methods: {
            handleSubmit() {
                this.$http.post('/teams', { 
                    name: this.name,
                    id: this.id 
                }).then(res => {
                    this.$bvToast.toast('Team saved successfully.', {
                        title: 'Success!',
                        solid: true,
                        variant: 'success'
                    });

                    this.name = '';
                }).catch(err => {
                    this.$bvToast.toast('Error saving team.', {
                        title: 'Error!',
                        solid: true,
                        variant: 'danger'
                    });
                });
            }
        }
    }
</script>