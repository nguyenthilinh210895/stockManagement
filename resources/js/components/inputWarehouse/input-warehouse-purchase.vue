<template>
    <section>
        <div class="wrapper">
<!--            <div class="panel-heading navyblue"> INVOICE</div>-->
            <div class="panel-body">
                <div class="row invoice-list">
                    <div class="text-center corporate-id">
                        <h2>Bản kê chi tiết nhập vật tư</h2>
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <p>
                      Mã phiếu nhập		: <strong>69626</strong><br>
                      Ngày nhập		: 2013-03-17<br>
                        </p>
                    </div>
                    <div class="col-lg-4 col-sm-4">
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <ul class="unstyled">
                            <li>Nhân viên phụ trách		: Nguyễn Văn A</li>
                            <li>Trạng thái		: Đang đợi</li>
                        </ul>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Mã Vật tư</th>
                        <th class="hidden-phone">ĐVT</th>
                        <th class="">Giá</th>
                        <th class="">Kho</th>
                        <th class="">SL dự kiến</th>
                        <th class="">SL thực tế</th>
                        <th>Tổng tiền</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>LCD Monitor</td>
                        <td class="hidden-phone">20 inch Philips LCD Black color monitor</td>
                        <td class="">$ 1000</td>
                        <td class=""></td>
                        <td class="">2</td>
                        <td>$ 2000</td>
                        <td>$ 2000</td>
                        <td><input type="checkbox" id="checkbox" v-model="checked"></td>
                    </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-lg-4 invoice-block pull-right">
                        <ul class="unstyled amounts">
                            <li><strong>Sub - Total amount :</strong> $6820</li>
                            <li><strong>Discount :</strong> 10%</li>
                            <li><strong>VAT :</strong> -----</li>
                            <li><strong>Grand Total :</strong> $6138</li>
                        </ul>
                    </div>
                </div>
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
        name: "input-warehouse-purchase"
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
</style>
