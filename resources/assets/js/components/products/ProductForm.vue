<template>
    <div>
        <form method="POST" validate @submit.prevent="submitForm">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" v-model="product.name" required>
            </div>


            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="" cols="30" rows="10" v-model="product.description"></textarea>
            </div>

            <div class="form-group">
                <button class="btn btn-primary form-control" type="submit">
                    Submit
                </button>
            </div>

        </form>
    </div>
</template>

<script>
    export default {

        props:['savedProduct', 'mode'],  

        data(){
            return {

                product:{
                    name:'', 
                    description:'', 
                    unq_code:'', 
                }, 

            }; 
        }, 

        methods:
        {
            init()
            {
                if(this.isEdit())
                {
                    this.product = this.savedProduct; 
                }
            }, 

            submitForm()
            {
                console.log("submitting the form."); 

                axios({
                    method: this.isEdit() ? 'put' : 'post', 
                    url:this.isEdit() ? '/products/' + this.product.unq_code : '/products', 
                    data:this.payload()
                })
                .then(data => data.data.data)
                .then(data => {
                    //redirect here. 
                    location.href= "/products/" + data.unq_code; 
                })
                .catch(error => console.log(error)); 
            }, 


            payload()
            {
                return {
                    'name':this.product.name, 
                    'description':this.product.description, 
                }; 
            }, 


            isEdit()
            {
                return this.mode == "edit"; 
            },
        }, 

        mounted()
        {
            console.log("product form is ready."); 

            this.init();
        }, 
    }
</script>