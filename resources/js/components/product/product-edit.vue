<template>
    <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <aside class="profile-info col-lg-9">
                <section class="panel">
                    <div class="bio-graph-heading">
                       Chỉnh sửa thông tin vật tư
                    </div>
                    <div class="panel-body bio-graph-info">
                        <h1>Thông tin vật tư</h1>
                        <div class="row">
                            <div class="bio-row">
                                <div class="col-md-3">
                                    <label for="zone" class="label-size-20">Zone</label>
                                </div>
                                <div class="col-md-6">
                                    <select
                                        class="form-control cs-select-form"
                                        id="zone"
                                        name="zone"
                                        v-model="product.zone"
                                    >
                                        <option v-for="zone in zone" :value="zone.id">{{ zone.zone_code }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="bio-row">
                                <div class="col-md-3">
                                    <label for="manufa" class="label-size-20">Nhà cung cấp</label>
                                </div>
                                <div class="col-md-6">
                                    <select
                                        class="form-control cs-select-form"
                                        id="manufa"
                                        name="manufacturer"
                                        v-model="product.manufact"
                                    >
                                        <option v-for="manu in manufacturer" :value="manu.id">{{ manu.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="bio-row">
                                <div class="col-md-3">
                                    <label for="group" class="label-size-20">Nhóm vật tư</label>
                                </div>
                                <div class="col-md-6">
                                    <select
                                        class="form-control cs-select-form"
                                        id="group"
                                        name="group"
                                        v-model="product.group"
                                    >
                                        <option v-for="group in item_group" :value="group.id">{{ group.group_name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="bio-row">
                                <div class="col-md-3">
                                    <label for="unit" class="label-size-20">Đơn vị tính</label>
                                </div>
                                <div class="col-md-6">
                                    <select
                                        class="form-control cs-select-form"
                                        id="unit"
                                        name="cal_unit"
                                        v-model="product.unit"
                                    >
                                        <option v-for="unit in calculation_unit" :value="unit.id">{{ unit.unit_name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="bio-row">
                                <div class="col-md-3">
                                    <label for="quality" class="label-size-20">Chất lượng</label>
                                </div>
                                <div class="col-md-6">
                                    <select
                                        class="form-control cs-select-form"
                                        id="quality"
                                        name="quality"
                                        v-model="product.quality"
                                    >
                                        <option v-for="quality in quality" :value="quality.id">{{ quality.quality_name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </aside>
            <aside class="profile-info col-lg-9">
                <section class="panel">
                    <div class="panel-body bio-graph-info">
                        <form class="form-horizontal" role="form" onsubmit="return false;">
                            <div class="form-group">
                                <label  class="col-lg-2 control-label">Tên vật tư</label>
                                <div class="col-lg-6">
                                    <input type="text" name="product_name" v-model="product.product_name" class="form-control" id="p-name" placeholder=" ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-lg-2 control-label">Mã vật tư</label>
                                <div class="col-lg-6">
                                    <input type="text" name="product_code" v-model="product.product_code" class="form-control" id="code" placeholder=" ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-lg-2 control-label">Giá</label>
                                <div class="col-lg-6">
                                    <input type="text" name="product_price" v-model="product.product_price"  class="form-control" id="price" placeholder=" ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-lg-2 control-label">Ngày hết hạn</label>
                                <div class="col-lg-6">
                                    <input type="text" name="out_of_date" v-model="product.out_of_date"  class="form-control" id="out_of_date" placeholder=" ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-lg-2 control-label">Màu sắc</label>
                                <div class="col-lg-6">
                                    <input type="text" name="color" class="form-control" id="color" placeholder=" ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-lg-2 control-label">Khối lượng</label>
                                <div class="col-lg-6">
                                    <input type="text" name="quantity" class="form-control" id="quantity" placeholder=" ">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button @click="handleCreate" class="btn btn-success">Lưu</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>

            </aside>
        </div>

        <!-- page end-->
    </section>
</template>

<script>
    export default {
        name: "product-edit",
        props: {
            zone: { type: Array, required: true },
            manufacturer:{ type: Array, required: true },
            item_group:{ type: Array, required: true },
            quality:{ type: Array, required: true },
            calculation_unit:{ type: Array, required: true },
            product_id:{type:Number, required:true},
        },
        data() {
            return {
                product: null,
                errors: [],
            };
        },
        created() {
            this.fetchProduct();
            },
        methods: {
            fetchProduct() {
                axios.get('/api/products/'+ this.product_id)
                    .then(res => {
                        this.product = res.data.data;
                        this.product.manufact = this.product.manufacturer_id;
                        this.product.group = this.product.item_group_id;
                        this.product.unit = this.product.calculation_unit_id;
                        this.product.quality = this.product.quality_id;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            handleCreate(){
                var formData = new FormData();
                //Add the form data we need to submit
                formData.append('product_code', this.product.product_code);
                formData.append('product_name', this.product.product_name);
                formData.append('product_price', this.product.product_price);
                formData.append('out_of_date', this.product.out_of_date);
                formData.append("zone", this.product.zone);
                formData.append("group", this.product.group);
                formData.append("manufact", this.product.manufact);
                formData.append("unit", this.product.unit);
                formData.append("quality", this.product.quality);

                //Make the request to the POST
                axios({
                    method: 'post',
                    url: '/api/products',
                    data: formData,
                    headers: {'content-type': 'multipart/form-data'}
                })
                    .then(res => {
                        localStorage.setItem(res.data.message.status, res.data.message.content);
                        window.location.href=res.data.url;
                    })
                    .catch((error) => {
                        this.errors = error.response.data.error;
                    });
            }
        }
    }
</script>

<style scoped>
    .row{
        margin-right: -340px;
    }
    .bio-row {
        width: 40%;
    }
    .bio-graph-heading {
        font-weight: 600;
    }
</style>
