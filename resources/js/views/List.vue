<template>
    <table class="col-10 col-md-11 table table-hover">
        <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Number</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(number, index) in numbers">
                <td>{{ number.id }}</td>
                <td>{{ number.name }}</td>
                <td>{{ number.number }}</td>
                <td>
                    <router-link :to="{ name: 'edit', params: { id: number.id }}">
                        <button class="btn btn-primary">Edit</button>
                    </router-link>
                </td>
                <td><button class="btn btn-danger" v-on:click="deletePhone(index, number.id)">Delete</button></td>
            </tr>
        </tbody>
    </table>
</template>

<script>

    export default {
        data(){
            return{
                numbers: []
            }
        },

        created: function()
        {
            this.fetchPhoneNumbers();
        },

        methods: {
            fetchPhoneNumbers()
            {
                axios.get('/api/phone_numbers').then((response) => {
                  this.numbers = response.data;
                });
            },
            redirectToEdit(id)
            {
                window.location.href = `/edit/${id}`;
            },
            deletePhone(index, id)
            {
              this.numbers.splice(index, 1);
              axios.delete(`/api/phone_numbers/${id}`);
            }
        }
    }
</script>