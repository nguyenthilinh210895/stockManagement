<template>
    <section class="wrapper site-min-height">
        <section class="panel">
            <header class="panel-heading">Add Zone</header>
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
                                v-model="zone.warehouse"
                            >
                                <option v-for="ware in warehouse" :value="ware.id">{{ ware.warehouse_name }}</option>
                            </select>
                            <p class="errMessage" v-if="errors.warehouse">{{ errors.warehouse[0]}}</p>

                        </div>
                    </div>
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
                                name="attribute" v-model="zone.attribute"
                            >
                                <option value="1">Sử dụng</option>
                                <option value="2">Dừng xuất/nhập</option>
                                <option value="3">Thi công</option>
                            </select>
                            <p class="errMessage" v-if="errors.attribute">{{ errors.attribute[0]}}</p>

                        </div>
                    </div>
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
                                v-model="zone.zone_code" required
                            />
                            <p class="errMessage" v-if="errors.zone_code">{{ errors.zone_code[0]}}</p>

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
        name: "zone-create",
        props: {
            warehouse: { type: Array, required: true },
        },
        data() {
            return {
                zone: {
                    zone_code: '',
                    attribute: '',
                    warehouse:'',
                },
                errors: [],
            };
        },
        methods: {
            handleCreate() {
                let formData = new FormData();
                formData.append("zone_code", this.zone.zone_code);
                formData.append("attribute", this.zone.attribute);
                formData.append("warehouse", this.zone.warehouse);
                axios.post("/api/zones", formData)
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
