<template>
    <form @submit.prevent="handleSubmit" class="col-md-8 bg-dark text-white py-3 rounded">
        <h3 class="text-center mb-3">
            Save Match Result
        </h3>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label" required>Home Team</label>
                    <v-select
                        :options="teams"
                        label="name"
                        v-model="home_team_id"
                        class="form-control p-0 h-auto"
                        :reduce="team => team.id"
                        required
                    ></v-select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Goals</label>
                    <input type="number" class="form-control" required v-model="home_team_goals" min="0">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label for="match-away-team" class="form-label" required>Away Team</label>
                    <v-select
                        :options="teams"
                        label="name"
                        v-model="away_team_id"
                        class="form-control p-0 h-auto"
                        :reduce="team => team.id"
                        required
                    ></v-select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Goals</label>
                    <input type="number" class="form-control" required v-model="away_team_goals" min="0">
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit" :disabled="isLoading">Save</button>
    </form>
</template>
<script>
    import toasts from '../mixins/toasts';
    import vSelect from 'vue-select';

    export default {
        name: "MatchForm",
        mixins: [toasts],
        components: {vSelect},
        props: {
            teams: {
                type: Array,
                required: true
            },
            saveUrl: {
                type: String,
                required: true
            },
            seasonId: {
                type: Number,
                required: true
            }
        },
        data() {
            return {
                isLoading: false,
                home_team_id: null,
                away_team_id: null,
                winner_id: null,
                home_team_goals: 0,
                away_team_goals: 0
            }
        },
        watch: {
            home_team_goals: function() {
                this.setWinner();
            },
            away_team_goals: function() {
                this.setWinner();
            }
        },
        methods: {
            setWinner() {
                const goal_difference = Number(this.home_team_goals) - Number(this.away_team_goals);

                if (goal_difference == 0)
                    this.winner_id = null;
                else if (goal_difference > 0)
                    this.winner_id = this.home_team_id;
                else
                    this.winner_id = this.away_team_id;
            },
            handleSubmit() {
                this.isLoading = true;

                this.$http.post(this.saveUrl, {
                    season_id: this.seasonId,
                    home_team_id: this.home_team_id,
                    away_team_id: this.away_team_id,
                    winner_id: this.winner_id,
                    home_team_goals: this.home_team_goals,
                    away_team_goals: this.away_team_goals,
                    result: this.home_team_goals + 'x' + this.away_team_goals
                }).then(res => {
                    this.addToastSuccess('Match saved successfully.');

                    this.home_team_id = null;
                    this.away_team_id = null;
                    this.winner_id = null;
                    this.home_team_goals = 0;
                    this.away_team_goals = 0;
                }).catch(err => {
                    this.addToastError(err, 'Error saving match.');
                }).finally(() => {
                    this.isLoading = false;
                });
            }
        }
    }
</script>