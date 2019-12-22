<template>
    <section class="wrapper site-min-height">
        <section class="panel">
            <div id="app">
                <notifications group="notifi" position="top left" />
            </div>
            <header class="panel-heading">
                Quản lý xuất kho
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="btn-group">
                            <button id="editable-sample_new" class="btn green">
                                <a href="/manager/outputs/create">
                                    Thêm mới <i class="fa fa-plus"></i>
                                </a>
                            </button>
                        </div>
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                        <tr>
                            <th>Mã phiếu</th>
                            <th>Ngày nhập</th>
                            <th>Nhân viên</th>
                            <!--                            <th>Tổng tiền</th>-->
                            <th>Trạng thái</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(output, index) in outputs">
                            <td>{{output.output_code }}</td>
                            <td>{{output.output_date}}</td>
                            <td>{{output.getEmployee.fullname}}({{output.getEmployee.employee_id}})</td>
                            <!--                            <td>{{input.input_total_money}}</td>-->
                            <td v-if="output.status == 0"><button style="background-color: orangered;color: whitesmoke">Đang đợi</button></td>
                            <td v-else><button style="background: forestgreen;color:whitesmoke;">Hoàn thành</button></td>
                            <td>
                                <a v-if="output.status == 0" :href="'/manager/outputs/picklist/'+ output.id">
                                    <i class="fa fa-edit" style="color:blue"></i>
                                </a>
                                <a v-if="output.status == 2" :href="'/manager/outputs/'+ output.id +'/edit'">
                                    <i class="fa fa-edit" style="color:blue"></i>
                                </a>
                            <td>
                                <i v-if="output.status == 0" class="fa fa-trash-o"  style="color:red; cursor:pointer" @click="handleDelete(output,index)"></i>
                                <i v-if="output.status == 2" class="fa fa-trash-o"  style="color:red; cursor:pointer" @click="handleDelete(output,index)"></i>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="deleteContainer" v-if="deleteClicked"></div>
                <div class="notification-delete" v-if="deleteClicked">
                    <span>Bạn thực sự muốn xóa ？</span>
                    <div>
                        <table class="table-notify">
                            <tr class="show-infor">
                                <td >Mã phiếu：{{item.output_code || ''}}</td>
                                <td>Ngày xuất：{{item.output_date || ''}}</td>
                            </tr>
                        </table>
                        <hr>
                    </div>
                    <div class="button-message">
                        <button class="accept" @click="Delete">Xóa</button>
                        <button class="cancel" @click="cancelDelete">Hủy</button>
                    </div>
                </div>
            </div>
        </section>
    </section>

</template>
<script>
    export default {
        name: 'output-show',
        data(){
            return {
                outputs: null,
                editButton: 'Edit',
                deleteButton: 'Delete',
                deleteClicked: false,
                item:'',
                index: 0,
                isActive: false,
            }
        },
        created(){
            axios.get('/api/outputs')
                .then(res => {
                    this.outputs = res.data.data;
                }).catch(error => {
                console.log(error);
            });
        },
        methods:{
            handleDelete(item, index){
                this.deleteClicked = true;
                this.item = item;
                this.index = index
            },
            classObject: function () {
                return {
                    active: this.isActive,
                }
            },
            cancelDelete(){
                return this.deleteClicked = false;
            },
            Delete(index){
                axios.delete('/api/outputs/'+this.item.id)
                    .then(res => {
                        this.areas.splice(this.index, 1)
                        this.$notify({
                            group: "notifi",
                            type: 'success',
                            text: res.data.message.content,
                            duration: 6000
                        });
                        this.deleteClicked = false;
                    }).catch(error => {
                    console.log(error);
                });
            }
        }

    }
</script>

<style lang="scss" scoped>
    .adv-table table tr :nth-child(4){
        width: 3% !important;
    }
    .background {
        height: 750px;
        h1 {
            color: #43425D;
        }
    }
    .content {
        background: #FFFFFF 0% 0% no-repeat padding-box;
        box-shadow: 0px 2px 6px #0000000A;
        height: 100%;
        padding-top: 40px;
        .header-content {
            padding-bottom: 60px;
            button {
                background: #1492E6 0% 0% no-repeat padding-box;
                border: 1px solid #E8E9EC;
                border-radius: 5px;
                width: 8em;
                height: 2.5em;
                a {
                    color: #FFFFFF;
                }
            }
        }
    }
    .overflow {
        overflow: scroll;
        border-bottom: 2px solid #707070;
        height: 85%;
    }
    table {
        background: #FFFFFF 0% 0% no-repeat padding-box;
        border-collapse: inherit;
        margin-bottom: 0;
    }

    .title {
        background: #E46A00 0% 0% no-repeat padding-box;
        th {
            color: #FFFFFF;
            font-size: 17px;
            padding: 3px 10px;
        }
    }
    .main-content {
        line-height: 15px;
        font-size: 14px;
        td button {
            background: #FFFFFF 0% 0% no-repeat padding-box;
            box-shadow: 0px 1px 1px #00000029;
            border-radius: 5px;
        }
    }
    .main-content:nth-child(2n-1) {
        background: #E6D5CB 0% 0% no-repeat padding-box;
        border: 1px solid #FFFFFF;
    }
    .main-content:nth-child(2n) {
        background: #F1F6F3 0% 0% no-repeat padding-box;
        border: 1px solid #FFFFFF;
    }

    .notification-delete {
        background: #FFFFFF 0% 0% no-repeat padding-box;
        border: 1px solid #1492E6;
        border-radius: 13px;
        position: absolute;
        z-index: 1;
        bottom: 0px;
        justify-content: center;
        align-items: center;
        width: 65%;
        height: 140px;
        left: 255px;
        top: 350px;
        padding: 1em;
        font-size: 15px;
    }

    .table-notify {
        width: 100%;
        text-align: center;
    }
    .button-message button {
        border: none;
        background: #FFFFFF 0% 0% no-repeat padding-box;
    }
    .accept {
        border-right: 1px solid #707070 !important;
        width: 48%;
    }
    .cancel {
        width: 49%;
    }
    button {
        width: 100px;
    }
</style>
