<template>
    <div class="dropdown-item" @click="deleteItem" style="cursor:pointer;">
        Delete
    </div>
</template>

<script>
    export default {

        props:['href', 'text'], 

        methods:
        {
            deleteItem()
            {
                if(confirm(this.text || 'Delete Item'))
                {
                    axios.delete(this.href)
                    .then(data => data.data.data)
                    .then(data => location.reload())
                    .catch(error => console.log(error)); 
                }
            }, 
        },  
        
        mounted()
        {
            console.log("delete button mounted"); 
        }
    }
</script>