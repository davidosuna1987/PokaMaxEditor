<template>
    <div class="steps" id="postcard_create_steps">
        <div class="step-item is-active">
          <div class="step-marker"
              data-nav-to="0"
              :class="[{ 'has-error': stepItemZeroHasErrors }]"
              @click.prevent="tempFill">
            <span class="icon">
              <i class="mdi mdi-24px mdi-domain"></i>
            </span>
          </div>
          <div class="step-details">
            <p class="step-title">Company</p>
          </div>
        </div>
        <div class="step-item">
          <div class="step-marker"
              data-nav-to="1"
              :class="[{ 'has-error': stepItemOneHasErrors, 'is-disabled': stepOneIsDisabled }]"
              @click.prevent="tempFill">
            <span class="icon">
              <i class="mdi mdi-24px mdi-cards"></i>
            </span>
          </div>
          <div class="step-details">
            <p class="step-title">Type</p>
          </div>
        </div>
        <div class="step-item">
          <div class="step-marker"
              data-nav-to="2"
              :class="[{ 'has-error': stepItemTwoHasErrors, 'is-disabled': stepTwoIsDisabled }]"
              @click.prevent="tempFill">
            <span class="icon">
              <i class="mdi mdi-24px mdi-image-filter-hdr"></i>
            </span>
          </div>
          <div class="step-details">
            <p class="step-title">Motive</p>
          </div>
        </div>
        <div class="step-item">
          <div class="step-marker"
              data-nav-to="3"
              :class="[{ 'has-error': stepItemThreeHasErrors, 'is-disabled': stepThreeIsDisabled }]"
              @click.prevent="tempFill">
            <span class="icon">
              <i class="mdi mdi-24px mdi-comment-text"></i>
            </span>
          </div>
          <div class="step-details">
            <p class="step-title">Text</p>
          </div>
        </div>
        <div class="step-item">
          <div class="step-marker"
              data-nav-to="4"
              :class="[{ 'has-error': stepItemFourHasErrors, 'is-disabled': stepFourIsDisabled }]"
              @click.prevent="tempFill">
            <span class="icon">
              <i class="mdi mdi-24px mdi-account"></i>
            </span>
          </div>
          <div class="step-details">
            <p class="step-title">Receiver</p>
          </div>
        </div>
        <div class="step-item">
          <div class="step-marker"
              data-nav-to="5"
              :class="[{ 'has-error': stepItemFiveHasErrors, 'is-disabled': stepFiveIsDisabled }]"
              @click.prevent="tempFill">
            <span class="icon">
              <i class="mdi mdi-24px mdi-eye"></i>
            </span>
          </div>
          <div class="step-details">
            <p class="step-title">Preview</p>
          </div>
        </div>

        <div class="steps-content">
          <div class="step-content is-active">
            <div class="columns m-t-15 p-l-20">
              <div class="column is-8">
                <div :data-id="tempData.company_id" class="reciever_container">
                    <div v-if="!isCreatingCompany && tempData.company_id == null && !companyIdProp" class="level p-20">
                      <p class="level-left">Please, select company or create new</p>
                      <p class="level-right">
                        <a href="#" class="button is-link" @click.prevent="createCompany">New company</a>
                      </p>
                    </div>
                    <form v-else class="reciever_form">
                        <template v-if="isCreatingCompany">
                            <div class="field field-reciever-email">
                                <input
                                    type="email"
                                    id="reciever_email"
                                    name="reciever_email"
                                    placeholder="Email *"
                                    :class="[{ 'has-error': senderEmailHasError }]"
                                    v-model="tempData.sender_data.email" />
                                    <span v-if="senderEmailHasError" class="error has-text-danger is-size-7">
                                        <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                        <span class="error-message">
                                            {{errors['sender_data.email'][0]}}
                                        </span>
                                    </span>
                            </div>
                            <div class="field field-reciever-password">
                                <input
                                    type="password"
                                    id="reciever_password"
                                    name="reciever_password"
                                    placeholder="Password *"
                                    :class="[{ 'has-error': senderPasswordHasError }]"
                                    v-model="tempData.sender_data.password" />
                                    <button class="button is-small is-link generate-password" @click.prevent="generateRandomPassword">Generate</button>
                                    <span v-if="senderPasswordHasError" class="error has-text-danger is-size-7">
                                        <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                        <span class="error-message">
                                            {{errors['sender_data.password'][0]}}
                                        </span>
                                    </span>
                            </div>
                        </template>
                        <div class="field field-reciever-company">
                            <input
                                type="text"
                                id="reciever_company"
                                name="reciever_company"
                                placeholder="Company *"
                                :class="[{ 'has-error': senderCompanyHasError }]"
                                v-model="tempData.sender_data.company" />
                                <span v-if="senderCompanyHasError" class="error has-text-danger is-size-7">
                                    <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                    <span class="error-message">
                                        {{errors['sender_data.company'][0]}}
                                    </span>
                                </span>
                        </div>
                        <div class="field field-reciever-birthday">
                            <input
                                type="date"
                                id="reciever_birthday"
                                name="reciever_birthday"
                                placeholder="Birthday"
                                v-model="tempData.sender_data.birthday" />
                        </div>
                        <div class="field field-reciever-title">
                            <input
                                type="text"
                                id="reciever_title"
                                name="reciever_title"
                                placeholder="Title"
                                v-model="tempData.sender_data.title" />
                        </div>
                        <div class="field field-reciever-name">
                            <input
                                type="text"
                                id="reciever_name"
                                name="reciever_name"
                                placeholder="Name *"
                                :class="[{ 'has-error': senderNameHasError }]"
                                v-model="tempData.sender_data.name" />
                                <span v-if="senderNameHasError" class="error has-text-danger is-size-7">
                                    <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                    <span class="error-message">
                                        {{errors['sender_data.name'][0]}}
                                    </span>
                                </span>
                        </div>
                        <div class="field field-reciever-surnames">
                            <input
                                type="text"
                                id="reciever_surnames"
                                name="reciever_surnames"
                                placeholder="Surnames *"
                                :class="[{ 'has-error': senderSurnamesHasError }]"
                                v-model="tempData.sender_data.surnames" />
                                <span v-if="senderSurnamesHasError" class="error has-text-danger is-size-7">
                                    <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                    <span class="error-message">
                                        {{errors['sender_data.surnames'][0]}}
                                    </span>
                                </span>
                        </div>
                        <div class="field field-reciever-address-line-1">
                            <input
                                type="text"
                                id="reciever_address_line_1"
                                name="reciever_address_line_1"
                                placeholder="Address line 1 *"
                                :class="[{ 'has-error': senderAddressHasError }]"
                                v-model="tempData.sender_data.address_line_1" />
                                <span v-if="senderAddressHasError" class="error has-text-danger is-size-7">
                                    <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                    <span class="error-message">
                                        {{errors['sender_data.address_line_1'][0]}}
                                    </span>
                                </span>
                        </div>
                        <div class="field field-reciever-address-line-2">
                            <input
                                type="text"
                                id="reciever_address_line_2"
                                name="reciever_address_line_2"
                                placeholder="Address line 2"
                                v-model="tempData.sender_data.address_line_2" />
                        </div>
                        <div class="field field-reciever-city">
                            <input
                                type="text"
                                id="reciever_city"
                                name="reciever_city"
                                placeholder="City *"
                                :class="[{ 'has-error': senderCityHasError }]"
                                v-model="tempData.sender_data.city" />
                                <span v-if="senderCityHasError" class="error has-text-danger is-size-7">
                                    <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                    <span class="error-message">
                                        {{errors['sender_data.city'][0]}}
                                    </span>
                                </span>
                        </div>
                        <div class="field field-reciever-country">
                            <input
                                type="text"
                                id="reciever_country"
                                name="reciever_country"
                                placeholder="Country *"
                                :class="[{ 'has-error': senderCountryHasError }]"
                                v-model="tempData.sender_data.country" />
                                <span v-if="senderCountryHasError" class="error has-text-danger is-size-7">
                                    <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                    <span class="error-message">
                                        {{errors['sender_data.country'][0]}}
                                    </span>
                                </span>
                        </div>
                        <div class="field field-reciever-zip">
                            <input
                                type="number"
                                id="reciever_zip_code"
                                name="reciever_zip_code"
                                placeholder="Zip *"
                                :class="[{ 'has-error': senderZipHasError }]"
                                v-model="tempData.sender_data.zip_code" />
                                <span v-if="senderZipHasError" class="error has-text-danger is-size-7">
                                    <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                    <span class="error-message">
                                        {{errors['sender_data.zip_code'][0]}}
                                    </span>
                                </span>
                        </div>

                        <template v-if="!companyIdProp">
                            <small v-if="this.tempData.company_id" class="has-text-link is-8 m-t-15"><strong class="has-text-link">Info:</strong> you can change sender data without updating the company.</small>
                            <div class="field has-text-right m-t-30">
                                <button
                                  v-if="tempData.company_id === null"
                                  class="button"
                                  @click.prevent="cancelCreateCompany">
                                    Cancel
                                </button>
                                <button
                                  class="button"
                                  :class="[{'is-info' : tempData.company_id === null, 'is-link' : tempData.company_id !== null}]"
                                  @click.prevent="storeCompany">
                                    {{tempData.company_id === null ? 'Create company' : 'New company'}}
                                </button>
                                <button
                                  v-if="tempData.company_id !== null"
                                  class="button is-info"
                                  @click.prevent="updateCompany(tempData.company_id)">
                                    Update company
                                </button>
                            </div>
                        </template>
                    </form>
                </div>
              </div>
              <div class="column">
                  <b-field class="is-info">
                    <b-select
                        v-show="!companyIdProp"
                        v-model="tempData.company_id"
                        @input="changeCompany(tempData.company_id)"
                        placeholder="Select company"
                        icon="domain">
                        <option v-if="tempData.company_id !== null" value="0">New company</option>
                        <option
                            v-for="(company, index) in companies"
                            v-if="company.address.company !== null && company.address.company !== ''"
                            :value="company.id"
                            :key="company.id">
                            {{ company.address.company }}
                        </option>
                    </b-select>
                  </b-field>
              </div>
            </div>
          </div>
          <div class="step-content">
            <div class="columns is-centered">
              <!-- <div class="column is-one-fifth">
                <a href="#" class="button is-info is-block" data-nav="next"
                    @click.prevent="tempData.product_name = 'standard'">Standard</a>
              </div>
              <div class="column is-one-fifth">
                <a href="#" class="button is-info is-block" data-nav="next"
                    @click.prevent="tempData.product_name = 'horizontal'">Horizontal</a>
              </div>
              <div class="column is-one-fifth">
                <a href="#" class="button is-info is-block" data-nav="next"
                    @click.prevent="tempData.product_name = 'vertical'">Vertical</a>
              </div> -->
              <div class="column is-one-fifth">
                <a href="#" class="button is-info is-block" data-nav="next"
                    @click.prevent="tempData.is_set = false">Single postcard</a>
              </div>
              <div class="column is-one-fifth">
                <a href="#" class="button is-info is-block" data-nav="next"
                    @click.prevent="tempData.is_set = true">Set of postcards</a>
              </div>
            </div>
          </div>
          <div class="step-content">
            <div class="columns">
              <div class="column is-8">
                <form method="post" class="postcard_form" enctype="multipart/form-data" :class="tempData.has_frame ? 'has-frame' : ''">
                  <div class="col-1">
                    <div id="collage_1" class="collage-item">
                      <input type="file" name="file1" class="upload-file-input" accept="image/jpg, image/jpeg, image/png" />
                      <input type="hidden" name="cropped_file" id="file1cropped">
                      <input type="hidden" name="original_file" id="file1original">
                      <div class="upload-icon-wrapper">
                        <i class="mdi mdi-plus-circle"></i>
                      </div>
                      <div class="tools hidden">
                        <div class="tool tool-remove">
                          <i class="mdi mdi-delete"></i>
                          <i class="mdi mdi-delete-empty"></i>
                        </div>
                        <div class="tool tool-expand">
                          <i class="mdi mdi-arrow-expand-all"></i>
                        </div>
                        <div class="tool tool-rotate tool-rotate-left" data-deg="-90">
                          <i class="mdi mdi-rotate-left"></i>
                        </div>
                        <div class="tool tool-rotate tool-rotate-right" data-deg="90">
                          <i class="mdi mdi-rotate-right"></i>
                        </div>
                        <div class="tool tool-done">
                          <i class="mdi mdi-check"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="front-caption-text">
                    <input type="text" maxlength="45" placeholder="Some text (optional)">
                  </div>
                  <!-- <button id="submit-form" type="submit">enviar</button> -->
                </form>
              </div>
              <div class="column m-t-50">
                <!-- <div class="field">
                  <b-switch v-model="tempData.has_frame"
                  type="is-info">
                      Show frame and front text
                  </b-switch>
                </div> -->
              </div>
            </div>
          </div>
          <div class="step-content">
            <div class="columns">
              <div class="column is-8">
                <form method="post" class="postcard_form">

                  <div class="col-1">
                    <div id="postcard_back" class="postcard-back" :class="[{'full-text' : !tempData.show_back_reciever}]">
                      <div id="back_text_field" class="field">
                          <img class="company-logo-img is-hidden" alt="Company logo">
                          <textarea
                              v-model="tempData.back_text"
                              :style="{color: tempData.font_data.color.hex}"
                              :class="[{ 'has-error': backTextHasError }, 'font-family-'+tempData.font_data.font_family+' font-size-'+tempData.font_data.font_size]"
                              name="back_text"
                              id="back_text"
                              maxlength="420"
                              placeholder="Click here to write your text ...">
                          </textarea>
                          <span v-if="backTextHasError" class="back-text-error-frame">
                            <span class="error has-text-danger is-size-7">
                                <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                <span class="error-message">
                                    {{errors['back_text'][0]}}
                                </span>
                            </span>
                          </span>
                      </div>
                      <span class="vertical-line"></span>
                      <div class="right-area">
                        <!-- <figure class="stamp-container">
                          <img class="stamp" src="images/stamp.jpg" alt="Stamp" width="100">
                        </figure> -->
                        <div id="sender_data">
                            <div class="field">
                                <input disabled />
                            </div>
                            <div class="field">
                                <input disabled />
                            </div>
                            <div class="field">
                                <input disabled />
                            </div>
                            <div class="field">
                                <input disabled />
                            </div>
                            <div class="field">
                                <input disabled />
                            </div>
                            <div class="field">
                                <input disabled />
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="column m-t-15">
                <div class="field">
                  <b-switch v-model="tempData.show_back_reciever"
                  type="is-info">
                      Show reciever address
                  </b-switch>
                </div>
                <div class="font-selector">
                  <div class="font-family">
                    <p class="title is-5">
                      Select font
                      <i class="mdi mdi-chevron-down mdi-24px"></i>
                    </p>
                    <ul class="font-family-list" @click="changeFontFamily">
                        <li
                            class="font-family-1"
                            data-fontid="1"
                            :class="tempData.font_data.font_family == 1 ? 'active' : ''">
                          Pacifico
                        </li>
                        <li
                            class="font-family-2"
                            data-fontid="2"
                            :class="tempData.font_data.font_family == 2 ? 'active' : ''">
                          Indie Flower
                        </li>
                        <li
                            class="font-family-3"
                            data-fontid="3"
                            :class="tempData.font_data.font_family == 3 ? 'active' : ''">
                          Nanum Pen Script
                        </li>
                        <li
                            class="font-family-4"
                            data-fontid="4"
                            :class="tempData.font_data.font_family == 4 ? 'active' : ''">
                          Gloria Hallelujah
                        </li>
                    </ul>
                  </div>
                  <div class="font-size m-b-25">
                    <p class="title is-5">Select font size</p>
                    <ul class="font-size-list" @click="changeFontSize">
                        <li
                            data-fontsize="15"
                            :class="tempData.font_data.font_size == 15 ? 'active' : ''">
                          XS
                        </li>
                        <li
                            data-fontsize="18"
                            :class="tempData.font_data.font_size == 18 ? 'active' : ''">
                          S
                        </li>
                        <li
                            data-fontsize="21"
                            :class="tempData.font_data.font_size == 21 ? 'active' : ''">
                          M
                        </li>
                        <li
                            data-fontsize="24"
                            :class="tempData.font_data.font_size == 24 ? 'active' : ''">
                          L
                        </li>
                    </ul>
                  </div>
                  <div class="font-color">
                    <p class="title is-5">Select text color</p>
                    <template v-if="showCustomColor">
                      <input v-model="tempData.font_data.color.hex" type="text" class="input">
                      <button class="button is-small is-info m-t-10" @click.prevent="showCustomColor = false">Show color picker</button>
                    </template>
                    <template v-else>
                      <slider-picker v-model="tempData.font_data.color"></slider-picker>
                      <button class="button is-small is-info m-t-10" @click.prevent="showCustomColor = true">Set custom color</button>
                    </template>
                  </div>
                </div>
                <div class="upload-logo m-t-20 m-b-20">
                  <p class="title is-5 m-b-10">Company logo</p>
                  <template v-if="!isSetCompanyLogo" class="fake-upload-logo-field">
                    <input class="is-hidden" id="upload_logo_input" type="file" @change="setCompanyLogo($event)">

                    <a class="button is-info" @click.prevent="selectCompanyLogo()">
                        <b-icon pack="fa" icon="upload"></b-icon>
                        <span>Upload company logo</span>
                    </a>
                  </template>

                  <template v-else>
                    <div class="company-logo-position m-b-10">
                      <b-field class="m-t-10">
                          <b-select
                            v-model="tempData.company_logo.position"
                            @input="setCompanyLogoClass($event)"
                            placeholder="Logo position" icon="grid">
                              <option value="bottom-right">Bottom right</option>
                              <option value="bottom-center">Bottom center</option>
                              <option value="bottom-left">Bottom left</option>
                              <option value="center-right">Center right</option>
                              <option value="center-center">Center center</option>
                              <option value="center-left">Center left</option>
                              <option value="top-right">Top right</option>
                              <option value="top-center">Top center</option>
                              <option value="top-left">Top left</option>
                          </b-select>
                      </b-field>
                    </div>
                    <span class="tag is-info">
                      {{ tempData.company_logo.name }}
                      <button class="delete is-small" @click.prevent="clearCompanyLogo()"></button>
                    </span>
                  </template>
                </div>
              </div>
            </div>
          </div>
          <div class="step-content">
            <div class="columns m-t-15 p-l-20">
              <div class="column is-8">
                <div class="reciever_container">
                    <div class="card">
                        <div class="card-content">
                            <div class="reciever_addresses">
                              <template v-if="tempData.company_id">
                                <div class="level">
                                  <div class="level-left">
                                    <p class="title is-5">Select contacts or import more</p>
                                  </div>
                                  <div class="level-right">
                                    <button class="button is-link is-small m-r-5" @click.prevent="isCreatingAddressList = true">New address list</button>
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
                                           class="card-header-icon has-text-success is-pulled-right p-0 m-r-5 m-l-5"
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

                                <template v-else>
                                  <div v-if="tempData.company_id && companies[tempData.company_id].address_lists.length">
                                    <p class="is-size-6 has-text-link">Birthday filters</p>
                                    <div class="field">
                                      <p class="control">
                                        <span class="select">
                                          <select v-model="birthdayFilters.month">
                                            <option value="">By month</option>
                                            <option value="0">January</option>
                                            <option value="1">February</option>
                                            <option value="2">March</option>
                                            <option value="3">April</option>
                                            <option value="4">May</option>
                                            <option value="5">June</option>
                                            <option value="6">July</option>
                                            <option value="7">August</option>
                                            <option value="8">September</option>
                                            <option value="9">October</option>
                                            <option value="10">November</option>
                                            <option value="11">Dicember</option>
                                          </select>
                                        </span>
                                      </p>
                                    </div>
                                  </div>
                                </template>

                                <div v-for="(address_list, index) in companies[tempData.company_id].address_lists" :key="index">
                                  <b-collapse v-if="address_list.addresses" class="card" :open="index === 0 ? true : false">
                                      <div slot="trigger" slot-scope="props" class="card-header">
                                          <p class="card-header-title">{{address_list.name}} <span class="has-text-weight-light m-l-10"><small>({{address_list.addresses.length}})</small></span></p>
                                          <a class="card-header-icon">
                                              <b-icon
                                                  :icon="props.open ? 'menu-down' : 'menu-up'">
                                              </b-icon>
                                          </a>
                                      </div>
                                      <div class="card-content">
                                        <div v-if="isImportingContacts === index">
                                          <form id="uplaod_form" class="import-contacts-form" enctype="multipart/form-data">
                                            <p class="title is-size-6">
                                              Importing contacts
                                              <button class="button is-small is-pulled-right" @click.prevent="restoreImportContacts">Cancel</button>
                                              <button v-if="csv_addresses && csv_addresses.length" class="button is-info is-small m-r-5 is-pulled-right" :disabled="!checked_csv_addresses.length" @click.prevent="addContactsToAddressList(index)">
                                                <b-icon pack="fa" icon="address-book-o"></b-icon>
                                                <span>Add {{checked_csv_addresses.length}} {{checked_csv_addresses.length == 1 ? 'contact' : 'contacts'}}</span>
                                              </button>
                                            </p>
                                            <b-field>
                                                <b-upload v-model="csv_file" @input="uploadCsvFile">
                                                    <a class="button is-info">
                                                        <b-icon pack="fa" icon="file-excel-o"></b-icon>
                                                        <span>Click to select file</span>
                                                    </a>
                                                </b-upload>
                                                <div v-if="csv_file && csv_file.length">
                                                    <span class="file-name">
                                                        {{ csv_file[0].name }}
                                                    </span>
                                                </div>
                                            </b-field>
                                            <div v-if="csv_addresses" class="csv-addresses">

                                              <div class="field m-t-30">
                                                <b-switch v-model="isPaginated" size="is-small" type="is-info">Paginated</b-switch>
                                              </div>

                                              <b-table
                                                  class="m-t-30"
                                                  narrowed
                                                  hoverable
                                                  striped
                                                  :data="csv_addresses"
                                                  :paginated="isPaginated"
                                                  per-page="20"
                                                  pagination-size="is-small"
                                                  :checked-rows.sync="checked_csv_addresses"
                                                  default-sort-direction="asc"
                                                  default-sort="name"
                                                  checkable
                                                  detailed>

                                                  <template slot-scope="props">
                                                      <b-table-column field="name" label="Name" sortable>
                                                           {{ props.row.name }}
                                                      </b-table-column>

                                                      <b-table-column field="surnames" label="Surnames" sortable>
                                                          {{ props.row.surnames }}
                                                      </b-table-column>

                                                      <b-table-column field="birthday" label="Birthday" sortable>
                                                          {{ props.row.birthday }}
                                                      </b-table-column>
                                                  </template>

                                                  <template slot="detail" slot-scope="props">
                                                      <article class="contact-details">
                                                          <form class="reciever_form">
                                                            <div class="field field-reciever-company">
                                                                <input
                                                                    type="text"
                                                                    id="reciever_company"
                                                                    name="reciever_company"
                                                                    placeholder="Company"
                                                                    v-model="props.row.company" />
                                                            </div>
                                                            <div class="field field-reciever-birthday">
                                                                <input
                                                                    type="date"
                                                                    id="reciever_birthday"
                                                                    name="reciever_birthday"
                                                                    placeholder="Birthday"
                                                                    v-model="props.row.birthday" />
                                                            </div>
                                                            <div class="field field-reciever-title">
                                                                <input
                                                                    type="text"
                                                                    id="reciever_title"
                                                                    name="reciever_title"
                                                                    placeholder="Mr"
                                                                    v-model="props.row.title" />
                                                            </div>
                                                            <div class="field field-reciever-name">
                                                                <input
                                                                    type="text"
                                                                    id="reciever_name"
                                                                    name="reciever_name"
                                                                    placeholder="Name *"
                                                                    v-model="props.row.name" />
                                                            </div>
                                                            <div class="field field-reciever-surnames">
                                                                <input
                                                                    type="text"
                                                                    id="reciever_surnames"
                                                                    name="reciever_surnames"
                                                                    placeholder="Surnames *"
                                                                    v-model="props.row.surnames" />
                                                            </div>
                                                            <div class="field field-reciever-address-line-1">
                                                                <input
                                                                    type="text"
                                                                    id="reciever_address_line_1"
                                                                    name="reciever_address_line_1"
                                                                    placeholder="Address line 1 *"
                                                                    v-model="props.row.address_line_1" />
                                                            </div>
                                                            <div class="field field-reciever-address-line-2">
                                                                <input
                                                                    type="text"
                                                                    id="reciever_address_line_2"
                                                                    name="reciever_address_line_2"
                                                                    placeholder="Address line 2"
                                                                    v-model="props.row.address_line_2" />
                                                            </div>
                                                            <div class="field field-reciever-city">
                                                                <input
                                                                    type="text"
                                                                    id="reciever_city"
                                                                    name="reciever_city"
                                                                    placeholder="City *"
                                                                    v-model="props.row.city" />
                                                            </div>
                                                            <div class="field field-reciever-country">
                                                                <input
                                                                    type="text"
                                                                    id="reciever_country"
                                                                    name="reciever_country"
                                                                    placeholder="Country *"
                                                                    v-model="props.row.country" />
                                                            </div>
                                                            <div class="field field-reciever-zip">
                                                                <input
                                                                    type="number"
                                                                    id="reciever_zip_code"
                                                                    name="reciever_zip_code"
                                                                    placeholder="Zip *"
                                                                    v-model="props.row.zip_code" />
                                                            </div>
                                                        </form>
                                                      </article>
                                                  </template>

                                                  <template slot="empty">
                                                      <section class="section">
                                                          <div class="content has-text-grey has-text-centered">
                                                              <p>
                                                                  <b-icon
                                                                      icon="emoticon-sad"
                                                                      size="is-large">
                                                                  </b-icon>
                                                              </p>
                                                              <p>No results found... Please upload a valid file.</p>
                                                          </div>
                                                      </section>
                                                  </template>

                                                  <template v-if="csv_addresses && csv_addresses.length" slot="bottom-left">
                                                      <small><b>Total checked</b>: {{checked_csv_addresses.length}}</small>
                                                  </template>
                                              </b-table>
                                            </div>
                                            <div class="add-contacts-to-list" v-if="csv_addresses && csv_addresses.length">
                                              <small class="has-text-link is-8"><strong class="has-text-link">Info:</strong> to select this contacts, first you must to add them into {{address_list.name}} address list.</small>
                                              <div class="level m-t-10">
                                                <div class="level-left"></div>
                                                <div class="level-right">
                                                  <button class="button is-info is-small" :disabled="!checked_csv_addresses.length" @click.prevent="addContactsToAddressList(index)">
                                                    <b-icon pack="fa" icon="address-book-o"></b-icon>
                                                    <span>Add {{checked_csv_addresses.length}} {{checked_csv_addresses.length == 1 ? 'contact' : 'contacts'}}</span>
                                                  </button>
                                                </div>
                                              </div>
                                            </div>
                                          </form>
                                        </div>
                                        <div v-else>
                                          <template v-if="address_list.addresses.length">
                                              <p class="title is-size-6">
                                              Select contacts
                                                <button class="button is-info is-small is-pulled-right" @click.prevent="setImportContactsToAddressList(index)">Import contacts</button>
                                              </p>

                                              <div class="field m-t-30">
                                                <b-switch v-model="isPaginated" size="is-small" type="is-info">Paginated</b-switch>
                                              </div>

                                              <b-table
                                                  hoverable
                                                  striped
                                                  checkable
                                                  :data="address_list.addresses"
                                                  :paginated="isPaginated"
                                                  per-page="20"
                                                  pagination-size="is-small"
                                                  :checked-rows.sync="tempData.reciever_data"
                                                  default-sort-direction="asc"
                                                  default-sort="name">

                                                  <template slot-scope="props">
                                                    <b-table-column field="name" label="Name" sortable>
                                                        {{ props.row.name }}
                                                    </b-table-column>
                                                    <b-table-column field="surnames" label="Surnames" sortable>
                                                        {{ props.row.surnames }}
                                                    </b-table-column>

                                                      <b-table-column field="birthday" label="Birthday" sortable>
                                                          {{ props.row.birthday }}
                                                      </b-table-column>
                                                  </template>
                                              </b-table>
                                          </template>

                                          <template v-else>
                                              <p>
                                                  No contacts added yet
                                                  <button class="button is-info is-small is-pulled-right" @click.prevent="setImportContactsToAddressList(index)">Import contacts</button>
                                              </p>
                                          </template>
                                        </div>
                                      </div>
                                  </b-collapse>
                                </div>
                              </template>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <div class="column">
                <button class="button is-info w-200" data-nav="next" :disabled="!tempData.reciever_data.length">Preview and send!</button>
              </div>
            </div>
          </div>
          <div class="step-content">
            <div id="preview">
                <div class="columns">
                  <div class="column is-8">
                    <div id="preview-postcard" :class="[{'flipped' : postcard_flipped}]">
                      <div class="preview-front">
                        <div class="postcard_form" :class="tempData.has_frame ? 'has-frame' : ''">
                          <img src="" alt="" class="postcard-preview-image">
                          <div class="front-caption-text">
                            <input type="text" maxlength="45" placeholder="Some text (optional)">
                          </div>
                          <!-- <button id="submit-form" type="submit">enviar</button> -->
                        </div>
                      </div>
                      <div class="preview-back">
                        <div class="postcard_form">

                          <div class="col-1">
                            <div id="postcard_back" class="postcard-back" :class="[{'full-text' : !tempData.show_back_reciever}]">
                              <div id="back_text_field" class="field">
                                  <img class="company-logo-img is-hidden" alt="Company logo">
                                  <textarea
                                      disabled
                                      v-model="tempData.back_text"
                                      :style="{color: tempData.font_data.color.hex}"
                                      :class="[{ 'has-error': backTextHasError }, 'font-family-'+tempData.font_data.font_family+' font-size-'+tempData.font_data.font_size]"
                                      name="back_text"
                                      id="back_text">
                                  </textarea>
                                  <span v-if="backTextHasError" class="back-text-error-frame">
                                    <span class="error has-text-danger is-size-7">
                                        <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                        <span class="error-message">
                                            {{errors['back_text'][0]}}
                                        </span>
                                    </span>
                                  </span>
                              </div>
                              <span class="vertical-line"></span>
                              <div class="right-area">
                                <!-- <figure class="stamp-container">
                                  <img class="stamp" src="images/stamp.jpg" alt="Stamp" width="100">
                                </figure> -->
                                <div id="sender_data" v-if="previewRecieverData">
                                    <div class="field">
                                        <input
                                            disabled
                                            :value="previewRecieverData.name+' '+previewRecieverData.surnames"
                                            :class="[{ 'has-error': senderNameHasError }]"
                                            placeholder="Sender name *"
                                            name="sender_name"
                                            type="text">
                                        <span v-if="senderNameHasError" class="error has-text-danger is-size-7">
                                            <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                            <span class="error-message">
                                                {{errors['reciever_data[0].name'][0]}}
                                            </span>
                                        </span>
                                    </div>
                                    <div class="field">
                                        <input
                                            disabled
                                            :value="previewRecieverData.address_line_1"
                                            :class="[{ 'has-error': senderAddressHasError }]"
                                            placeholder="Address line 1 *"
                                            name="sender_address_line_1"
                                            type="text">
                                        <span v-if="senderAddressHasError" class="error has-text-danger is-size-7">
                                            <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                            <span class="error-message">
                                                {{errors['reciever_data[0].address_line_1'][0]}}
                                            </span>
                                        </span>
                                    </div>
                                    <div class="field" v-show="previewRecieverData.address_line_2">
                                        <input
                                          disabled
                                          :value="previewRecieverData.address_line_2"
                                          placeholder="Address line 2"
                                          name="sender_address_line_2"
                                          type="text">
                                    </div>
                                    <div class="field">
                                        <input
                                          disabled
                                          :value="previewRecieverData.zip_code"
                                          :class="[{ 'has-error': senderZipHasError }]"
                                          placeholder="Zip code *"
                                          name="sender_zip_code"
                                          type="number">
                                        <span v-if="senderZipHasError" class="error has-text-danger is-size-7">
                                            <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                            <span class="error-message">
                                                {{errors['reciever_data[0].zip_code'][0]}}
                                            </span>
                                        </span>
                                    </div>
                                    <div class="field">
                                        <input
                                          disabled
                                          :value="previewRecieverData.city"
                                          :class="[{ 'has-error': senderCityHasError }]"
                                          placeholder="City *"
                                          name="sender_city"
                                          type="text">
                                        <span v-if="senderCityHasError" class="error has-text-danger is-size-7">
                                            <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                            <span class="error-message">
                                                {{errors['reciever_data[0].city'][0]}}
                                            </span>
                                        </span>
                                    </div>
                                    <div class="field">
                                        <input
                                          disabled
                                          :value="previewRecieverData.country"
                                          :class="[{ 'has-error': senderCountryHasError }]"
                                          placeholder="Country *"
                                          name="sender_country"
                                          type="text">
                                        <span v-if="senderCountryHasError" class="error has-text-danger is-size-7">
                                            <i class="mdi mdi-alert-circle-outline mdi-18px"></i>
                                            <span class="error-message">
                                                {{errors['reciever_data[0].country'][0]}}
                                            </span>
                                        </span>
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="column m-t-30">
                    <button class="button is-info p-l-35 p-r-35" @click="flipPostcard">Rotate postcard</button>
                    <b-collapse v-if="previewRecieverData && tempData.show_back_reciever" class="card m-t-10" :open="false">
                      <div slot="trigger" slot-scope="props" class="card-header">
                          <p class="card-header-title">Preview with other reciever</p>
                          <a class="card-header-icon">
                              <b-icon
                                  :icon="props.open ? 'menu-down' : 'menu-up'">
                              </b-icon>
                          </a>
                      </div>
                      <div class="card-content">
                              <div class="field m-t-30">
                                <b-switch v-model="isPaginated" size="is-small" type="is-info">Paginated</b-switch>
                              </div>

                              <b-table
                                  hoverable
                                  striped
                                  narrowed
                                  :paginated="isPaginated"
                                  per-page="10"
                                  pagination-size="is-small"
                                  :selected.sync="previewRecieverData"
                                  :data="tempData.reciever_data"
                                  default-sort-direction="asc"
                                  default-sort="name">

                                  <template slot-scope="props">
                                    <b-table-column field="name" label="Name" sortable>
                                        {{ props.row.name }}
                                    </b-table-column>
                                    <b-table-column field="surnames" label="Surnames" sortable>
                                        {{ props.row.surnames }}
                                    </b-table-column>
                                  </template>
                              </b-table>
                      </div>
                    </b-collapse>
                  </div>
                </div>
            </div>
          </div>
        </div>

        <div class="steps-actions">
          <div class="steps-action">
            <a
                @click.prevent="tempFill"
                href="#"
                data-nav="previous"
                class="step-nav button is-light">Previous
            </a>
          </div>
          <div class="steps-action">
            <a
                @click.prevent="tempFill"
                href="#"
                data-nav="next"
                class="step-nav button is-light">Next
            </a>
          </div>
        </div>

        <a href="#" class="button is-info button-save-draft" @click.prevent="saveDraft" :disabled="stepThreeIsDisabled">Save as draft</a>
    </div>
</template>

<script>
    export default {
        props: ['companyIdProp'],
        data() {
            return {
                isSetCompanyLogo: false,
                birthdayFilters: {
                  month: '',
                },
                isPaginated: true,
                csv_file: null,
                csv_addresses: null,
                checked_csv_addresses: [],
                isImportingContacts: false,
                isCreatingAddressList: false,
                newAddressListErrors: null,
                newAddressList: {
                    name: null,
                    company_id: null
                },
                previewRecieverData: null,
                companies: null,
                selected_company_contacts: [],
                selected_company_address_lists: [],
                isModalAddressListsActive: false,
                isCreatingAddressList: false,
                isCreatingCompany: false,
                newListName: '',
                selected_address_list: null,
                postcard_flipped: false,
                steps_actions_next_button_disabled: true,
                empty_file_cropped: _.isEmpty($('#file1cropped').val()),
                empty_file_original: _.isEmpty($('#file1cropped').val()),
                errors: {},
                errorsAddressList: {},
                showCustomColor: false,
                tempData: {
                  postcard_id: null,
                  company_id: null,
                  company_logo: {
                    is_set: false,
                    name: '',
                    size: '',
                    width: 125,
                    image: '',
                    position: 'bottom-right'
                  },
                  is_set: null,
                  has_frame: false,
                  product_name: 'standard',
                  cropped_file: null,
                  original_file: null,
                  front_cropped_file_path: null,
                  front_original_file_path: null,
                  back_text: '',
                  show_back_reciever: true,
                  font_data: {
                    font_family: 1,
                    font_size: 21,
                    color: {
                      hex: '#031993'
                    }
                  },
                  sender_data: {
                    is_new: false,
                    email: '',
                    password: '',
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
                  reciever_data: []
                }
            }
        },
        watch: {
          tempData: {
            handler(val){
              this.removeErrors();
              this.tempFill();
            },
            deep: true
          },
          newListName: {
            handler(val){
              this.removeErrors();
              this.tempFill();
            },
            deep: true
          },
          newAddressList: {
              handler(val){
                  this.removeErrors();
              },
              deep: true
          },
          computedPreviewRecieverData() {
              this.previewRecieverData = this.computedPreviewRecieverData;
          }
        },
        computed: {
            computedPreviewRecieverData() {
              return this.tempData.reciever_data[0];
            },
            newAddressListHasError() {
              return this.newAddressListErrors != null && !_.isEmpty(this.newAddressListErrors) && !_.isEmpty(this.newAddressListErrors['name']);
            },
            stepOneIsDisabled() {
              return this.tempData.company_id === null || _.isEmpty(this.tempData.sender_data.company) || _.isEmpty(this.tempData.sender_data.name) || _.isEmpty(this.tempData.sender_data.address_line_1) || _.isEmpty(this.tempData.sender_data.city) || _.isEmpty(this.tempData.sender_data.country) || _.isEmpty(this.tempData.sender_data.zip_code);
            },
            stepTwoIsDisabled() {
              // return _.isEmpty(this.tempData.product_name);
              return this.stepOneIsDisabled || this.tempData.is_set === null;
            },
            stepThreeIsDisabled() {
              return this.stepTwoIsDisabled || this.empty_file_cropped || this.empty_file_original;
            },
            stepFourIsDisabled() {
              return this.stepTwoIsDisabled || this.stepThreeIsDisabled || _.isEmpty(this.tempData.back_text) || _.isEmpty(this.tempData.sender_data.company) || _.isEmpty(this.tempData.sender_data.name) || _.isEmpty(this.tempData.sender_data.address_line_1) || _.isEmpty(this.tempData.sender_data.city) || _.isEmpty(this.tempData.sender_data.country) || _.isEmpty(this.tempData.sender_data.zip_code);
            },
            stepFiveIsDisabled() {
              return this.stepTwoIsDisabled || this.stepThreeIsDisabled || this.stepFourIsDisabled || _.isEmpty(this.tempData.reciever_data);
            },
            backTextHasError() {
              return this.errors != null && !_.isEmpty(this.errors) && !_.isEmpty(this.errors.back_text);
            },
            senderEmailHasError() {
              return this.errors != null && !_.isEmpty(this.errors) && !_.isEmpty(this.errors['sender_data.email']);
            },
            senderPasswordHasError() {
              return this.errors != null && !_.isEmpty(this.errors) && !_.isEmpty(this.errors['sender_data.password']);
            },
            senderCompanyHasError() {
              return this.errors != null && !_.isEmpty(this.errors) && !_.isEmpty(this.errors['sender_data.company']);
            },
            senderNameHasError() {
              return this.errors != null && !_.isEmpty(this.errors) && !_.isEmpty(this.errors['sender_data.name']);
            },
            senderSurnamesHasError() {
              return this.errors != null && !_.isEmpty(this.errors) && !_.isEmpty(this.errors['sender_data.surnames']);
            },
            senderAddressHasError() {
              return this.errors != null && !_.isEmpty(this.errors) && !_.isEmpty(this.errors['sender_data.address_line_1']);
            },
            senderCityHasError() {
              return this.errors != null && !_.isEmpty(this.errors) && !_.isEmpty(this.errors['sender_data.city']);
            },
            senderCountryHasError() {
              return this.errors != null && !_.isEmpty(this.errors) && !_.isEmpty(this.errors['sender_data.country']);
            },
            senderZipHasError() {
              return this.errors != null && !_.isEmpty(this.errors) && !_.isEmpty(this.errors['sender_data.zip_code']);
            },
            recieverNameHasError() {
              return this.errors != null && !_.isEmpty(this.errors) && !_.isEmpty(this.errors['reciever_data.name']);
            },
            recieverSurnamesHasError() {
              return this.errors != null && !_.isEmpty(this.errors) && !_.isEmpty(this.errors['reciever_data.surnames']);
            },
            recieverAddressHasError() {
              return this.errors != null && !_.isEmpty(this.errors) && !_.isEmpty(this.errors['reciever_data.address_line_1']);
            },
            recieverCityHasError() {
              return this.errors != null && !_.isEmpty(this.errors) && !_.isEmpty(this.errors['reciever_data.city']);
            },
            recieverCountryHasError() {
              return this.errors != null && !_.isEmpty(this.errors) && !_.isEmpty(this.errors['reciever_data.country']);
            },
            recieverZipHasError() {
              return this.errors != null && !_.isEmpty(this.errors) && !_.isEmpty(this.errors['reciever_data.zip_code']);
            },
            stepItemZeroHasErrors() {
              return this.errors != null && !_.isEmpty(this.errors) && (!_.isEmpty(this.errors['sender_data.company']) || !_.isEmpty(this.errors['sender_data.name']) || !_.isEmpty(this.errors['sender_data.city']) || !_.isEmpty(this.errors['sender_data.country']) || !_.isEmpty(this.errors['sender_data.zip_code']) || !_.isEmpty(this.errors['sender_data.address_line_1']));
            },
            stepItemOneHasErrors() {
              return false;
            },
            stepItemTwoHasErrors() {
              return false;
            },
            stepItemThreeHasErrors() {
              return this.errors != null && !_.isEmpty(this.errors) && !_.isEmpty(this.errors['back_text']);
            },
            stepItemFourHasErrors() {
              return this.errors != null && !_.isEmpty(this.errors) && (!_.isEmpty(this.errors['reciever_data']) || !_.isEmpty(this.errors['reciever_data.name']) || !_.isEmpty(this.errors['reciever_data.surnames']) || !_.isEmpty(this.errors['reciever_data.city']) || !_.isEmpty(this.errors['reciever_data.country']) || !_.isEmpty(this.errors['reciever_data.zip_code']) || !_.isEmpty(this.errors['reciever_data.address_line_1']));
            },
            stepItemFiveHasErrors() {
              return false;
            },
            newAddressListNameHasErrors() {
              return this.errorsAddressList != null && !_.isEmpty(this.errorsAddressList) && !_.isEmpty(this.errorsAddressList['name']);
            },
        },
        methods: {
            setCompanyLogo(event) {
              let vue = this;
              let files = event.target.files;
              if (files && files[0]){
                let file = files[0];

                vue.isSetCompanyLogo = true;
                vue.tempData.company_logo.is_set = true;
                vue.tempData.company_logo.name = file.name;
                vue.tempData.company_logo.size = file.size;
                vue.tempData.company_logo.position = 'bottom-right';

                let reader = new FileReader();
                reader.onload = function(e) {
                  $('.company-logo-img').attr({
                    src: e.target.result,
                    class: 'company-logo-img bottom-right'
                  });
                  vue.tempData.company_logo.image = e.target.result;
                }

                reader.readAsDataURL(file);
              }else{
                vue.isSetCompanyLogo = false;
                vue.tempData.company_logo.is_set = false;
                vue.tempData.company_logo.name = '';
                vue.tempData.company_logo.size = '';
                vue.tempData.company_logo.position = 'bottom-right';
                vue.tempData.company_logo.image = '';
              }
            },
            setCompanyLogoClass(value) {
              $('.company-logo-img').attr('class', 'company-logo-img '+value);
            },
            clearCompanyLogo() {
              console.info('0');
              this.isSetCompanyLogo = false;
              console.info('1');
              this.tempData.company_logo.is_set = false;
              console.info('2');
              this.tempData.company_logo.name = '';
              this.tempData.company_logo.size = '';
              this.tempData.company_logo.position = 'bottom-right';
              this.tempData.company_logo.image = '';
              $('#upload_logo_input').val('');
              $('.company-logo-img').attr('src', '').addClass('is-hidden');
              console.info('3');
            },
            selectCompanyLogo() {
              $('#upload_logo_input').click();
            },
            storeAddresList() {
                axios.post( '/api/addresslists/create', this.newAddressList)
                .then(response => {
                  this.isCreatingAddressList = false;
                  this.getCompanies(this.tempData.company_id);
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
                this.errorsAddressList = null,
                this.newAddressList.name = '';
            },
            setImportContactsToAddressList(index) {
              this.restoreImportContacts();
              this.selected_address_list = this.companies[this.tempData.company_id].address_lists[index];
              this.isImportingContacts = index;
            },
            addContactsToAddressList(index) {
                let formData = new FormData();
                formData.append('addresses', this.checked_csv_addresses);

                axios.post( '/api/addresses/addresslists/'+this.selected_address_list.id+'/insert', {addresses: this.checked_csv_addresses})
                .then(response => {
                  this.restoreImportContacts();
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
            },
            restoreImportContacts() {
                this.selected_address_list = null;
                this.isCreatingAddressList = false;
                this.getCompanies(this.tempData.company_id);
                this.tempData.reciever_data = [];
                this.isImportingContacts = null;
                this.checked_csv_addresses = [];
                this.csv_addresses = null;
                this.csv_file = null;
            },
            uploadCsvFile(event) {
                this.checked_csv_addresses = [];
                this.csv_addresses = null;
                // this.spinUploadButton = true;

                let formData = new FormData();
                formData.append('csv_file', this.csv_file[0]);

                axios.post( '/csv/import', formData)
                .then(response => {
                  // this.spinUploadButton = false;
                  // this.showUploadCsvFileButton = false;
                  this.csv_addresses = response.data.addresses;
                }).catch(error => {
                  if(error.response.status && error.response.status === 419){
                    location.href = '/login';
                  }
                });
            },
            getCompanies(id = null) {
                axios.get('/api/companies-from-editor/')
                .then(response => {
                    this.companies = response.data;
                    this.tempData.company_id = id;
                    if(id !== null){
                      this.selected_company_address_lists = this.companies[id].address_lists;
                    }
                }).catch(error => {
                    if(error.response.status && error.response.status === 419){
                      location.href = '/login';
                    }
                    console.info(error);
                    this.errors = error.response.data.errors;
                    console.log(error.response.data);
                    console.log(error.response.status);
                    console.log(error.response.headers);
                });
            },
            changeCompany(company_id) {
              if(company_id == 0 || company_id === null){
                this.emptyCompanyFields();
                return;
              }
              this.newAddressList.company_id = this.tempData.company_id;
              this.csv_file = null;
              this.csv_addresses = null;
              this.isCreatingCompany = false;
              this.isImportingContacts = false;
              this.selected_company_address_lists = this.companies[company_id].address_lists;
              this.tempData.sender_data.address_line_1 = this.companies[company_id].address.address_line_1;
              this.tempData.sender_data.address_line_2 = this.companies[company_id].address.address_line_2;
              this.tempData.sender_data.city = this.companies[company_id].address.city;
              this.tempData.sender_data.country = this.companies[company_id].address.country;
              this.tempData.sender_data.zip_code = this.companies[company_id].address.zip_code;
              this.tempData.sender_data.company = this.companies[company_id].address.company;
              this.tempData.sender_data.name = this.companies[company_id].address.name;
              this.tempData.sender_data.surnames = this.companies[company_id].address.surnames;
              this.tempData.sender_data.title = this.companies[company_id].address.title;
              this.tempData.sender_data.birthday = this.companies[company_id].address.birthday;
            },
            updateCompany(company_id) {
                axios.put('/api/companies/update-from-editor/'+company_id, {sender_data: this.tempData.sender_data})
                .then(response => {
                    this.getCompanies(company_id);
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
                      this.errors = error.response.data.errors;
                      console.log(error.response.data);
                      console.log(error.response.status);
                      console.log(error.response.headers);
                      this.$snackbar.open({
                          duration: 5000,
                          message: 'Please correct errors to update the company.',
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
            cancelCreateCompany() {
                this.isCreatingCompany = false;
                this.emptyCompanyFields();
            },
            createCompany() {
              this.isCreatingCompany = true;
              this.emptyCompanyFields();
            },
            storeCompany() {
                if(this.tempData.company_id !== null){
                  this.isCreatingCompany = true;
                  this.emptyCompanyFields();
                  return;
                }

                this.tempData.sender_data.is_new = true;

                axios.post('/api/companies/create-from-editor', {sender_data: this.tempData.sender_data})
                .then(response => {
                    this.tempData.sender_data.is_new = false;
                    this.getCompanies(response.data.company.id);
                    // let last_company;
                    // for(last_company in this.companies);
                    // this.tempData.company_id = last_company;
                    // this.tempData.company_id = 0;
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
                      this.errors = error.response.data.errors;
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
            generateRandomPassword() {
                this.tempData.sender_data.password = Math.random().toString(36).substring(2) + new Date().getTime().toString(36);
            },
            emptyCompanyFields() {
                this.tempData.company_id = null;
                this.tempData.sender_data.email = '';
                this.tempData.sender_data.password = '';
                this.tempData.sender_data.address_id = '';
                this.tempData.sender_data.address_line_1 = '';
                this.tempData.sender_data.address_line_2 = '';
                this.tempData.sender_data.city = '';
                this.tempData.sender_data.country = '';
                this.tempData.sender_data.zip_code = '';
                this.tempData.sender_data.title = '';
                this.tempData.sender_data.company = '';
                this.tempData.sender_data.name = '';
                this.tempData.sender_data.surnames = '';
                this.tempData.sender_data.birthday = '';
            },
            flipPostcard() {
              this.postcard_flipped = !this.postcard_flipped;
            },
            removeErrors() {
              if(!_.isEmpty(this.newAddressListErrors)){
                  if('name' in this.newAddressListErrors){
                    this.newAddressListErrors['name'] = null;
                  }
              }

              if(!_.isEmpty(this.errorsAddressList)){
                // AddressList form errors
                if('name' in this.errorsAddressList){
                  this.errorsAddressList['name'] = null;
                }
              }

              if(!_.isEmpty(this.errors)){
                //Removing sender data errors
                if('back_text' in this.errors && !_.isEmpty(this.tempData.back_text)){
                  this.errors.back_text = null;
                }
                if('sender_data.email' in this.errors && !_.isEmpty(this.tempData.sender_data.email)){
                  this.errors['sender_data.email'] = null;
                }
                if('sender_data.password' in this.errors && !_.isEmpty(this.tempData.sender_data.password)){
                  this.errors['sender_data.password'] = null;
                }
                if('sender_data.company' in this.errors && !_.isEmpty(this.tempData.sender_data.company)){
                  this.errors['sender_data.company'] = null;
                }
                if('sender_data.name' in this.errors && !_.isEmpty(this.tempData.sender_data.name)){
                  this.errors['sender_data.name'] = null;
                }
                if('sender_data.surnames' in this.errors && !_.isEmpty(this.tempData.sender_data.surnames)){
                  this.errors['sender_data.surnames'] = null;
                }
                if('sender_data.address_line_1' in this.errors && !_.isEmpty(this.tempData.sender_data.address_line_1)){
                  this.errors['sender_data.address_line_1'] = null;
                }
                if('sender_data.city' in this.errors && !_.isEmpty(this.tempData.sender_data.city)){
                  this.errors['sender_data.city'] = null;
                }
                if('sender_data.country' in this.errors && !_.isEmpty(this.tempData.sender_data.country)){
                  this.errors['sender_data.country'] = null;
                }
                if('sender_data.zip_code' in this.errors && !_.isEmpty(this.tempData.sender_data.zip_code)){
                  this.errors['sender_data.zip_code'] = null;
                }

                //Removing reciever data errors
                if('reciever_data.name' in this.errors && !_.isEmpty(this.tempData.reciever_data.name)){
                  this.errors['reciever_data.name'] = null;
                }
                if('reciever_data.surnames' in this.errors && !_.isEmpty(this.tempData.reciever_data.surnames)){
                  this.errors['reciever_data.surnames'] = null;
                }
                if('reciever_data.address_line_1' in this.errors && !_.isEmpty(this.tempData.reciever_data.address_line_1)){
                  this.errors['reciever_data.address_line_1'] = null;
                }
                if('reciever_data.city' in this.errors && !_.isEmpty(this.tempData.reciever_data.city)){
                  this.errors['reciever_data.city'] = null;
                }
                if('reciever_data.country' in this.errors && !_.isEmpty(this.tempData.reciever_data.country)){
                  this.errors['reciever_data.country'] = null;
                }
                if('reciever_data.zip_code' in this.errors && !_.isEmpty(this.tempData.reciever_data.zip_code)){
                  this.errors['reciever_data.zip_code'] = null;
                }
              }
            },
            tempFill() {
                // let tempDataForSession = $.extend(true, {}, this.tempData);
                // tempDataForSession.cropped_file = null;
                // tempDataForSession.original_file = null;
                // localStorage.tempData = JSON.stringify(tempDataForSession);

                this.empty_file_cropped = _.isEmpty($('#file1cropped').val());
                this.empty_file_original = _.isEmpty($('#file1original').val());

                this.enableDisableNextButton();
            },
            saveDraft() {
              var original_file = $('#file1original').val();
              var cropped_file = $('#file1cropped').val();
              this.tempData.original_file = original_file;
              this.tempData.cropped_file = cropped_file;

              if(this.tempData.postcard_id){
                  axios.put('/postcard/update/'+this.tempData.postcard_id, this.tempData)
                  .then(response => {
                      console.info(response.data);
                      // this.tempData.postcard_id = response.data.postcard_id;
                      // var front_cropped_file_path = response.data.temp_postcard.front_cropped_file_path;
                      // var front_original_file_path = response.data.temp_postcard.front_original_file_path;
                      // this.tempData.front_cropped_file_path = front_cropped_file_path;
                      // this.tempData.front_original_file_path = front_original_file_path;
                        this.$snackbar.open({
                            message: response.data.message,
                            duration: 5000,
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
                      this.errors = error.response.data.errors;
                      this.$snackbar.open({
                          duration: 5000,
                          message: 'Please correct errors before saving the postcard.',
                          type: 'is-danger',
                          queue: false,
                          position: 'is-top',
                          actionText: 'OK',
                          onAction: () => {
                              //Do something on click button
                          }
                      });
                  });
              } else {
                  axios.post('/postcard/store', this.tempData)
                  .then(response => {
                      console.info(response.data);
                      this.tempData.postcard_id = response.data.postcard_id;
                      var front_cropped_file_path = response.data.temp_postcard.front_cropped_file_path;
                      var front_original_file_path = response.data.temp_postcard.front_original_file_path;
                      this.tempData.front_cropped_file_path = front_cropped_file_path;
                      this.tempData.front_original_file_path = front_original_file_path;
                      this.$snackbar.open({
                          message: response.data.message,
                          duration: 5000,
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
                      this.errors = error.response.data.errors;
                      console.log(error.response.data);
                      console.log(error.response.status);
                      console.log(error.response.headers);
                      this.$snackbar.open({
                          duration: 5000,
                          message: 'Please correct errors before saving.',
                          type: 'is-danger',
                          queue: false,
                          position: 'is-top',
                          actionText: 'OK',
                          onAction: () => {
                              //Do something on click button
                          }
                      });
                  });
              }
            },
            changeFontFamily(event){
                if(event.target.tagName === 'LI'){
                    this.tempData.font_data.font_family = parseInt(event.target.dataset.fontid);
                    $('.font-selector .font-family').removeClass('opened');
                }
            },
            changeFontSize(event){
                if(event.target.tagName === 'LI'){
                    this.tempData.font_data.font_size = parseInt(event.target.dataset.fontsize);
                }
            },
            enableDisableNextButton() {
                setTimeout(function(){
                  let disabled = $('.step-item.is-active').next('.step-item').find('.step-marker').hasClass('is-disabled') ? true : false;
                  if(disabled){
                    $('.steps-actions [data-nav="next"]').attr('disabled', 'disabled');
                  } else {
                    $('.steps-actions [data-nav="next"]').removeAttr('disabled');
                  }
                },10);
            }
        },
        created() {
          // var localStorageTempData = JSON.parse(localStorage.tempData || null) || {};
          // if(!_.isEmpty(localStorageTempData)){
          //   this.tempData = localStorageTempData;
          // } else {
          //   this.tempFill();
          // }
        },
        mounted() {

            let vue = this;

            vue.tempFill();
            if(vue.companyIdProp){
              vue.getCompanies(vue.companyIdProp);
            }else{
              vue.getCompanies();
            }

            $(document).on('click', '.tool-done, .tool-remove', function(){
                vue.tempFill();
            });

            // window.onbeforeunload = function(e) {
            //   var dialogText = 'Dialog text here';
            //   e.returnValue = dialogText;
            //   return dialogText;
            // };

            // console.log('PostcardConfigurator Component mounted.')
        }
    }

</script>
