<template>
    <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <aside class="profile-info col-lg-9">
                <section class="panel">
                    <div class="bio-graph-heading">
                       Nhập kho
                    </div>
                    <div class="panel-body bio-graph-info">
                        <h1>Thông tin phiếu nhập</h1>
                        <div class="row">
                            <div class="bio-row">
                                <div class="col-md-3">
                                    <label for="input_code" class="label-size-20">Mã phiếu</label>
                                </div>
                                <div class="col-md-6">
                                    <input
                                        class="form-control cs-select-form"
                                        id="input_code"
                                        name="input_code"

                                    >
                                </div>
                            </div>
                            <div class="bio-row">
                                <div class="col-md-3">
                                    <label for="employee" class="label-size-20">Nhân viên phụ trách</label>
                                </div>
                                <div class="col-md-6">
                                    <select
                                        class="form-control cs-select-form"
                                        id="employee"
                                        name="user"
                                    >
                                        <!--                                        <option v-for="quality in quality" :value="quality.id">{{ quality.quality_name }}</option>-->
                                    </select>
                                </div>
                            </div>
                            <div class="bio-row">
                                <div class="col-md-3">
                                    <label for="input_date" class="label-size-20">Ngày lập</label>
                                </div>
                                <div class="col-md-6">
                                    <input
                                        class="form-control cs-select-form"
                                        id="input_date"
                                        name="input_date"
                                    >
                                </div>
                            </div>
                            <div class="bio-row">
                                <div class="col-md-3">
                                    <label for="input_content" class="label-size-20">Note</label>
                                </div>
                                <div class="col-md-6">
                                    <textarea row="4"
                                        class="form-control cs-select-form"
                                        id="input_content"
                                        name="input_content"
                                    >
                                    </textarea>
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
                            <h1>Danh sách vật tư</h1>

                            <div class="row">
                                    <div class="col-md-1">
                                        <label for="zone" class="label-size-20">Mã phiếu</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input
                                            class="form-control cs-select-form"
                                            id="zone"
                                            name="zone"

                                        >
                                    </div>
                                <div class="col-md-1">
                                    <label for="unit" class="label-size-20">Đơn vị</label>
                                </div>
                                <div class="col-md-6">
                                    <input
                                        class="form-control cs-select-form"
                                        id="unit"
                                        name="unit"

                                    >
                                </div>

                            </div>


                            <div class="form-group">
                                <label  class="col-lg-2 control-label">Tên vật tư</label>
                                <div class="col-lg-6">
                                    <input type="text" name="product_name" class="form-control" id="p-name" placeholder=" ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-lg-2 control-label">Mã vật tư</label>
                                <div class="col-lg-6">
                                    <input type="text" name="product_code" class="form-control" id="code" placeholder=" ">
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
        name: "input-warehouse-create",
        // props: {
        //     zone: { type: Array, required: true },
        //     manufacturer:{ type: Array, required: true },
        //     item_group:{ type: Array, required: true },
        //     quality:{ type: Array, required: true },
        //     calculation_unit:{ type: Array, required: true },
        // },
        data() {
            return {
                // product: {
                //     product_code: '',
                //     product_name: '',
                //     product_price:'',
                //     out_of_date:'',
                //     zone: '',
                //     group:'',
                //     manufact:'',
                //     unit:'',
                //     quality:'',
                // },
                errors: [],
            };
        },
        methods: {
            // handleCreate(){
            //     var formData = new FormData();
            //     //Add the form data we need to submit
            //     formData.append('product_code', this.product.product_code);
            //     formData.append('product_name', this.product.product_name);
            //     formData.append('product_price', this.product.product_price);
            //     formData.append('out_of_date', this.product.out_of_date);
            //     formData.append("zone", this.product.zone);
            //     formData.append("group", this.product.group);
            //     formData.append("manufact", this.product.manufact);
            //     formData.append("unit", this.product.unit);
            //     formData.append("quality", this.product.quality);
            //
            //     //Make the request to the POST
            //     axios({
            //         method: 'post',
            //         url: '/api/products',
            //         data: formData,
            //         headers: {'content-type': 'multipart/form-data'}
            //     })
            //         .then(res => {
            //             localStorage.setItem(res.data.message.status, res.data.message.content);
            //             window.location.href=res.data.url;
            //         })
            //         .catch((error) => {
            //             this.errors = error.response.data.error;
            //         });
            // }
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
    .form-control {
        width: 300px;
    }
</style>
