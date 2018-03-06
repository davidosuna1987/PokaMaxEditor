<template>
    <div v-if="company" class="postcards-show">
        <div class="columns is-centered">
            <div class="column is-10">
                <p class="title is-3 has-text-info">{{company.address.company}} postcards</p>
                <div v-if="company.postcards.length" class="card">
                    <div class="card-content">
                        <div class="columns">
                            <div v-for="postcard in company.postcards" class="column is-3">
                                <img :src="postcard.front_cropped_file_path" alt="Postcard front image">
                            </div>
                        </div>
                    </div>
                </div>

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
    export default {
        props: ['companyProp'],
        data() {
            return {
                company: null
            }
        },
        methods: {
            getPostcards() {
                console.info('company');
            }
        },
        mounted() {
            this.company = JSON.parse(this.companyProp);
        }
    }
</script>
