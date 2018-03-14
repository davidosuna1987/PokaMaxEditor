<template>
    <div class="postcards-show">
        <div class="field m-t-30">
            <b-switch v-model="showPictures" size="is-small" type="is-info">Show pictures</b-switch>
        </div>
        <b-table
            v-if="postcards && postcards.length"
            class="postcards-table"
            narrowed
            hoverable
            striped
            :paginated="isPaginated"
            per-page="20"
            pagination-size="is-small"
            :data="postcards"
            default-sort-direction="asc"
            default-sort="id">

            <template slot-scope="props">
                <b-table-column field="id" label="#" width="40" sortable>
                    {{ props.row.id }}
                </b-table-column>

                <b-table-column :visible="showPictures" field="picture" label="Picture">
                    <figure class="postcard-picture">
                        <img :src="props.row.front_thumbnail_file_path" alt="Postcard picture" width="100">
                    </figure>
                </b-table-column>

                <b-table-column v-if="props.row.user" field="company" label="Company" :custom-sort="sortByUser" sortable>
                    {{ props.row.user.address.company }}
                </b-table-column>

                <b-table-column field="recievers" label="Recievers" :custom-sort="sortByRecievers"  sortable>
                    <a
                        href="#"
                        class="button is-info is-small"
                        @click.prevent="showRecievers(props.row.reciever_addresses)">{{ props.row.reciever_addresses.length }} {{props.row.reciever_addresses.length == 1 ? 'reciever' : 'recievers'}}</a>
                </b-table-column>

                <b-table-column field="status" label="Status" sortable>
                    <b-tag :type="[{'is-warning' : props.row.status === 'DRAFT'}]">{{ props.row.status }}</b-tag>
                </b-table-column>

                <b-table-column label="Actions" width="290">
                    <a href="" class="button is-small m-r-5">
                        <span class="icon m-r-5"><i class="mdi mdi-eye"></i></span>Show
                    </a>
                    <a href="" class="button is-small m-r-5 is-info">
                        <span class="icon m-r-5"><i class="mdi mdi-pencil"></i></span>Edit
                    </a>
                    <a href="" class="button is-small m-r-5 is-link">
                        <span class="icon m-r-5"><i class="fa fa-file-pdf-o"></i></span>Invoice
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
                    {{companyProp ? company.address.company + " doesn't have postcards created yet" : "No postcards created yet"}}
                </div>
                <div class="level-right">
                    <a href="/editor" class="button is-info">Create postcard</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import RecieversTable from './RecieversTable.vue';

    export default {
        props: ['companyProp', 'postcardsProp'],
        data() {
            return {
                company: null,
                postcards: null,
                isPaginated: false,
                showPictures: false
            }
        },
        methods: {
            sortByUser(a, b, asc) {
                if(asc){
                    return a.user.address.company >= b.user.address.company;
                }else{
                    return a.user.address.company <= b.user.address.company;
                }
            },
            sortByRecievers(a, b, asc) {
                if(asc){
                    return a.reciever_addresses.length >= b.reciever_addresses.length;
                }else{
                    return a.reciever_addresses.length <= b.reciever_addresses.length;
                }
            },
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
            if(this.companyProp && !_.isEmpty(this.companyProp)){
                this.company = JSON.parse(this.companyProp);
            }
            this.postcards = JSON.parse(this.postcardsProp);
        }
    }
</script>
