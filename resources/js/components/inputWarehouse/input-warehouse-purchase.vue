<template>
    <section>
        <div class="wrapper site-min-height">
            <div class="panel-heading navyblue"> </div>
            <div class="panel-body">
                <div class="row invoice-list">
                    <div class="text-center corporate-id">
                        <h2>Bản kê chi tiết nhập vật tư</h2>
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <p>
                      Mã phiếu nhập		: <strong>{{inputs.input_code}}</strong><br>
                      Ngày nhập		: {{inputs.input_date}}<br>
                      Nhân viên phụ trách		: {{inputs.getEmployee.fullname}}<br>
                        </p>
                    </div>
                    <div class="col-lg-4 col-sm-4">
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <ul class="unstyled">
                            <li v-if="inputs.status == 1">Trạng thái		: Đang đợi</li>
                            <li v-if="inputs.status == 1">Trạng thái		: Đaang soạn</li>
                            <li v-if="inputs.status == 2">Trạng thái		: Hoàn thành </li>
                            <li>Note		: {{inputs.input_content}}</li>
                        </ul>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Mã Vật tư</th>
                        <th class="hidden-phone">ĐVT</th>
<!--                        <th class="">Giá</th>-->
                        <th class="">Zone</th>
                        <th class="">SL dự kiến</th>
                        <th class="">SL thực tế</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(detail,index) in inputs.detail">
                        <td>{{index +1}}</td>
                        <td>{{inputs.detail[index].product.product_code}}</td>
                        <td class="hidden-phone">{{inputs.detail[index].product.unit}}</td>
<!--                        <td class="">{{inputs.detail[index].product.product_price}}</td>-->
                        <td class="">{{inputs.detail[index].product.zone[0].zone_code}}</td>
                        <td class="">{{inputs.detail[index].detail_estimate_quantity}}</td>
                        <td><input type="text" @onchange="addQuantity" name="quatity" v-model="inputs.detail.detail_input_quantity= detail.detail_input_quantity"></td>
                        <td><input type="checkbox" id="checkbox"></td>
                    </tr>
                    </tbody>
                </table>
                <div class="text-center invoice-btn">
                    <button  v-if="inputs.status == 1" class="btn btn-danger btn-lg" @click="handleSave">Lưu phiếu nhập </button>
                    <a class="btn btn-info btn-lg" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print </a>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "input-warehouse-purchase",
        props:{
            input_id:{type:Number,require:true}
        },
        data(){
          return {
            inputs: [],
            input: [],
          };
        },
        created(){
          this.fetchInput();
        },
        methods: {
            fetchInput(){
                axios.get('/api/inputs/' +this.input_id)
                    .then(res =>{
                        this.inputs = res.data.data;
                    })
            },

             addQuantity(index) {
                this.inputs.detail.push({detail_input_quantity: ''});
            },

            handleSave() {
                let formData = new FormData();
                 formData.append('_method', 'PATCH');
                for (let i = 0; i < this.inputs.detail.length; i++) {
                    formData.append('product_id[]', this.inputs.detail[i].product_id);
                    formData.append('detail_estimate_quantity[]', this.inputs.detail[i].detail_estimate_quantity);
                    formData.append('zone_id[]', this.inputs.detail[i].zone_id);
                    formData.append('quantity[]', this.inputs.detail[i].detail_input_quantity || '');
                }

                axios.post('/api/inputs/update/'+ this.input_id, formData)
                    .then(res => {
                        localStorage.setItem(res.data.message.status, res.data.message.content);
                        window.location.href = res.data.url;
                        this.errors = [];
                    })
                    .catch(error => {

                        this.errors = error.response.data.error;
                    });
            },
        },
    }
</script>

<style scoped>
    .h2, h2 {
        font-size: 20px;
        font-weight: 600;
    }
    .table > thead:first-child > tr:first-child > th {
        background-color: #ddd;
        color: black;
    }
    input{
        width: 85px;
    }

</style>
