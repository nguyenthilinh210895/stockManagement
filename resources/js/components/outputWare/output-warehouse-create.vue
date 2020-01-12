<template>
    <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <aside class="profile-info col-lg-9">
                <section class="panel">
                    <div class="bio-graph-heading">
                        Xuất kho
                    </div>
                    <div class="panel-body bio-graph-info">
                        <h1>Thông tin phiếu xuất</h1>
                        <div class="row">
                            <div class="bio-row">
                                <div class="col-md-3">
                                    <label for="output_code" class="label-size-20">Mã phiếu</label>
                                </div>
                                <div class="col-md-6">
                                    <input
                                        class="form-control cs-select-form"
                                        id="output_code"
                                        name="output_code"
                                        v-model="output.output_code"
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
                                        v-model="output.employee"
                                    >
                                        <option v-for="employ in employees" :value="employ.id">{{employ.fullname}}({{employ.employee_id}})</option>-->
                                    </select>
                                </div>
                            </div>
                            <div class="bio-row">
                                <div class="col-md-3">
                                    <label for="output_date" class="label-size-20">Ngày lập</label>
                                </div>
                                <div class="col-md-6">
                                    <date-picker v-model="output.output_date"
                                                 id="output_date"
                                                 valueType="format"
                                    >
                                    </date-picker>
                                </div>
                            </div>
                            <div class="bio-row">
                                <div class="col-md-3">
                                    <label for="output_content" class="label-size-20">Note</label>
                                </div>
                                <div class="col-md-6">
                                    <textarea row="4"
                                              class="form-control cs-select-form"
                                              id="output_content"
                                              name="output_content"
                                              v-model="output.output_content"
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
                                    <th>Số lượng tổng</th>
                                    <th>Zone</th>
                                    <th>Số lượng</th>
                                </tr>
                                <tr v-for="(i, index) in product">
                                    <td>  <select
                                        class="form-control cs-select-form"
                                        id="product"
                                        name="product"
                                        v-model="product.product_id=i.product_code">
                                        <option v-for="pro in products" :value="{id: pro.id, zone: pro.zone}">{{ pro.product_code }}</option>
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
                                     <!-- <td> <select
                                        class="form-control cs-select-form"
                                        id="product"
                                        name="product"
                                        v-model="product.zone_id=i.zone_id">
                                        <option >{{ showText(product.product_id) }}</option>
                                    </select></td> -->
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
    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';
    export default {
        name: "output-warehouse-create",
        components: {DatePicker},
        props: {
            employees: {type: Array, required: true},
        },
        data() {
            return {
                format: 'yyyy-MM-dd',
                output: {
                    output_code:'',
                    employee:'',
                    output_date:'',
                    output_content:'',
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
                        console.log(this.products[0].zone);
                    }).catch(error => {
                    console.log(error);
                });
            },
            removeProduct(index){
                this.product.splice(index, 1);
            },
            addProduct(index){
                this.product.push({product_id: '',estimate_quatity: '', zone_id: ''});
            },
            handleSave(){
                let formData = new FormData();
                formData.append('output_code', this.output.output_code);
                formData.append('output_content', this.output.output_content);
                formData.append('output_date', this.output.output_date);
                formData.append('user_id', this.output.employee);
                for (let i = 0; i < this.product.length; i++) {
                    formData.append('product_id[]', this.product[i].product_id);
                    formData.append('estimate_quantity[]', this.product[i].estimate_quatity);
                }


                axios.post('/api/outputs', formData)
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
    /* .form-control {
        width: 300px;
    } */
    th{
        text-align: center;
    }
    .table thead > tr > td, .table tbody > tr > td, .table tfoot > tr > td {
        padding: 1px;
    }
    .form-control{
        width: 250px;
    }
    /* .adv-table table tr :nth-child(2){
       width: 10% !important;
    }
     .adv-table table tr :nth-child(1){
       width: 10% !important;
    } */
</style>
