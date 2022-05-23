<template>
    <div>
        <h1  class='text-center'>{{ typeOfForm }} phone number</h1>
        
        <div class='col-8 offset-1 m-auto'>
            <form>
                <div class="form-group">
                    <label for="forName">Name</label>
                    <input type="text" v-model='v$.name.$model' class="form-control" id="forName" placeholder="Enter your name">
                    <div class="pre-icon os-icon os-icon-user-male-circle"></div>
                    <!-- Error Message -->
                    <div class="input-errors" v-for="(error, index) of v$.name.$errors" :key="index">
                        <div class="text-danger">{{ error.$message }}</div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="forNumber">Number</label>
                    <input type="text" v-model='v$.number.$model' class="form-control" id="forNumber" placeholder="Enter your number">
                    <div class="pre-icon os-icon os-icon-user-male-circle"></div>
                    <!-- Error Message -->
                    <div class="input-errors" v-for="(error, index) of v$.number.$errors" :key="index">
                        <div class="text-danger">{{ error.$message }}</div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-2" :disabled="v$.$invalid" v-on:click="submit">Submit</button>
                <router-link to="/"><button type="submit" class="btn btn-danger mt-2 ml-2" style='margin-left: 10px;'>Cancel</button></router-link>
            </form>
        </div>
    </div>
</template>

<script>
    import { useRoute } from 'vue-router'
    import useVuelidate from '@vuelidate/core'
    import { required, numeric, minLength } from '@vuelidate/validators'

    export default {
        setup () {
            return { v$: useVuelidate() }
        },

        data() {
            return{
                phoneNumberId: null,
                name: null,
                number: null,
                typeOfForm: window.location.href.includes('create') ? 'Create' : 'Edit'
            }
        },

        created: function()
        {
            const route = useRoute()
            this.phoneNumberId = route.params.id;
            if (this.phoneNumberId) {
                this.fetchPhoneNumbeData();
            }
        },

        methods: {
            fetchPhoneNumbeData() {
                console.log(`/api/phone_numbers/edit/${this.phoneNumberId}`)
                axios.get(`/api/phone_numbers/edit/${this.phoneNumberId}`).then((response) => {
                    const data = response.data;
                    this.name = data.name;
                    this.number = data.number;
                });
            },
            submit(e) {
                e.preventDefault()
                axios.post('/api/phone_numbers/submit', {
                    phoneNumberID: this.phoneNumberId,
                    name: this.name,
                    number: this.number
                })
                .then(function (response) {
                    console.log(response);

                    window.location.href = '/'
                })
            }
        },

        validations: {
            name: { required, min: minLength(6) },
            number: { required, min: minLength(6), numeric },
            computed: {
                isComplete() {
                    return this.name && this.number;
                }
            },
        }
    }
</script>