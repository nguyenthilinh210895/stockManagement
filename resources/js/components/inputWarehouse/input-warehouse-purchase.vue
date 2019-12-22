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
                            <li v-if="inputs.status == 0">Trạng thái		: Đang đợi</li>
                            <li v-if="inputs.status == 1">Trạng thái		: Hoàn thành </li>
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
                        <td><input type="text" name="quatity"></td>
                        <td><input type="checkbox" id="checkbox"></td>

                        <!--                        <td><input type="checkbox" id="checkbox" v-model="checked"></td>-->
                    </tr>
                    </tbody>
                </table>
<!--                <div class="row">-->
<!--                    <div class="col-lg-4 invoice-block pull-right">-->
<!--                        <ul class="unstyled amounts">-->
<!--                            <li><strong>Tổng tiền :</strong> 6000000820</li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
                <div class="text-center invoice-btn">
                    <a class="btn btn-danger btn-lg"><i class="fa fa-check"></i> Submit Invoice </a>
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
            }
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
