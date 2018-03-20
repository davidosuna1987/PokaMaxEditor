<template>
  <section class="address-edit-form">
    <form>
      <div class="modal-card" style="width: auto">

          <div class="reciever_container modal-card-body">
            <article class="">
              <div class="reciever_form update-contact-form">
                  <div class="field field-reciever-company">
                      <input
                          type="text"
                          id="reciever_company"
                          name="reciever_company"
                          placeholder="Company"
                          v-model="updateData.company" />
                  </div>
                  <div class="field field-reciever-birthday">
                      <input
                          type="date"
                          id="reciever_birthday"
                          name="reciever_birthday"
                          placeholder="Birthday"
                          v-model="updateData.birthday" />
                  </div>
                  <div class="field field-reciever-title">
                      <input
                          type="text"
                          id="reciever_title"
                          name="reciever_title"
                          placeholder="Mr"
                          v-model="updateData.title" />
                  </div>
                  <div class="field field-reciever-name">
                      <input
                          type="text"
                          id="reciever_name"
                          name="reciever_name"
                          placeholder="Name *"
                          :class="[{'has-error' : updatedContactErrors['name']}]"
                          v-model="updateData.name" />
                          <span v-if="updatedContactErrors['name']" class="error has-text-danger is-size-7">
                              <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                              <span class="error-message">
                                  {{updatedContactErrors['name'][0]}}
                              </span>
                          </span>
                  </div>
                  <div class="field field-reciever-surnames">
                      <input
                          type="text"
                          id="reciever_surnames"
                          name="reciever_surnames"
                          placeholder="Surnames *"
                          :class="[{'has-error' : updatedContactErrors['surnames']}]"
                          v-model="updateData.surnames" />
                          <span v-if="updatedContactErrors['surnames']" class="error has-text-danger is-size-7">
                              <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                              <span class="error-message">
                                  {{updatedContactErrors['surnames'][0]}}
                              </span>
                          </span>
                  </div>
                  <div class="field field-reciever-address-line-1">
                      <input
                          type="text"
                          id="reciever_address_line_1"
                          name="reciever_address_line_1"
                          placeholder="Address line 1 *"
                          :class="[{'has-error' : updatedContactErrors['address_line_1']}]"
                          v-model="updateData.address_line_1" />
                          <span v-if="updatedContactErrors['address_line_1']" class="error has-text-danger is-size-7">
                              <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                              <span class="error-message">
                                  {{updatedContactErrors['address_line_1'][0]}}
                              </span>
                          </span>
                  </div>
                  <div class="field field-reciever-address-line-2">
                      <input
                          type="text"
                          id="reciever_address_line_2"
                          name="reciever_address_line_2"
                          placeholder="Address line 2"
                          v-model="updateData.address_line_2" />
                  </div>
                  <div class="field field-reciever-city">
                      <input
                          type="text"
                          id="reciever_city"
                          name="reciever_city"
                          placeholder="City *"
                          :class="[{'has-error' : updatedContactErrors['city']}]"
                          v-model="updateData.city" />
                          <span v-if="updatedContactErrors['city']" class="error has-text-danger is-size-7">
                              <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                              <span class="error-message">
                                  {{updatedContactErrors['city'][0]}}
                              </span>
                          </span>
                  </div>
                  <div class="field field-reciever-country">
                      <input
                          type="text"
                          id="reciever_country"
                          name="reciever_country"
                          placeholder="Country *"
                          :class="[{'has-error' : updatedContactErrors['country']}]"
                          v-model="updateData.country" />
                          <span v-if="updatedContactErrors['country']" class="error has-text-danger is-size-7">
                              <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                              <span class="error-message">
                                  {{updatedContactErrors['country'][0]}}
                              </span>
                          </span>
                  </div>
                  <div class="field field-reciever-zip">
                      <input
                          type="number"
                          id="reciever_zip_code"
                          name="reciever_zip_code"
                          placeholder="Zip *"
                          :class="[{'has-error' : updatedContactErrors['zip_code']}]"
                          v-model="updateData.zip_code" />
                          <span v-if="updatedContactErrors['zip_code']" class="error has-text-danger is-size-7">
                              <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                              <span class="error-message">
                                  {{updatedContactErrors['zip_code'][0]}}
                              </span>
                          </span>
                  </div>
              </div>
            </article>

          </div>

          <div class="modal-card-foot">
              <a class="button" @click.prevent="$parent.close()">Cancel</a>
              <button type="submit" class="button is-link" @click.prevent="updateContact">Update</button>
          </div>
      </div>
    </form>
  </section>
</template>

<script>
  export default {
    props: ['addressProps'],
    data() {
      return {
        address: {},
        updateData: {
          id: '',
          company: '',
          title: '',
          name: '',
          surnames: '',
          address_line_1: '',
          address_line_2: '',
          city: '',
          country: '',
          zip_code: '',
          birthday: ''
        },
        updatedContactErrors: []
      }
    },
    methods: {
        setUpdateData() {
          this.updatedContactErrors = [];
          this.updateData.id = this.address.id;
          this.updateData.company = this.address.company;
          this.updateData.title = this.address.title;
          this.updateData.name = this.address.name;
          this.updateData.surnames = this.address.surnames;
          this.updateData.address_line_1 = this.address.address_line_1;
          this.updateData.address_line_2 = this.address.address_line_2;
          this.updateData.city = this.address.city;
          this.updateData.country = this.address.country;
          this.updateData.zip_code = this.address.zip_code;
          this.updateData.birthday = this.address.birthday;

          $('.address-edit-form #reciever_company').focus();
        },
        updateContact() {
          axios.put('/api/address/'+this.updateData.id, this.updateData)
          .then(response => {
              this.$snackbar.open({
                  duration: 5000,
                  message: response.data.message,
                  queue: false,
                  onAction: () => {
                      //Do something on click button
                  }
              });
              this.$parent.$parent.getCompany();
              this.$parent.close();
          }).catch(error => {
              if(error.response.status && error.response.status === 419){
                  location.href = '/login';
              }
              console.info(error);
              this.updatedContactErrors = error.response.data.errors;
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
    },
    mounted() {
      this.address = this.addressProps;
      this.setUpdateData();
    }
  }
</script>
