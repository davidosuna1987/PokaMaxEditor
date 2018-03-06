<template>
    <div v-if="company" class="companies-show">
        <div class="columns is-centered">
            <div class="column is-8">
                <p class="title is-3 has-text-info">{{company.address.company}}</p>
                <div class="card m-b-30">
                    <div class="card-header">
                        <p class="card-header-title">Information</p>
                        <template v-if="isEditingCompany">
                            <a href="#"
                                class="card-header-icon has-text-success is-pulled-right p-0 m-r-10 m-l-5"
                                aria-label="Edit company information"
                                @click.prevent="updateCompany">
                                <span class="icon">
                                    <i class="mdi mdi-check" aria-hidden="true"></i>
                                </span>
                            </a>
                        </template>
                        <template v-else>
                            <a href="#"
                                class="card-header-icon is-pulled-right p-0 m-r-10 m-l-5"
                                aria-label="Update company information"
                                @click.prevent="editCompany">
                                <span class="icon">
                                    <i class="mdi mdi-pencil" aria-hidden="true"></i>
                                </span>
                            </a>
                        </template>
                    </div>
                    <div class="card-content">
                        <div class="reciever_container">
                            <form v-on:submit.prevent="updateCompany" class="reciever_form company-info-form">
                                <div class="field field-reciever-company">
                                    <label class="label">Company name</label>
                                    <input
                                        type="text"
                                        id="reciever_company"
                                        name="reciever_company"
                                        placeholder="Company"
                                        :disabled="!isEditingCompany"
                                        v-model="company.address.company" />
                                </div>
                                <div class="field field-reciever-birthday">
                                    <label class="label">Birthday</label>
                                    <input
                                        type="date"
                                        id="reciever_birthday"
                                        name="reciever_birthday"
                                        placeholder="Birthday"
                                        :disabled="!isEditingCompany"
                                        v-model="company.address.birthday" />
                                </div>
                                <div class="field field-reciever-title">
                                    <label class="label">Title</label>
                                    <input
                                        type="text"
                                        id="reciever_title"
                                        name="reciever_title"
                                        placeholder="Title"
                                        :disabled="!isEditingCompany"
                                        v-model="company.address.title" />
                                </div>
                                <div class="field field-reciever-name">
                                    <label class="label">Name</label>
                                    <input
                                        type="text"
                                        id="reciever_name"
                                        name="reciever_name"
                                        placeholder="Name *"
                                        :disabled="!isEditingCompany"
                                        v-model="company.address.name" />
                                </div>
                                <div class="field field-reciever-surnames">
                                    <label class="label">Surnames</label>
                                    <input
                                        type="text"
                                        id="reciever_surnames"
                                        name="reciever_surnames"
                                        placeholder="Surnames *"
                                        :disabled="!isEditingCompany"
                                        v-model="company.address.surnames" />
                                </div>
                                <div class="field field-reciever-address-line-1">
                                    <label class="label">Address line 1</label>
                                    <input
                                        type="text"
                                        id="reciever_address_line_1"
                                        name="reciever_address_line_1"
                                        placeholder="Address line 1 *"
                                        :disabled="!isEditingCompany"
                                        v-model="company.address.address_line_1" />
                                </div>
                                <div
                                    v-if="isEditingCompany || (!isEditingCompany && company.address.address_line_2)"
                                    class="field field-reciever-address-line-2">
                                    <label class="label">Address line 2</label>
                                    <input
                                        type="text"
                                        id="reciever_address_line_2"
                                        name="reciever_address_line_2"
                                        placeholder="Address line 2"
                                        :disabled="!isEditingCompany"
                                        v-model="company.address.address_line_2" />
                                </div>
                                <div class="field field-reciever-city">
                                    <label class="label">City</label>
                                    <input
                                        type="text"
                                        id="reciever_city"
                                        name="reciever_city"
                                        placeholder="City *"
                                        :disabled="!isEditingCompany"
                                        v-model="company.address.city" />
                                </div>
                                <div class="field field-reciever-country">
                                    <label class="label">Country</label>
                                    <input
                                        type="text"
                                        id="reciever_country"
                                        name="reciever_country"
                                        placeholder="Country *"
                                        :disabled="!isEditingCompany"
                                        v-model="company.address.country" />
                                </div>
                                <div class="field field-reciever-zip">
                                    <label class="label">ZIP</label>
                                    <input
                                        type="number"
                                        id="reciever_zip_code"
                                        name="reciever_zip_code"
                                        placeholder="Zip *"
                                        :disabled="!isEditingCompany"
                                        v-model="company.address.zip_code" />
                                </div>
                                <div v-if="isEditingCompany" class="field has-text-right m-t-30">
                                    <button class="button is-info" @click.prevent="updateCompany">Update info</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="level">
                    <div class="level-left">
                        <p class="title is-5 has-text-info">Address lists</p>
                    </div>
                    <div class="level-right">
                        <button v-if="!isCreatingAddressList" class="button is-link is-small" @click.prevent="createAddressList">Create address list</button>
                    </div>
                </div>

                <div v-if="isCreatingAddressList" class="card card-create-address-list">
                    <div class="card-header">
                        <p class="card-header-title">
                            <input
                                type="text"
                                placeholder="Address list name"
                                class="update-address-list-input"
                                v-on:keyup.enter="storeAddresList"
                                :class="[{ 'has-error': newAddressListHasError }]"
                                v-model="newAddressList.name">
                                <span v-if="newAddressListHasError" class="error has-text-danger is-size-7">
                                    <span class="error-message">
                                        {{newAddressListErrors['name'][0]}}
                                    </span>
                                </span>
                        </p>
                        <a href="#"
                           class="card-header-icon has-text-success is-pulled-right p-0 m-r-10 m-l-5"
                           aria-label="Store address list"
                           @click.prevent="storeAddresList">
                            <span class="icon">
                                <i class="mdi mdi-check" aria-hidden="true"></i>
                            </span>
                        </a>
                        <a href="#"
                           class="card-header-icon has-text-danger is-pulled-right p-0 m-r-10 m-l-5"
                           aria-label="Cancel address list"
                           @click.prevent="cancelAddresList">
                            <span class="icon">
                                <i class="mdi mdi-close" aria-hidden="true"></i>
                            </span>
                        </a>
                    </div>
                </div>

                <div v-for="(addressList, index) in company.address_lists" class="card card-address-list" :data-id="addressList.id">
                    <div class="card-header">
                        <template v-if="updatingAddressListId !== index">
                            <p class="card-header-title">{{addressList.name}} <small class="has-text-weight-light m-l-5">({{addressList.addresses.length}})</small></p>
                            <a href="#"
                               class="card-header-icon has-text-info is-pulled-right p-0 m-r-5 m-l-5"
                               aria-label="Show addresses"
                               @click.prevent="toggleAddressList(addressList)">
                                <span class="icon">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                </span>
                            </a>
                            <a href="#"
                               class="card-header-icon is-pulled-right p-0 m-r-5 m-l-5"
                               aria-label="Edit address list"
                               :disabled="addressList.name === 'Uncategorized'"
                               @click.prevent="editAddressList(index)">
                                <span class="icon">
                                    <i class="mdi mdi-pencil" aria-hidden="true"></i>
                                </span>
                            </a>
                            <a href="#"
                               class="card-header-icon has-text-danger is-pulled-right p-0 m-r-10 m-l-5"
                               :disabled="addressList.name === 'Uncategorized'"
                               aria-label="Delete address list"
                               @click.prevent="deleteAddressList(addressList)">
                                <span class="icon">
                                    <i class="mdi mdi-delete" aria-hidden="true"></i>
                                </span>
                            </a>
                        </template>
                        <template v-else>
                            <p class="card-header-title">
                                <input
                                    type="text"
                                    :data-index="index"
                                    placeholder="Address list name"
                                    class="update-address-list-input"
                                    v-on:keyup.enter="updateAddressList(index)"
                                    v-model="company.address_lists[index].name">
                            </p>
                            <a href="#"
                               class="card-header-icon has-text-success is-pulled-right p-0 m-r-10 m-l-5"
                               aria-label="Update address list"
                               @click.prevent="updateAddressList(index)">
                                <span class="icon">
                                    <i class="mdi mdi-check" aria-hidden="true"></i>
                                </span>
                            </a>
                        </template>
                    </div>

                    <div class="card-content">
                        <template v-if="addressList.addresses.length">
                            <button class="button is-link is-small is-pulled-right" @click.prevent="editBulckActions(index)">
                                {{bulckActionAddressesActive === index ? 'Hide bulck actions' : 'Show bulck actions'}}
                            </button>

                            <button v-if="bulckActionAddressesActive !== index" class="button is-info is-small m-r-5">Import contacts</button>

                            <template v-if="bulckActionAddressesActive === index">
                                <button
                                    class="button is-danger is-small is-pulled-right m-r-5"
                                    :disabled="!bulckActionAddresses.length"
                                    @click.prevent="deleteBulckActionAddresses">
                                    <span class="icon">
                                        <i class="mdi mdi-delete"></i>
                                    </span>
                                </button>
                            </template>
                        </template>

                        <template v-else>
                            <p>You don't have any contacts added to this list
                                <button class="button is-info is-small is-pulled-right">Import contacts</button>
                            </p>
                        </template>

                        <b-table
                          v-if="addressList.addresses && addressList.addresses.length"
                          hoverable
                          striped
                          :checkable="bulckActionAddressesActive === index"
                          :data="addressList.addresses"
                          :checked-rows.sync="bulckActionAddresses">

                          <template slot-scope="props">
                            <b-table-column field="name" label="Name">
                                {{ props.row.name }}
                            </b-table-column>
                            <b-table-column field="surnames" label="Surnames">
                                {{ props.row.surnames }}
                            </b-table-column>
                          </template>
                        </b-table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['companyId'],
        data() {
            return {
                newAddressListErrors: null,
                company: null,
                isEditingCompany: false,
                updatingAddressListId: null,
                bulckActionAddressesActive: null,
                bulckActionAddresses: [],
                isCreatingAddressList: false,
                newAddressList: {
                    name: null,
                    companyId: null
                }
            }
        },
        computed: {
            newAddressListHasError() {
              return this.newAddressListErrors != null && !_.isEmpty(this.newAddressListErrors) && !_.isEmpty(this.newAddressListErrors['name']);
            },
            newCompanyCompanyHasError() {
              return this.newCompanyErrors != null && !_.isEmpty(this.newCompanyErrors) && !_.isEmpty(this.newCompanyErrors['company']);
            },
            newCompanyNameHasError() {
              return this.newCompanyErrors != null && !_.isEmpty(this.newCompanyErrors) && !_.isEmpty(this.newCompanyErrors['name']);
            },
            newCompanySurnamesHasError() {
              return this.newCompanyErrors != null && !_.isEmpty(this.newCompanyErrors) && !_.isEmpty(this.newCompanyErrors['surnames']);
            },
            newCompanyAddressHasError() {
              return this.newCompanyErrors != null && !_.isEmpty(this.newCompanyErrors) && !_.isEmpty(this.newCompanyErrors['address_line_1']);
            },
            newCompanyCityHasError() {
              return this.newCompanyErrors != null && !_.isEmpty(this.newCompanyErrors) && !_.isEmpty(this.newCompanyErrors['city']);
            },
            newCompanyCountryHasError() {
              return this.newCompanyErrors != null && !_.isEmpty(this.newCompanyErrors) && !_.isEmpty(this.newCompanyErrors['country']);
            },
            newCompanyZipHasError() {
              return this.newCompanyErrors != null && !_.isEmpty(this.newCompanyErrors) && !_.isEmpty(this.newCompanyErrors['zip_code']);
            }
        },
        watch: {
            newAddressList: {
                handler(val){
                    this.removeErrors();
                },
                deep: true
            },
        },
        methods: {
            getCompany() {
                axios.get('/api/companies/'+this.companyId)
                .then(response => {
                    this.company = response.data;
                }).catch(error => {
                    if(error.response.status && error.response.status === 419){
                        location.href = '/login';
                    }
                    console.info(error);
                });
            },
            editCompany() {
                this.isEditingCompany = true;
                setTimeout(function(){
                    $('.company-info-form #reciever_company').focus();
                }, 10);
            },
            updateCompany() {
                this.isEditingCompany = false;
                axios.put('/api/companies/'+this.companyId, this.company.address)
                .then(response => {
                    this.getCompany();
                    this.$snackbar.open(response.data.message);
                }).catch(error => {
                    if(error.response.status && error.response.status === 419){
                        location.href = '/login';
                    }
                    console.info(error);
                    this.errorsCompany = error.response.data.errors;
                    this.$snackbar.open({
                        duration: 5000,
                        message: 'Please correct errors to update company.',
                        type: 'is-danger',
                        queue: false,
                        position: 'is-top',
                        actionText: 'OK',
                        onAction: () => {
                            //Do something on click button
                        }
                    });
                });
            },
            deleteCompany() {
                this.$dialog.confirm({
                    message: 'Are you sure you want to <b>delete</b> '+this.company.address.company+'? This action cannot be undone.',
                    confirmText: 'Delete company',
                    type: 'is-danger',
                    hasIcon: true,
                    onConfirm: () => {
                        axios.delete('/api/companies/'+this.companyId)
                        .then(response => {
                            console.info(response.data);
                            this.$snackbar.open(response.data.message);
                            window.location = '/companies/';
                        }).catch(error => {
                            if(error.response.status && error.response.status === 419){
                                location.href = '/login';
                            }
                            console.info(error);
                        });
                    }
                });
            },
            toggleAddressList(addressList) {
                this.isCreatingAddressList = false;
                let isOpened = $('.card-address-list[data-id="'+addressList.id+'"]').hasClass('opened');
                this.bulckActionAddressesActive = null;

                $('.card-address-list').removeClass('opened').find('.card-content').slideUp();
                if(isOpened){
                    $('.card-address-list[data-id="'+addressList.id+'"]').removeClass('opened').find('.card-content').slideUp();
                } else {
                    $('.card-address-list[data-id="'+addressList.id+'"]').addClass('opened').find('.card-content').slideDown();
                }
            },
            editAddressList(index) {
                if(this.updatingAddressListId === index){
                    this.updatingAddressListId = null;
                } else {
                    this.updatingAddressListId = index;
                    setTimeout(function(){
                        $('.update-address-list-input[data-index="'+index+'"]').focus();
                    }, 10);
                }
            },
            updateAddressList(index){
                let addressList = this.company.address_lists[index];

                axios.put('/api/addresslists/'+addressList.id, {name: addressList.name})
                .then(response => {
                    this.$snackbar.open(response.data.message);
                    this.updatingAddressListId = null;
                    this.isEditingCompany = false;
                    this.getCompany();
                }).catch(error => {
                    if(error.response.status && error.response.status === 419){
                        location.href = '/login';
                    }
                    console.info(error);
                    this.errorsAddressList = error.response.data.errors;
                    this.$snackbar.open({
                        duration: 5000,
                        message: 'Please correct errors to update an address list.',
                        type: 'is-danger',
                        queue: false,
                        position: 'is-top',
                        actionText: 'OK',
                        onAction: () => {
                            //Do something on click button
                        }
                    });
                });
            },
            deleteAddressList(addressList) {
                this.$dialog.confirm({
                    message: 'Are you sure you want to <b>delete '+addressList.name+'</b> address list? This action cannot be undone.',
                    confirmText: 'Delete address list',
                    type: 'is-danger',
                    hasIcon: true,
                    onConfirm: () => {
                        axios.delete('/api/addresslists/'+addressList.id)
                        .then(response => {
                            this.getCompany();
                            this.$snackbar.open({
                                duration: 5000,
                                message: response.data.message,
                                queue: false,
                                onAction: () => {
                                    //Do something on click button
                                }
                            });
                        }).catch(error => {
                            if(error.response.status && error.response.status === 419){
                                location.href = '/login';
                            }
                            console.info(error);
                        });
                    }
                });
            },
            editBulckActions(index) {
                this.bulckActionAddresses = [];
                if(this.bulckActionAddressesActive === index){
                    this.bulckActionAddressesActive = null;
                } else {
                    this.bulckActionAddressesActive = index;
                }
            },
            deleteBulckActionAddresses() {
                for (var i = this.bulckActionAddresses.length - 1; i >= 0; i--) {
                    axios.put('/api/address/'+this.bulckActionAddresses[i].id+'/setnulladdresslist')
                    .then(response => {
                        // Do something on success
                    }).catch(error => {
                        console.info(error);
                    });
                }

                let address_word = this.bulckActionAddresses.length > 1 ? ' addresses ' : ' address ';
                this.$snackbar.open({
                    duration: 5000,
                    message: this.bulckActionAddresses.length+address_word+'was deleted from address list correctly!',
                    queue: false,
                    onAction: () => {
                        //Do something on click button
                    }
                });

                this.getCompany();
            },
            createAddressList() {
                $('.card-address-list').removeClass('opened').find('.card-content').slideUp();
                this.newAddressList.name = null,
                this.newAddressList.company_id = this.company.id;
                this.isCreatingAddressList = true;
                setTimeout(function(){
                    $('.card-create-address-list .update-address-list-input').focus();
                }, 10);
            },
            storeAddresList() {
                axios.post( '/api/addresslists/create', this.newAddressList)
                .then(response => {
                  this.isCreatingAddressList = false;
                  this.getCompany();
                  this.$snackbar.open({
                      duration: 5000,
                      message: response.data.message,
                      queue: false,
                      onAction: () => {
                          //Do something on click button
                      }
                  });
                }).catch(error => {
                  if(error.response.status && error.response.status === 419){
                    location.href = '/login';
                  }
                  console.info(error);
                  $('.card-create-address-list .update-address-list-input').focus();
                  this.newAddressListErrors = error.response.data.errors;
                  this.$snackbar.open({
                      duration: 5000,
                      message: 'Please correct errors to create an address list.',
                      type: 'is-danger',
                      queue: false,
                      position: 'is-top',
                      actionText: 'OK',
                      onAction: () => {
                          //Do something on click button
                      }
                  });
                });
            },
            cancelAddresList() {
                this.isCreatingAddressList = false;
            },
            removeErrors() {
                if(!_.isEmpty(this.newAddressListErrors)){
                    if('name' in this.newAddressListErrors){
                      this.newAddressListErrors['name'] = null;
                    }
                }

              if(!_.isEmpty(this.newCompanyErrors)){
                if('company' in this.newCompanyErrors && !_.isEmpty(this.newCompany.company)){
                  this.newCompanyErrors['company'] = null;
                }
                if('name' in this.newCompanyErrors && !_.isEmpty(this.newCompany.name)){
                  this.newCompanyErrors['name'] = null;
                }
                if('surnames' in this.newCompanyErrors && !_.isEmpty(this.newCompany.surnames)){
                  this.newCompanyErrors['surnames'] = null;
                }
                if('address_line_1' in this.newCompanyErrors && !_.isEmpty(this.newCompany.address_line_1)){
                  this.newCompanyErrors['address_line_1'] = null;
                }
                if('city' in this.newCompanyErrors && !_.isEmpty(this.newCompany.city)){
                  this.newCompanyErrors['city'] = null;
                }
                if('country' in this.newCompanyErrors && !_.isEmpty(this.newCompany.country)){
                  this.newCompanyErrors['country'] = null;
                }
                if('zip_code' in this.newCompanyErrors && !_.isEmpty(this.newCompany.zip_code)){
                  this.newCompanyErrors['zip_code'] = null;
                }
              }
            }
        },
        mounted() {
            this.getCompany();
        }
    }
</script>
