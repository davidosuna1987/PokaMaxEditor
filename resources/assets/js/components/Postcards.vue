<template>
    <div v-if="company" class="postcards-show">
        <div class="columns is-centered">
            <div class="column is-10">
                <p class="title is-3 has-text-info">{{company.address.company}} postcards</p>
                <!-- <div v-if="company.postcards.length" class="card">
                    <div class="card-content">
                        <div class="columns">
                            <div v-for="postcard in company.postcards" class="column is-3">
                                <img :src="postcard.front_cropped_file_path" alt="Postcard front image">
                            </div>
                        </div>
                    </div>
                </div> -->

                <b-table
                    v-if="company.postcards.length"
                    class="postcards-table"
                    narrowed
                    hoverable
                    striped
                    :paginated="isPaginated"
                    per-page="20"
                    pagination-size="is-small"
                    :data="company.postcards"
                    default-sort-direction="asc"
                    default-sort="id">

                    <template slot-scope="props">
                        <b-table-column field="id" label="#" width="40" sortable>
                            {{ props.row.id }}
                        </b-table-column>

                        <b-table-column field="picture" label="Picture">
                            <figure class="postcard-picture">
                                <img :src="props.row.front_cropped_file_path" alt="Postcard picture" width="100">
                            </figure>
                        </b-table-column>

                        <b-table-column field="recievers" label="Recievers" sortable>
                            <a
                                href="#"
                                class="button is-info is-small"
                                @click.prevent="showRecievers(props.row.reciever_addresses)">{{ props.row.reciever_addresses.length }} {{props.row.reciever_addresses.length == 1 ? 'reciever' : 'recievers'}}</a>
                        </b-table-column>

                        <b-table-column field="status" label="Status" sortable>
                            {{ props.row.status }}
                        </b-table-column>

                        <b-table-column label="Actions" width="290">
                            <a href="" class="button is-small m-r-5">
                                <span class="icon m-r-5"><i class="mdi mdi-eye"></i></span>Show
                            </a>
                            <a href="" class="button is-small m-r-5 is-info">
                                <span class="icon m-r-5"><i class="mdi mdi-pencil"></i></span>Edit
                            </a>
                            <a href="" class="button is-small m-r-5 is-link">
                                <span class="icon m-r-5"><i class="fa fa-file-pdf-o"></i></span>Invoices
                            </a>
                            <a href="" class="delete-invoice-button button is-small is-danger">
                                <span class="icon"><i class="mdi mdi-delete"></i></span>
                            </a>
                        </b-table-column>
                    </template>
                </b-table>

                <div v-else class="card">
                    <div class="level p-10">
                        <div class="level-left">
                            This company doesn't have any postcard yet.
                        </div>
                        <div class="level-right">
                            <a href="/editor" class="button is-info">Create postcard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import RecieversTable from './RecieversTable.vue';

    export default {
        props: ['companyProp'],
        data() {
            return {
                company: null,
                isPaginated: false
            }
        },
        methods: {
            getPostcards() {
                console.info('company');
            },
            showRecievers(reciever_addresses) {
                this.$modal.open({
                    parent: this,
                    component: RecieversTable,
                    props: {recieverAddressesProps: reciever_addresses}
                });
            }
        },
        mounted() {
            this.company = JSON.parse(this.companyProp);
        }
    }
</script>
