<template>
    <div class="companies-index">
        <div class="columns is-centered">
            <div class="column">
                <div class="level">
                    <div class="level-left"></div>
                    <div class="level-right">
                        <button v-if="creatingCompany" @click.prevent="emptyNewCompanyFields" class="button">Cancel</button>
                        <button v-else @click.prevent="creatingCompany = !creatingCompany" class="button is-info">Create company</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="columns is-centered is-multiline">
            <div v-if="creatingCompany" class="column is-8">
                <div class="reciever_container new-company-form">
                    <form class="reciever_form" v-on:submit.prevent="createCompany">
                        <div class="field field-reciever-email">
                            <input
                                type="email"
                                id="reciever_email"
                                name="reciever_email"
                                placeholder="Email *"
                                v-on:keyup.enter="createCompany"
                                :class="[{ 'has-error': newCompanyErrors['email'] }]"
                                v-model="newCompany.email" />
                                <span v-if="newCompanyErrors['email']" class="error has-text-danger is-size-7">
                                    <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                    <span class="error-message">
                                        {{newCompanyErrors['email'][0]}}
                                    </span>
                                </span>
                        </div>
                        <div class="field field-reciever-password">
                            <input
                                type="password"
                                id="reciever_password"
                                name="reciever_password"
                                placeholder="Password *"
                                v-on:keyup.enter="createCompany"
                                :class="[{ 'has-error': newCompanyErrors['password'] }]"
                                v-model="newCompany.password" />
                                <button class="button is-small is-link generate-password" @click.prevent="generateRandomPassword">Generate password</button>
                                <span v-if="newCompanyErrors['password']" class="error has-text-danger is-size-7">
                                    <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                    <span class="error-message">
                                        {{newCompanyErrors['password'][0]}}
                                    </span>
                                </span>
                        </div>
                        <div class="field field-reciever-company">
                            <input
                                type="text"
                                id="reciever_company"
                                name="reciever_company"
                                placeholder="Company *"
                                v-on:keyup.enter="createCompany"
                                :class="[{ 'has-error': newCompanyErrors['company'] }]"
                                v-model="newCompany.company" />
                                <span v-if="newCompanyErrors['company']" class="error has-text-danger is-size-7">
                                    <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                    <span class="error-message">
                                        {{newCompanyErrors['company'][0]}}
                                    </span>
                                </span>
                        </div>
                        <div class="field field-reciever-birthday">
                            <input
                                type="date"
                                id="reciever_birthday"
                                name="reciever_birthday"
                                placeholder="Birthday"
                                v-on:keyup.enter="createCompany"
                                v-model="newCompany.birthday" />
                        </div>
                        <div class="field field-reciever-title">
                            <input
                                type="text"
                                id="reciever_title"
                                name="reciever_title"
                                placeholder="Title"
                                v-on:keyup.enter="createCompany"
                                v-model="newCompany.title" />
                        </div>
                        <div class="field field-reciever-name">
                            <input
                                type="text"
                                id="reciever_name"
                                name="reciever_name"
                                placeholder="Name *"
                                v-on:keyup.enter="createCompany"
                                :class="[{ 'has-error': newCompanyErrors['name'] }]"
                                v-model="newCompany.name" />
                                <span v-if="newCompanyErrors['name']" class="error has-text-danger is-size-7">
                                    <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                    <span class="error-message">
                                        {{newCompanyErrors['name'][0]}}
                                    </span>
                                </span>
                        </div>
                        <div class="field field-reciever-surnames">
                            <input
                                type="text"
                                id="reciever_surnames"
                                name="reciever_surnames"
                                placeholder="Surnames *"
                                v-on:keyup.enter="createCompany"
                                :class="[{ 'has-error': newCompanyErrors['surnames'] }]"
                                v-model="newCompany.surnames" />
                                <span v-if="newCompanyErrors['surnames']" class="error has-text-danger is-size-7">
                                    <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                    <span class="error-message">
                                        {{newCompanyErrors['surnames'][0]}}
                                    </span>
                                </span>
                        </div>
                        <div class="field field-reciever-address-line-1">
                            <input
                                type="text"
                                id="reciever_address_line_1"
                                name="reciever_address_line_1"
                                placeholder="Address line 1 *"
                                v-on:keyup.enter="createCompany"
                                :class="[{ 'has-error': newCompanyErrors['address_line_1'] }]"
                                v-model="newCompany.address_line_1" />
                                <span v-if="newCompanyErrors['address_line_1']" class="error has-text-danger is-size-7">
                                    <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                    <span class="error-message">
                                        {{newCompanyErrors['address_line_1'][0]}}
                                    </span>
                                </span>
                        </div>
                        <div class="field field-reciever-address-line-2">
                            <input
                                type="text"
                                id="reciever_address_line_2"
                                name="reciever_address_line_2"
                                placeholder="Address line 2"
                                v-on:keyup.enter="createCompany"
                                v-model="newCompany.address_line_2" />
                        </div>
                        <div class="field field-reciever-city">
                            <input
                                type="text"
                                id="reciever_city"
                                name="reciever_city"
                                placeholder="City *"
                                v-on:keyup.enter="createCompany"
                                :class="[{ 'has-error': newCompanyErrors['city'] }]"
                                v-model="newCompany.city" />
                                <span v-if="newCompanyErrors['city']" class="error has-text-danger is-size-7">
                                    <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                    <span class="error-message">
                                        {{newCompanyErrors['city'][0]}}
                                    </span>
                                </span>
                        </div>
                        <div class="field field-reciever-country">
                            <input
                                type="text"
                                id="reciever_country"
                                name="reciever_country"
                                placeholder="Country *"
                                v-on:keyup.enter="createCompany"
                                :class="[{ 'has-error': newCompanyErrors['country'] }]"
                                v-model="newCompany.country" />
                                <span v-if="newCompanyErrors['country']" class="error has-text-danger is-size-7">
                                    <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                    <span class="error-message">
                                        {{newCompanyErrors['country'][0]}}
                                    </span>
                                </span>
                        </div>
                        <div class="field field-reciever-zip">
                            <input
                                type="number"
                                id="reciever_zip_code"
                                name="reciever_zip_code"
                                placeholder="Zip *"
                                v-on:keyup.enter="createCompany"
                                :class="[{ 'has-error': newCompanyErrors['zip_code'] }]"
                                v-model="newCompany.zip_code" />
                                <span v-if="newCompanyErrors['zip_code']" class="error has-text-danger is-size-7">
                                    <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                    <span class="error-message">
                                        {{newCompanyErrors['zip_code'][0]}}
                                    </span>
                                </span>
                        </div>
                        <div class="field has-text-right m-t-30">
                            <button class="button" @click.prevent="emptyNewCompanyFields">Cancel</button>
                            <button class="button is-info" @click.prevent="createCompany">Create company</button>
                        </div>
                    </form>
                </div>
            </div>

            <div v-else class="column is-8">
                <input class="input is-small m-b-30" v-model="searchBy" type="text" placeholder="Search company" />

                <div v-for="(company, index) in filteredCompanies">
                    <div class="card m-b-30 card-company" :data-id="company.id">
                        <div class="card-header">
                            <p class="card-header-title">
                                <span v-html="$options.filters.highlight(company.address.company, searchBy)">{{company.address.company}}</span> <small class="has-text-weight-light m-l-10">(<span v-html="$options.filters.highlight(company.address.name+' '+company.address.surnames, searchBy)">{{company.address.name+' '+company.address.surnames}}</span>)</small>
                            </p>
                            <a :href="'/companies/'+company.id+'/postcards'"
                               class="card-header-icon has-text-primary is-pulled-right p-0 m-r-5 m-l-5"
                               aria-label="Show company postcards"
                               :disabled="!company.postcards.length">
                                <span class="icon">
                                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                                </span>
                            </a>
                            <a :href="'/companies/'+company.id"
                               class="card-header-icon has-text-info is-pulled-right p-0 m-r-5 m-l-5"
                               aria-label="Show company">
                                <span class="icon">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </span>
                            </a>
                            <a href="#"
                               class="card-header-icon is-pulled-right p-0 m-r-5 m-l-5"
                               aria-label="Edit company"
                               @click.prevent="toggleEditForm(company)">
                                <span class="icon">
                                    <i class="mdi mdi-pencil" aria-hidden="true"></i>
                                </span>
                            </a>
                            <a href="#"
                               class="card-header-icon has-text-danger is-pulled-right p-0 m-r-10 m-l-5"
                               aria-label="Delete company"
                               @click.prevent="deleteCompany(company)">
                                <span class="icon">
                                    <i class="mdi mdi-delete" aria-hidden="true"></i>
                                </span>
                            </a>
                        </div>

                        <div class="card-content">
                            <div class="reciever_container">
                                <form class="reciever_form">
                                    <div class="field field-reciever-company">
                                        <label class="label">Company name</label>
                                        <input
                                            type="text"
                                            id="reciever_company"
                                            name="reciever_company"
                                            placeholder="Company"
                                            v-model="updateFields.company"
                                            :class="[{ 'has-error' : updatedCompanyErrors['company'] }]" />
                                            <span v-if="updatedCompanyErrors['company']" class="error has-text-danger is-size-7">
                                                <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                                <span class="error-message">
                                                    {{updatedCompanyErrors['company'][0]}}
                                                </span>
                                            </span>
                                    </div>
                                    <div class="field field-reciever-birthday">
                                        <label class="label">Birthday</label>
                                        <input
                                            type="date"
                                            id="reciever_birthday"
                                            name="reciever_birthday"
                                            placeholder="Birthday"
                                            v-model="updateFields.birthday" />
                                    </div>
                                    <div class="field field-reciever-title">
                                        <label class="label">Title</label>
                                        <input
                                            type="text"
                                            id="reciever_title"
                                            name="reciever_title"
                                            placeholder="Title"
                                            v-model="updateFields.title" />
                                    </div>
                                    <div class="field field-reciever-name">
                                        <label class="label">Name</label>
                                        <input
                                            type="text"
                                            id="reciever_name"
                                            name="reciever_name"
                                            placeholder="Name *"
                                            v-model="updateFields.name"
                                            :class="[{ 'has-error' : updatedCompanyErrors['name'] }]" />
                                            <span v-if="updatedCompanyErrors['name']" class="error has-text-danger is-size-7">
                                                <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                                <span class="error-message">
                                                    {{updatedCompanyErrors['name'][0]}}
                                                </span>
                                            </span>
                                    </div>
                                    <div class="field field-reciever-surnames">
                                        <label class="label">Surnames</label>
                                        <input
                                            type="text"
                                            id="reciever_surnames"
                                            name="reciever_surnames"
                                            placeholder="Surnames *"
                                            v-model="updateFields.surnames"
                                            :class="[{ 'has-error' : updatedCompanyErrors['surnames'] }]" />
                                            <span v-if="updatedCompanyErrors['surnames']" class="error has-text-danger is-size-7">
                                                <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                                <span class="error-message">
                                                    {{updatedCompanyErrors['surnames'][0]}}
                                                </span>
                                            </span>
                                    </div>
                                    <div class="field field-reciever-address-line-1">
                                        <label class="label">Address line 1</label>
                                        <input
                                            type="text"
                                            id="reciever_address_line_1"
                                            name="reciever_address_line_1"
                                            placeholder="Address line 1 *"
                                            v-model="updateFields.address_line_1"
                                            :class="[{ 'has-error' : updatedCompanyErrors['address_line_1'] }]" />
                                            <span v-if="updatedCompanyErrors['address_line_1']" class="error has-text-danger is-size-7">
                                                <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                                <span class="error-message">
                                                    {{updatedCompanyErrors['address_line_1'][0]}}
                                                </span>
                                            </span>
                                    </div>
                                    <div class="field field-reciever-address-line-2">
                                        <label class="label">Address line 2</label>
                                        <input
                                            type="text"
                                            id="reciever_address_line_2"
                                            name="reciever_address_line_2"
                                            placeholder="Address line 2"
                                            v-model="updateFields.address_line_2" />
                                    </div>
                                    <div class="field field-reciever-city">
                                        <label class="label">City</label>
                                        <input
                                            type="text"
                                            id="reciever_city"
                                            name="reciever_city"
                                            placeholder="City *"
                                            v-model="updateFields.city"
                                            :class="[{ 'has-error' : updatedCompanyErrors['city'] }]" />
                                            <span v-if="updatedCompanyErrors['city']" class="error has-text-danger is-size-7">
                                                <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                                <span class="error-message">
                                                    {{updatedCompanyErrors['city'][0]}}
                                                </span>
                                            </span>
                                    </div>
                                    <div class="field field-reciever-country">
                                        <label class="label">Country</label>
                                        <input
                                            type="text"
                                            id="reciever_country"
                                            name="reciever_country"
                                            placeholder="Country *"
                                            v-model="updateFields.country"
                                            :class="[{ 'has-error' : updatedCompanyErrors['country'] }]" />
                                            <span v-if="updatedCompanyErrors['country']" class="error has-text-danger is-size-7">
                                                <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                                <span class="error-message">
                                                    {{updatedCompanyErrors['country'][0]}}
                                                </span>
                                            </span>
                                    </div>
                                    <div class="field field-reciever-zip">
                                        <label class="label">Zip code</label>
                                        <input
                                            type="number"
                                            id="reciever_zip_code"
                                            name="reciever_zip_code"
                                            placeholder="Zip *"
                                            v-model="updateFields.zip_code"
                                            :class="[{ 'has-error' : updatedCompanyErrors['zip_code'] }]" />
                                            <span v-if="updatedCompanyErrors['zip_code']" class="error has-text-danger is-size-7">
                                                <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                                <span class="error-message">
                                                    {{updatedCompanyErrors['zip_code'][0]}}
                                                </span>
                                            </span>
                                    </div>
                                    <div class="field has-text-right m-t-30">
                                        <button class="button is-info" @click.prevent="updateCompany(company)">Update company</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                searchBy: '',
                newCompanyErrors: {},
                updatedCompanyErrors: {},
                companies: [],
                loadingData: false,
                creatingCompany: false,
                updateFields: {
                    email: '',
                    password: '',
                    address_id: '',
                    address_line_1: '',
                    address_line_2: '',
                    city: '',
                    country: '',
                    zip_code: '',
                    title: '',
                    company: '',
                    name: '',
                    surnames: '',
                    birthday: ''
                },
                newCompany: {
                    email: '',
                    password: '',
                    address_line_1: '',
                    address_line_2: '',
                    city: '',
                    country: '',
                    zip_code: '',
                    title: '',
                    company: '',
                    name: '',
                    surnames: '',
                    birthday: ''
                }
            }
        },
        watch: {
          updateFields: {
            handler(val){
              this.removeErrors();
            },
            deep: true
          },
          newCompany: {
            handler(val){
              this.removeErrors();
            },
            deep: true
          }
        },
        computed: {
            filteredCompanies: function(){
                var vue = this;
                return this.companies.filter(function(comp){
                    let fullName = comp.address.name+' '+comp.address.surnames;
                    return comp.address.company.toLowerCase().indexOf(vue.searchBy.toLowerCase()) >= 0 || fullName.toLowerCase().indexOf(vue.searchBy.toLowerCase()) >= 0;
                });
            }
        },
        methods: {
            getCompanies() {
                this.loadingData = true;
                axios.get('/api/companies/')
                .then(response => {
                    this.companies = response.data;
                    this.loadingData = false;
                }).catch(error => {
                    console.info(error);
                });
            },
            toggleEditForm(company) {
                this.emptyUpdateFields;
                let isOpened = $('.card-company[data-id="'+company.id+'"]').hasClass('opened');
                $('.card-company').removeClass('opened').find('.card-content').slideUp();
                if(isOpened){
                    $('.card-company[data-id="'+company.id+'"]').removeClass('opened').find('.card-content').slideUp();
                } else {
                    this.setUpdateFields(company);
                    $('.card-company[data-id="'+company.id+'"]').addClass('opened').find('.card-content').slideDown();
                }
            },
            setUpdateFields(company) {
                this.updatedCompanyErrors = {};
                let ca = company.address;
                this.updateFields.address_id = ca.id;
                this.updateFields.address_line_1 = ca.address_line_1;
                this.updateFields.address_line_2 = ca.address_line_2;
                this.updateFields.city = ca.city;
                this.updateFields.country = ca.country;
                this.updateFields.zip_code = ca.zip_code;
                this.updateFields.title = ca.title;
                this.updateFields.company = ca.company;
                this.updateFields.name = ca.name;
                this.updateFields.surnames = ca.surnames;
                this.updateFields.birthday = ca.birthday;
            },
            createCompany() {
                // if(this.tempData.company_id !== null){
                //   this.emptyCompanyFields();
                //   return;
                // }

                axios.post('/api/companies/create', this.newCompany)
                .then(response => {
                    console.info(response.data);
                    this.getCompanies();
                    this.emptyNewCompanyFields();
                    this.$snackbar.open({
                        duration: 5000,
                        message: response.data.message,
                        queue: false,
                        onAction: () => {
                            //Do something on click button
                        }
                    });
                }).catch(error => {
                      if(error.response.status === 419){
                        location.href = '/login';
                      }
                      console.info(error);
                      this.newCompanyErrors = error.response.data.errors;
                      console.log(error.response.data);
                      console.log(error.response.status);
                      console.log(error.response.headers);
                      this.$snackbar.open({
                          duration: 5000,
                          message: 'Please correct errors to create a new company.',
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
            updateCompany(company) {
                this.loadingData = true;
                axios.put('/api/companies/'+company.id, this.updateFields)
                .then(response => {
                    this.loadingData = false;
                    this.toggleEditForm(company);
                    this.getCompanies();
                    this.$snackbar.open(response.data.message);
                }).catch(error => {
                      if(error.response.status === 419){
                        location.href = '/login';
                      }
                      console.info(error);
                      this.updatedCompanyErrors = error.response.data.errors;
                      console.log(error.response.data);
                      console.log(error.response.status);
                      console.log(error.response.headers);
                      this.$snackbar.open({
                          duration: 5000,
                          message: 'Please correct errors to create a new company.',
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
            deleteCompany(company) {
                this.$dialog.confirm({
                    message: 'Are you sure you want to <b>delete</b> '+company.address.company+'? This action cannot be undone.',
                    confirmText: 'Delete company',
                    type: 'is-danger',
                    hasIcon: true,
                    onConfirm: () => {
                        axios.delete('/api/companies/'+company.id)
                        .then(response => {
                            console.info(response.data);
                            this.$snackbar.open(response.data.message);
                            this.getCompanies();
                        }).catch(error => {
                            console.info(error);
                        });
                    }
                });
            },
            emptyUpdateFields() {
                this.updateFields.email = '',
                this.updateFields.password = '',
                this.updateFields.address_id = '',
                this.updateFields.address_line_1 = '',
                this.updateFields.address_line_2 = '',
                this.updateFields.city = '',
                this.updateFields.country = '',
                this.updateFields.zip_code = '',
                this.updateFields.title = '',
                this.updateFields.company = '',
                this.updateFields.name = '',
                this.updateFields.surnames = '',
                this.updateFields.birthday = ''
            },
            emptyNewCompanyFields() {
                this.newCompanyErrors = {};
                this.creatingCompany = !this.creatingCompany;


                this.newCompany.email = '',
                this.newCompany.password = '',
                this.newCompany.address_id = '',
                this.newCompany.address_line_1 = '',
                this.newCompany.address_line_2 = '',
                this.newCompany.city = '',
                this.newCompany.country = '',
                this.newCompany.zip_code = '',
                this.newCompany.title = '',
                this.newCompany.company = '',
                this.newCompany.name = '',
                this.newCompany.surnames = '',
                this.newCompany.birthday = ''
            },
            generateRandomPassword() {
                this.newCompany.password = Math.random().toString(36).substring(2) + new Date().getTime().toString(36);
            },
            removeErrors() {
                // Remove new company errors
                if(!_.isEmpty(this.newCompanyErrors)){
                    if('email' in this.newCompanyErrors && !_.isEmpty(this.newCompany.email)){
                      this.newCompanyErrors['email'] = null;
                    }
                    if('password' in this.newCompanyErrors && !_.isEmpty(this.newCompany.password)){
                      this.newCompanyErrors['password'] = null;
                    }
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

                // Remove updated company errors
                if(!_.isEmpty(this.updatedCompanyErrors)){
                    if('company' in this.updatedCompanyErrors && !_.isEmpty(this.updateFields.company)){
                      this.updatedCompanyErrors['company'] = null;
                    }
                    if('name' in this.updatedCompanyErrors && !_.isEmpty(this.updateFields.name)){
                      this.updatedCompanyErrors['name'] = null;
                    }
                    if('surnames' in this.updatedCompanyErrors && !_.isEmpty(this.updateFields.surnames)){
                      this.updatedCompanyErrors['surnames'] = null;
                    }
                    if('address_line_1' in this.updatedCompanyErrors && !_.isEmpty(this.updateFields.address_line_1)){
                      this.updatedCompanyErrors['address_line_1'] = null;
                    }
                    if('city' in this.updatedCompanyErrors && !_.isEmpty(this.updateFields.city)){
                      this.updatedCompanyErrors['city'] = null;
                    }
                    if('country' in this.updatedCompanyErrors && !_.isEmpty(this.updateFields.country)){
                      this.updatedCompanyErrors['country'] = null;
                    }
                    if('zip_code' in this.updatedCompanyErrors && !_.isEmpty(this.updateFields.zip_code)){
                      this.updatedCompanyErrors['zip_code'] = null;
                    }
                }
            }
        },
        mounted() {
            this.getCompanies();
        }
    }
</script>
