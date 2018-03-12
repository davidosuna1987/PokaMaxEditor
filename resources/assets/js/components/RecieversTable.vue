<template>
  <div class="card">
    <div class="card-content">
      <div class="field m-t-30">
        <b-switch v-model="isModalTablePaginated" size="is-small" type="is-info">Paginated</b-switch>
      </div>
      <b-table
          narrowed
          hoverable
          striped
          :paginated="isModalTablePaginated"
          per-page="10"
          pagination-size="is-small"
          :data="reciever_addresses"
          detailed
          default-sort-direction="asc"
          default-sort="name">

          <template slot-scope="props">
              <b-table-column field="name" label="Name" sortable>
                   {{ props.row.address.name }}
              </b-table-column>

              <b-table-column field="surnames" label="Surnames" sortable>
                  {{ props.row.address.surnames }}
              </b-table-column>

              <b-table-column field="birthday" label="Birthday" sortable>
                  {{ formattedDate(props.row.address.birthday) }}
              </b-table-column>
          </template>

          <div class="reciever_container" slot="detail" slot-scope="props">
              <article class="contact-details">
                <form class="reciever_form">
                    <div class="field field-reciever-company">
                        <input
                            type="text"
                            id="reciever_company"
                            name="reciever_company"
                            placeholder="Company"
                            disabled
                            v-model="props.row.address.company" />
                    </div>
                    <div class="field field-reciever-birthday">
                        <input
                            type="date"
                            id="reciever_birthday"
                            name="reciever_birthday"
                            placeholder="Birthday"
                            disabled
                            v-model="props.row.address.birthday" />
                    </div>
                    <div class="field field-reciever-title">
                        <input
                            type="text"
                            id="reciever_title"
                            name="reciever_title"
                            placeholder="Mr"
                            disabled
                            v-model="props.row.address.title" />
                    </div>
                    <div class="field field-reciever-name">
                        <input
                            type="text"
                            id="reciever_name"
                            name="reciever_name"
                            placeholder="Name *"
                            disabled
                            v-model="props.row.address.name" />
                    </div>
                    <div class="field field-reciever-surnames">
                        <input
                            type="text"
                            id="reciever_surnames"
                            name="reciever_surnames"
                            placeholder="Surnames *"
                            disabled
                            v-model="props.row.address.surnames" />
                    </div>
                    <div class="field field-reciever-address-line-1">
                        <input
                            type="text"
                            id="reciever_address_line_1"
                            name="reciever_address_line_1"
                            placeholder="Address line 1 *"
                            disabled
                            v-model="props.row.address.address_line_1" />
                    </div>
                    <div class="field field-reciever-address-line-2">
                        <input
                            type="text"
                            id="reciever_address_line_2"
                            name="reciever_address_line_2"
                            placeholder="Address line 2"
                            disabled
                            v-model="props.row.address.address_line_2" />
                    </div>
                    <div class="field field-reciever-city">
                        <input
                            type="text"
                            id="reciever_city"
                            name="reciever_city"
                            placeholder="City *"
                            disabled
                            v-model="props.row.address.city" />
                    </div>
                    <div class="field field-reciever-country">
                        <input
                            type="text"
                            id="reciever_country"
                            name="reciever_country"
                            placeholder="Country *"
                            disabled
                            v-model="props.row.address.country" />
                    </div>
                    <div class="field field-reciever-zip">
                        <input
                            type="number"
                            id="reciever_zip_code"
                            name="reciever_zip_code"
                            placeholder="Zip *"
                            disabled
                            v-model="props.row.address.zip_code" />
                    </div>
                </form>
              </article>
          </div>
      </b-table>
    </div>
  </div>
</template>

<script>
    export default {
        props: ['recieverAddressesProps'],
        data() {
            return {
                reciever_addresses: [],
                isModalTablePaginated: true
            }
        },
        methods: {
            formattedDate(date) {
                if(date){
                    let d = new Date(date);
                    let month = String(d.getMonth() + 1);
                    let day = String(d.getDate());
                    const year = String(d.getFullYear());

                    if (month.length < 2) month = '0' + month;
                    if (day.length < 2) day = '0' + day;

                    return `${month}/${day}/${year}`;
                }
                return '';
            }
        },
        mounted() {
            this.reciever_addresses = this.recieverAddressesProps;
        }
    }
</script>

