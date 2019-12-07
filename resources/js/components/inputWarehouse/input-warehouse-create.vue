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
                                        v-model="input.input_code"
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
                                        name="employee"
                                        v-model="input.employee"
                                    >
                                       <option v-for="employ in employees" :value="employ.id">{{employ.fullname}}({{employ.employee_id}})</option>-->
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
                                        v-model="input.input_date"
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
                                        v-model="input.input_content"
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
                            <div class="space15"></div>
                            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                <tbody>
                                <tr>
                                    <th>Vật tư</th>
                                    <th>Giá</th>
                                    <th>Đơn vị tính</th>
                                    <th>Số lượng</th>
                                </tr>
                                <tr v-for="(i, index) in product">
                                    <td>  <select
                                        class="form-control cs-select-form"
                                        id="product"
                                        name="product"
                                        v-model="product.product_code=i.product_code">
                                       <option v-for="pro in products" :value="pro.id">{{ pro.product_code }}</option>
                                    </select></td>
                                    <td>  <select
                                        class="form-control cs-select-form"
                                        id="price"
                                        name="product_price"
                                        v-model="product.product_code=i.product_code">
                                        <option v-for="pro in products" :value="pro.id">{{ pro.product_price }}</option>
                                    </select></td>
                                    <td> <select
                                        class="form-control cs-select-form"
                                        id="unit"
                                        name="unit"
                                        v-model="product.product_code=i.product_code">
                                        <option v-for="pro in products" :value="pro.id">{{ pro.unit }}</option>
                                    </select></td>
                                    <td>
                                        <input
                                            type="text"
                                            id="quatity"
                                            class="form-control label-size-19"
                                            name="estimate_quatity"  placeholder="Số lượng"
                                            v-model="product.estimate_quatity = i.estimate_quatity"
                                        />
                                    </td>
                                    <td>
                                        <i @click="removeProduct(index)" class="fa fa-remove" style="color:red;cursor:pointer"></i>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="clearfix">
                                <div class="btn-group">
                                    <button @click="addProduct"
                                            id="editable-sample_new" class="btn green">
                                        Thêm mới <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button @click="handleSave" class="btn btn-success">Lưu</button>
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
        props: {
            employees: {type: Array, required: true},
        },
        data() {
            return {
                input: {
                    input_code:'',
                    employee:'',
                    input_date:'',
                    input_content:'',
                },
                product: [],
                products: null,
                errors: [],
            };
        },
        created(){
            this.fetchProduct();
        },
        methods:{
            fetchProduct(){
                axios.get('/api/products')
                    .then(res => {
                        this.products = res.data.data;
                    }).catch(error => {
                    console.log(error);
                });
            },
            removeProduct(index){
                this.product.splice(index, 1);
            },
            addProduct(index){
                this.product.push({product_code: '',estimate_quatity: ''});
            },
            handleSave(){
                let formData = new FormData();
                formData.append('input_code', this.input.input_code);
                formData.append('input_content', this.input.input_content);
                formData.append('input_date', this.input.input_date);
                formData.append('user_id', this.input.employee);
                for (let i = 0; i < this.product.length; i++) {
                    formData.append('product_id[]', this.product[i].product_code);
                    formData.append('estimate_quantity[]', this.product[i].estimate_quatity);
                }


                axios.post('/api/inputs', formData)
                    .then(res => {
                        localStorage.setItem(res.data.message.status, res.data.message.content);
                        //window.location.href = res.data.url;
                        this.errors = [];
                    })
                    .catch(error => {
                        this.errors = error.response.data.error;
                    });
            },
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
    th{
        text-align: center;
    }
     .table thead > tr > td, .table tbody > tr > td, .table tfoot > tr > td {
        padding: 1px;
    }
    .form-control{
        width: 250px;
    }
    /*.adv-table table tr :nth-child(2){*/
    /*    width: 3% !important;*/
    /*}*/
</style>
