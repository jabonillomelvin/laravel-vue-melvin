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
    }
</script>