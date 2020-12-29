<template>
    <form @submit.prevent="handleSubmit" class="col-md-8 bg-dark text-white py-3 rounded">
        <h3 class="text-center mb-3">
            <span v-if="season">Edit {{season.name}}</span>
            <span v-else>Add Season</span>
        </h3>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="season-year">Season starting year</label>
                <input 
                    id="season-year"
                    type="number" 
                    class="form-control"
                    min="1900"
                    max="2099"
                    v-model="year"
                    required
                >
            </div>
            <div class="form-group col-md-6">
                <label>Season ending year</label>
                <input 
                    type="number" 
                    class="form-control"
                    disabled
                    :value="Number(year) + 1"
                >
            </div>
        </div>
        <div class="form-group">
            <v-select
                multiple
                :options="teams"
                label="name"
                v-model="selectedTeams"
                class="form-control p-0 h-auto"
                :reduce="team => team.id"
            ></v-select>        
        </div>
        <div class="form-group">
            <b-form-checkbox v-model="active">Season is currently active?</b-form-checkbox>
        </div>
        <button class="btn btn-primary" type="submit" :disabled="isLoading">Save</button>
    </form>
</template>
<script>
    import vSelect from 'vue-select';
    import toasts from '../mixins/toasts';

    export default {
        name: "SeasonForm",
        mixins: [toasts],
        components: {vSelect},
        props: {
            season: {
                type: Object | null,
                required: true
            },
            id: {
                type: String | null,
                required: true
            },
            leagueId: {
                type: String | null,
                required: true
            },
            saveUrl: {
                type: String,
                required: true
            },
            league: {
                type: Object,
                required: true
            },
            teams: {
                type: Array,
                required: true
            }
        },
        data() {
            return {
                league_id: null,
                isLoading: false,
                year: new Date().getFullYear(),
                active: false,
                selectedTeams: []
            }
        },
        created() {
            if (this.season) {
                this.year = this.season.starts_in;
                this.league_id = this.season.league_id;
            }
            else if (this.leagueId) {
                this.league_id = this.leagueId;
            }
        },
        methods: {
            handleSubmit() {
                this.isLoading = true;

                this.$http.post(this.saveUrl, { 
                    starts_in: this.year,
                    ends_in: Number(this.year) + 1,
                    id: this.id,
                    league_id: this.league_id,
                    active: this.active,
                    teams: this.selectedTeams
                }).then(res => {
                    this.addToastSuccess('Season saved successfully.');

                    this.name = '';
                }).catch(err => {
                    this.addToastError(err, 'Error saving season.');
                }).finally(() => {
                    this.isLoading = false;
                });
            }
        }
    }
</script>