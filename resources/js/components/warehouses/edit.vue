<template>
    <section class="wrapper site-min-height">
        <section class="panel">
            <header class="panel-heading">Edit Warehouse</header>
            <div class="panel-body" v-if="warehouse">
                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <div class="col-md-2">
                            <label for="name" class="label-size-20">Area</label>
                        </div>
                        <div class="col-md-8">
                            <select
                                class="form-control cs-select-form"
                                name="area"
                                v-model="warehouse.area"
                            >
                                <option v-for="area in area" :value="area.id">{{ area.area_name }}</option>
                            </select>
                            <p class="errMessage" v-if="errors.warehouse_name">{{ errors.name[0]}}</p>

                        </div>
                    </div>
                </div>


                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <div class="col-md-2">
                            <label for="name" class="label-size-20">Name</label>
                        </div>
                        <div class="col-md-8">
                            <input
                                type="text"
                                id="name"
                                class="form-control label-size-19"
                                name="warehouse_name" placeholder="Warehouse Name"
                                v-model="warehouse.warehouse_name" required
                            />
                            <p class="errMessage" v-if="errors.warehouse_name">{{ errors.name[0]}}</p>

                        </div>
                    </div>
                </div>

                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <div class="col-md-2">
                            <label for="manager" class="label-size-20">Mangager</label>
                        </div>
                        <div class="col-md-8">
                            <input
                                type="text"
                                id="manager"
                                class="form-control label-size-19"
                                name="ware_manager"  placeholder="Manager"
                                v-model="warehouse.ware_manage"
                            />
                            <p class="errMessage" v-if="errors.ware_manage">{{ errors.ware_manage[0]}}</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <div class="col-md-2">
                            <label for="phone" class="label-size-20">Phone</label>
                        </div>
                        <div class="col-md-8">
                            <input
                                type="text"
                                id="phone"
                                class="form-control label-size-19"
                                name="ware_phone"  placeholder="Phone number"
                                v-model="warehouse.ware_phone"
                            />
                            <p class="errMessage" v-if="errors.ware_phone">{{ errors.ware_phone[0]}}</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <div class="col-md-2">
                            <label for="email" class="label-size-20">Email</label>
                        </div>
                        <div class="col-md-8">
                            <input
                                type="text"
                                id="email"
                                class="form-control label-size-19"
                                name="ware_email"  placeholder="Email"
                                v-model="warehouse.ware_email"
                            />
                            <p class="errMessage" v-if="errors.ware_email">{{ errors.ware_email[0]}}</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <button style="margin-left: 40%;" @click="handleCreate">Save</button>
                    </div>
                </div>


            </div>
        </section>
    </section>
</template>
<script>
    export default {
        name: "edit",
        props: {
            warehouse_id: { type: Number, required: true },
            area: { type: Array, required: true }
        },
        data() {
            return {
                warehouse: null,
                errors: [],
            };
        },
        created(){
            this.fetchWare();
        },
        methods: {
            fetchWare() {
                axios.get('/api/warehouses/'+ this.warehouse_id)
                    .then(res => {
                        this.warehouse = res.data.data;
                        this.warehouse.area = this.warehouse.area_id;
                    })
                    .catch(error => {
                    console.log(error);
                    });
            },
            handleCreate() {
                let formData = new FormData();
                formData.append("warehouse_name", this.warehouse.warehouse_name);
                formData.append("ware_manage", this.warehouse.ware_manage);
                formData.append("ware_phone", this.warehouse.ware_phone);
                formData.append("ware_email", this.warehouse.ware_email);
                formData.append("area", this.warehouse.area);
                formData.append("_method", 'PUT');
                axios
                    .post("/api/warehouses/" + this.warehouse_id, formData)
                    .then(res => {
                        localStorage.setItem(res.data.message.status, res.data.message.content);
                        window.location.href = res.data.url;
                        this.errors = [];
                    })
                    .catch(error => {
                        console.log(this.error);
                        this.errors = error.response.data.error;

                    });
            }
        }
    };
</script>

<style lang="scss" scoped>
    .form-group-cs {
        padding-top: 20px;
    }
</style>
