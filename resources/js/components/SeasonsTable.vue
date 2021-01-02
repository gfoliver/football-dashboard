<template>
    <b-table 
        striped 
        table-variant="dark" 
        bordered 
        table-class="mt-3"
        :items="mtbSeasons"
        :fields="fields"
        v-if="mtbSeasons.length"
    >
        <template #cell(name)="data">
            <a :href="`${innerRoute}/${data.item.id}`">{{ data.item.name }}</a>
        </template>
        <template #cell(active)="data">
            <i class="fas fa-check text-success" v-if="data.item.active"></i>
            <i class="fas fa-times text-danger" v-else></i>
        </template>
        <template #cell(actions)="data">
            <a :href="`${innerRoute}/${data.item.id}`" class="btn btn-primary">
                <i class="fas fa-eye"></i>
            </a>
            <a :href="`${formRoute}/${data.item.id}`" class="btn btn-primary">
                <i class="fas fa-edit"></i>
            </a>
            <button class="btn btn-danger" @click.prevent="handleDelete(data.item.id)">
                <i class="fas fa-trash"></i>
            </button>
        </template>
    </b-table>
    <h6 v-else>No seasons found.</h6>
</template>
<script>
    import toasts from '../mixins/toasts';
    import confirm from '../mixins/confirm';

    export default {
        name: "SeasonsTable",
        mixins: [toasts, confirm],
        props: {
            formRoute: {
                type: String,
                required: true
            },
            innerRoute: {
                type: String,
                required: true
            },
            seasons: {
                type: Array,
                required: true
            },
            deleteUrl: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                mtbSeasons: [],
                fields: [
                    {
                        key: 'id',
                        sortable: true,
                        label: '#',
                        class: 'id-column align-row-center'
                    },
                    {
                        key: 'name',
                        sortable: true,
                        label: 'Name',
                        class: 'align-row-center'
                    },
                    {
                        key: 'active',
                        label: 'Active',
                        class: 'align-row-center'
                    },
                    {
                        key: 'actions',
                        label: 'Actions',
                        class: 'season-actions-column'
                    }
                ]
            }
        },
        methods: {
            handleDelete(id) {
                this.confirm({
                    title: `Are you sure you want to delete this season?`,
                    okTitle: 'Delete',
                    okVariant: 'danger'
                }).then(value => {
                    if (value) {
                        this.deleteTeam(id);
                    }
                }).catch();
            },
            removeLeagueFromTable(id) {
                const index = this.mtbLeagues.findIndex(i => i.id == id);

                if (index != -1)
                    this.mtbLeagues.splice(index, 1);
            },
            deleteTeam(id) {
                console.log(id);
                return;

                this.$http
                    .delete(this.deleteUrl + id)
                    .then(response => {
                        if (response.data.status) {
                            this.addToastSuccess('Season deleted successfully.');

                            this.removeLeagueFromTable(id);
                        }
                        else {
                            this.addToastError(null, 'Error deleting season.');
                        }
                    }).catch(error => {
                        this.addToastError(error, 'Error deleting season.');
                    });
            }
        },
        created() {
            this.mtbSeasons = this.seasons;
        }
    }
</script>

<style>
    .season-actions-column {
        width: 162px;
    }
</style>