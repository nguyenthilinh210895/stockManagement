<template>
    <section>
        <div class="wrapper site-min-height" v-if="this.outputs">
            <div class="panel-heading navyblue"> </div>
            <div class="panel-body">
                <div class="row invoice-list">
                    <div class="text-center corporate-id">
                        <h2>Bản kê chi tiết xuất vật tư</h2>
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <p>
                            Mã phiếu xuất		: <strong>{{outputs.output_code}}</strong><br>
                            Ngày xuất		: {{outputs.output_date}}<br>
                            Nhân viên phụ trách		: {{outputs.getEmployee.fullname}}<br>
                        </p>
                    </div>
                    <div class="col-lg-4 col-sm-4">
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <ul class="unstyled">
                            <li v-if="outputs.status == 0">Trạng thái		: Đang đợi</li>
                            <li v-else>Trạng thái		: Hoàn thành </li>
                            <li>Note		: {{outputs.output_content}}</li>
                        </ul>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Mã Vật tư</th>
                        <th class="hidden-phone">ĐVT</th>
                       <th class="">Zone</th>
                        <th class="">SL dự kiến</th>
                        <th class="">SL thực tế</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(detail,index) in outputs.detail">
                        <td>{{index +1}}</td>
                        <td>{{outputs.detail[index].product.product_code}}</td>
                        <td class="hidden-phone">{{outputs.detail[index].product.unit}}</td>
                       <td class="">{{outputs.detail[index].zone.zone_code}}</td>
                        <td class="">{{outputs.detail[index].detail_estimate_quantity}}</td>
                        <td><input type="text" name="quatity" @onchange="addQuantity"
                            v-model="outputs.detail.detail_output_quantity= detail.detail_output_quantity"></td>
                        <td><input type="checkbox" id="checkbox"></td>
                    </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-lg-4 invoice-block pull-right">
                        <ul class="unstyled amounts">
                        </ul>
                    </div>
                </div>
                <div class="text-center invoice-btn">
                    <button  v-if="outputs.status == 0" class="btn btn-danger btn-lg" @click="handleSave">Lưu phiếu nhập </button>
                    <a class="btn btn-info btn-lg" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print </a>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "output-checklist",
        props:{
            output_id:{type:Number,require:true}
        },
        data(){
            return {
                outputs: [],
            };
        },
        created(){
            this.fetchOutput();
        },
        methods: {
            fetchOutput(){
                axios.get('/api/outputs/'+ this.output_id)
                    .then(res =>{
                        this.outputs = res.data.data;
                        console.log(res.data.data);
                    })
            },
             addQuantity(index) {
                this.outputs.detail.push({detail_output_quantity: ''});
            },

            handleSave() {
                let formData = new FormData();
                 formData.append('_method', 'PATCH');
                for (let i = 0; i < this.outputs.detail.length; i++) {
                    formData.append('product_id[]', this.outputs.detail[i].product_id);
                    formData.append('detail_estimate_quantity[]', this.outputs.detail[i].detail_estimate_quantity);
                    formData.append('zone_id[]', this.outputs.detail[i].zone_id);
                    formData.append('quantity[]', this.outputs.detail[i].detail_output_quantity || '');
                }

                axios.post('/api/outputs/'+ this.output_id, formData)
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
