<template>
    <div>
        <form action="/orders" method="POST" validate @submit.prevent="submitForm">

            <div class="form-group">
                <label for="store">Unique Code</label>
                <input type="text" class="form-control" name="date" v-model="order.unq_code" required :disabled="isEdit()">
                <small v-if="!validUnqCode">Please enter a valid code.</small>
            </div>

            <div class="form-group">
                <label for="store">Date</label>
                <input type="date" class="form-control" name="date" v-model="order.date">
            </div>

            <div class="form-group">
                <label for="store">Store</label>
                <input type="text" class="form-control" name="store_name" v-model="order.store_name" required>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" min="1" name="quantity" v-model="order.quantity">
            </div>

            <div class="form-group">
                <label for="price">Price Per Item</label>
                <input type="number" class="form-control" min="0" name="price" v-model="order.price" required>
            </div>


            <div class="form-group">
                <label for="price">Comments</label>
                <textarea name="comments" class="form-control" id="" cols="30" rows="10" v-model="order.comments"></textarea>
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

        props:['savedOrder', 'mode'], 

        data()
        {
            return {

                order:{
                    date:'', 
                    store_name:'', 
                    quantity:1, 
                    price:0, 
                    comments:'', 
                    unq_code:'', 
                }, 

                product:{}, 

            }; 
        }, 

        computed:
        {
            validUnqCode()
            {
                return this.isValidProduct(); 
            }, 
        }, 

        watch:
        {
            'order.unq_code'()
            {
                console.log("watching the unq_code"); 

                if(this.isEdit()) return "";

                this.setProduct(); 
            }, 
        }, 

        methods:
        {
            init()
            {
                if(this.isEdit())
                {
                    this.order = this.savedOrder; 
                    this.product = this.order.product; 
                    this.order.unq_code = this.product.unq_code; 
                }
            }, 


            submitForm()
            {
                console.log("submitting the form."); 

                axios({
                    method: this.isEdit() ? 'put' : 'post', 
                    url:this.isEdit() ? '/orders/' + this.order.id : '/orders', 
                    data:this.payload()
                })
                .then(data => data.data.data)
                .then(data => {
                    //redirect here. 
                })
                .catch(error => console.log(error)); 
            }, 


            payload()
            {
                return {
                    'product_id':this.product.id, 
                    'quantity':this.order.quantity, 
                    'price':this.order.price, 
                    'date':this.order.date, 
                    'store_name':this.order.store_name, 
                    'comments':this.order.comments, 
                }; 
            }, 


            setProduct()
            {
                return axios.get('/products/' + this.order.unq_code)
                .then(data => data.data.data)
                .then(data => this.product = data)
                .catch(error => this.product = {}); 
            }, 

            
            isValidProduct()
            {
                return Object.keys(this.product).length; 
            }, 


            isEdit()
            {
                return this.mode == "edit"; 
            }, 

        }, 

        mounted()
        {
            console.log("order form is ready."); 

            this.init(); 
        }, 
    }
</script>
