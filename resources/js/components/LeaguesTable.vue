<template>
    <b-table 
        striped 
        table-variant="dark" 
        bordered 
        table-class="mt-3"
        :items="mtbLeagues"
        :fields="fields"
        v-if="mtbLeagues.length"
    >
        <template #cell(name)="data">
            <a :href="`${innerRoute}/${data.item.slug}`">{{ data.item.name }}</a>
        </template>
        <template #cell(actions)="data">
            <a :href="`${innerRoute}/${data.item.slug}`" class="btn btn-primary">
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
    <h6 v-else>No leagues found.</h6>
</template>
<script>
    import toasts from '../mixins/toasts';
    import confirm from '../mixins/confirm';

    export default {
        name: "LeaguesTable",
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
            leagues: {
                type: Array,
                required: true
            }
        },
        data() {
            return {
                mtbLeagues: [],
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
                        key: 'actions',
                        label: 'Actions',
                        class: 'leagues-actions-column'
                    }
                ]
            }
        },
        methods: {
            handleDelete(id) {
                const name = this.mtbLeagues.find(i => i.id == id).name;

                this.confirm({
                    title: `Are you sure you want to delete '${name}'?`,
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
                this.$http
                    .delete('/leagues/' + id)
                    .then(response => {
                        if (response.data.status) {
                            this.addToastSuccess('League deleted successfully.');

                            this.removeLeagueFromTable(id);
                        }
                        else {
                            this.addToastError(null, 'Error deleting league.');
                        }
                    }).catch(error => {
                        this.addToastError(error, 'Error deleting league.');
                    });
            }
        },
        created() {
            this.mtbLeagues = this.leagues;
        }
    }
</script>

<style>
    .leagues-actions-column {
        width: 162px;
    }
</style>