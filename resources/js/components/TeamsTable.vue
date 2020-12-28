<template>
    <b-table 
        striped 
        table-variant="dark" 
        bordered 
        table-class="mt-3"
        :items="mtbTeams"
        :fields="fields"
        v-if="mtbTeams.length"
    >
        <template #cell(actions)="data">
            <a :href="`${formRoute}/${data.item.id}`" class="btn btn-primary">
                <i class="fas fa-edit"></i>
            </a>
            <button class="btn btn-danger" @click.prevent="handleDelete(data.item.id)">
                <i class="fas fa-trash"></i>
            </button>
        </template>
    </b-table>
    <h6 v-else>No teams found.</h6>
</template>

<script>
    export default {
        name: "TeamsTable",
        props: {
            teams: {
                type: Array,
                required: true
            },
            formRoute: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                mtbTeams: [],
                fields: [
                    {
                        key: 'id',
                        sortable: true,
                        label: '#',
                        class: "id-column"
                    },
                    {
                        key: 'name',
                        sortable: true,
                        label: 'Name'
                    },
                    {
                        key: 'actions',
                        label: 'Actions',
                        class: 'team-actions-column'
                    }
                ]
            }
        },
        methods: {
            handleDelete(id) {
                this.$bvModal.msgBoxConfirm(`Are you sure you want to delete team #${id}?`, {
                    headerBgVariant: 'dark',
                    footerBgVariant: 'dark',
                    bodyBgVariant: 'dark',
                    okVariant: 'danger',
                    okTitle: 'Delete'
                })
                    .then(value => {
                        if (value) {
                            this.deleteTeam(id);
                        }
                    })
                    .catch();
            },
            removeTeamFromTable(id) {
                const index = this.mtbTeams.findIndex(i => i.id == id);

                if (index != -1)
                    this.mtbTeams.splice(index, 1);
            },
            deleteTeam(id) {
                this.$http
                    .delete('/teams/' + id)
                    .then(response => {
                        if (response.data.status) {
                            this.$bvToast.toast('Team deleted successfully.', {
                                title: 'Success!',
                                variant: 'success',
                                solid: true
                            });

                            this.removeTeamFromTable(id);
                        }
                        else {
                            this.$bvToast.toast('Error deleting team.', {
                                title: 'Error!',
                                variant: 'danger',
                                solid: true
                            });
                        }
                    }).catch(error => {
                        this.$bvToast.toast('Error deleting team.', {
                            title: 'Error!',
                            variant: 'danger',
                            solid: true
                        });
                    });
            }
        },
        created() {
            this.mtbTeams = this.teams;
        }
    }
</script>

<style>
    .team-actions-column {
        width: 120px;
    }
</style>