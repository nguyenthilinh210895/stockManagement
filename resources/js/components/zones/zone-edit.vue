<template>
    <section class="wrapper site-min-height">
        <section class="panel">
            <header class="panel-heading">Edit Zone</header>
            <div class="panel-body">
                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <div class="col-md-2">
                            <label for="warehouse" class="label-size-20">Warehouse</label>
                        </div>
                        <div class="col-md-8">
                            <select
                                class="form-control cs-select-form"
                                id="warehouse"
                                name="warehouse"
                                v-model="zones.warehouse"
                            >
                                <option v-for="ware in warehouse" :value="ware.id">{{ ware.warehouse_name }}</option>
                            </select>
                        </div>
                    </div>
                    <!--          <p class="errMessage" v-if="errors.warehouse_name">{{ errors.name[0]}}</p>-->
                </div>

                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <div class="col-md-2">
                            <label for="attribute" class="label-size-20">Attribute</label>
                        </div>
                        <div class="col-md-8">
                            <select
                                class="form-control cs-select-form"
                                id="attribute"
                                name="attribute" v-model="zones.attribute"
                            >
                                <option value="1">Sử dụng</option>
                                <option value="2">Dừng xuất/nhập</option>
                                <option value="3">Thi công</option>
                            </select>
                        </div>
                    </div>
                    <!--          <p class="errMessage" v-if="errors.warehouse_name">{{ errors.name[0]}}</p>-->
                </div>

                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <div class="col-md-2">
                            <label for="zone_code" class="label-size-20">Zone Code</label>
                        </div>
                        <div class="col-md-8">
                            <input
                                type="text"
                                id="zone_code"
                                class="form-control label-size-19"
                                name="zone_code" placeholder="Zone Code"
                                v-model="zones.zone_code" required
                            />
                        </div>
                    </div>
                    <p class="errMessage" v-if="errors.zone_code">{{ errors.zone_code[0]}}</p>
                </div>

            <div class="col-md-11 offset-1 clearfix">
                <div class="form-group-cs d-flex">
                    <button style="margin-left: 40%;" @click="handleEdit">Save</button>
                </div>
            </div>
        </div>
        </section>
    </section>
</template>
<script>
    export default {
        name: "zone-edit",
        props: {
            warehouse: { type: Array, required: true },
            zone_id: {type: Number, required: true},
        },
        data() {
            return {
                zones: null,
                errors: []
            };
        },
        created(){
            this.fetchZone();
        },
        methods: {
            fetchZone() {
                axios.get('/api/zones/'+ this.zone_id)
                    .then(res => {
                        this.zones = res.data.data;
                        this.zones.warehouse = this.zones.warehouse_id;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            handleEdit() {
                let formData = new FormData();
                formData.append("zone_code", this.zones.zone_code);
                formData.append("attribute", this.zones.attribute);
                formData.append("warehouse", this.zones.warehouse);
                formData.append("_method", 'PUT');
                axios.post("/api/zones/"+ this.zone_id, formData)
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
