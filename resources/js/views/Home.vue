<template>
    <div>
        <h1  class='text-center'>Phone numbers</h1>
        
        <div class='col-8 offset-1 m-auto'>
            <router-link to="/create"><a class="btn btn-primary" href="#" role="button" style='float:right'>Add</a></router-link>
            <List />
        </div>
    </div>
</template>

<script>
    import List from './List';

    export default {
        components: {
            List
        },
        data(){
            return{
                items: []
            }
        },

        created: function()
        {
            this.fetchPhoneNumbers();
        },

        methods: {
            fetchPhoneNumbers()
            {
                let uri = 'http://127.0.0.1:8000/api/phone_numbers';
                axios.get(uri).then((response) => {
                  this.items = response.data;
                });
            },
            deleteItem(id)
            {
              let uri = `http://localhost:8000/items/${id}`;
              this.items.splice(id, 1);
              this.axios.delete(uri);
            }
        }
    }
</script>