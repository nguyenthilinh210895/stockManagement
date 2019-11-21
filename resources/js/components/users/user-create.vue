<template>
    <section class="wrapper site-min-height">
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                          Add employee
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form class="cmxform form-horizontal tasi-form" id="signupForm" onsubmit="return false;">
                                    <div class="form-group ">
                                        <label for="employee_id" class="control-label col-lg-2">Warehouse</label>

                                        <div class="col-lg-8">
                                            <select
                                                class="form-control cs-select-form"
                                                id="warehouse_id"
                                                name="warehouse"
                                                v-model="user.warehouse"
                                            >
                                                <option v-for="ware in warehouses" :value="ware.id">{{ ware.warehouse_name }}</option>
                                            </select>
                                            <p class="errMessage" v-if="errors.warehouse">{{ errors.warehouse[0]}}</p>
                                        </div>

                                    </div>


                                    <div class="form-group ">
                                        <label for="employee_id" class="control-label col-lg-2">Employee_Id</label>
                                        <div class="col-lg-8">
                                            <input class=" form-control" id="employee_id" name="employee_id" v-model="user.employee_id" type="text" />
                                            <p class="errMessage" v-if="errors.employee_id">{{ errors.employee_id[0]}}</p>

                                        </div>

                                    </div>
                                    <div class="form-group ">
                                        <label for="fullname" class="control-label col-lg-2">Fullname</label>
                                        <div class="col-lg-8">
                                            <input class=" form-control" id="fullname" name="fullname" v-model="user.fullname" type="text" />
                                            <p class="errMessage" v-if="errors.fullname">{{ errors.fullname[0]}}</p>

                                        </div>

                                    </div>
                                    <div class="form-group ">
                                        <label for="email" class="control-label col-lg-2">Email</label>
                                        <div class="col-lg-8">
                                            <input class="form-control " id="email" name="email"v-model="user.email" type="email" />
                                            <p class="errMessage" v-if="errors.email">{{ errors.email[0]}}</p>

                                        </div>

                                    </div>
                                    <div class="form-group ">
                                        <label for="phone_number" class="control-label col-lg-2">Phone number</label>
                                        <div class="col-lg-8">
                                            <input class="form-control " id="phone_number" name="phone_number" v-model="user.phone_number" type="text" />
                                            <p class="errMessage" v-if="errors.email">{{ errors.phone_number[0]}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="address" class="control-label col-lg-2">Address</label>
                                        <div class="col-lg-8">
                                            <input class="form-control " id="address" name="address" v-model="user.address" type="text" />
                                            <p class="errMessage" v-if="errors.address">{{ errors.address[0]}}</p>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button class="btn " @click="handleCreate">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </section>

</template>

<script>
    export default {
        name: "user-create",
        props:{
            warehouses:{type:Array,required:true},
        },
        data(){
            return {
                user:{
                    warehouse:'',
                    employee_id: '',
                    fullname: '',
                    email: '',
                    phone_number: '',
                    address: '',
                },
                errors: [],
            }
        },
        methods: {
            handleCreate(){
                axios.post('/api/users',this.user)
                    .then(res =>{
                        localStorage.setItem(res.data.message.status, res.data.message.content);
                        window.location.href = res.data.url;
                        this.errors = [];
                    })
                    .catch(error =>{
                      this.errors = error.response.data.error;
                    });
            }

        }

    }
</script>

<style scoped>
.btn{
    margin-left: 250px;
}
</style>
