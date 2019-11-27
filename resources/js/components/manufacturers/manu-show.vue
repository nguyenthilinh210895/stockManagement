<template>
    <section class="wrapper site-min-height" id="app">
        <notifications group="notifi" position="top left" />
        <section class="panel">
            <header class="panel-heading">
                Nhà cung cấp
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="btn-group">
                            <button id="editable-sample_new" class="btn green">
                                <a href="/manager/manufacturers/create">
                                   Thêm mới <i class="fa fa-plus"></i>
                                </a>
                            </button>
                        </div>
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                        <tr>
                            <th>Tên nhà cung cấp</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Fax</th>
                            <th>Chỉnh sửa</th>
                            <th>Xóa</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(manu, index) in manufacturers">
                            <td>{{manu.name}}</td>
                            <td>{{manu.address}}</td>
                            <td>{{manu.phone}}</td>
                            <td>{{manu.email}}</td>
                            <td>{{manu.fax}}</td>
                            <td><a :href="'/manager/manufacturers/'+ manu.id+'/edit'">
                                <i class="fa fa-edit" style="color:blue"></i></a></td>
                            <td>
                                <i class="fa fa-trash-o"  style="color:red; cursor:pointer" @click="handleDelete(manu,index)"></i>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="deleteContainer" v-if="deleteClicked"></div>
                <div class="notification-delete" v-if="deleteClicked">
                    <span>Bạn có chắc muốn xóa nhà cung cấp này？</span>
                    <div>
                        <table class="table-notify">
                            <tr class="show-infor">
                                <td>Tên nhà cung cấp：{{item.name || ''}}</td>
                            </tr>
                        </table>
                        <hr>
                    </div>
                    <div class="button-message">
                        <button class="accept" @click="DeleteManu">Xóa</button>
                        <button class="cancel" @click="cancelDelete">Hủy</button>
                    </div>
                </div>

            </div>
        </section>
    </section>
</template>
<script>
    export default {
        name: 'manu-show',
        data(){
            return {
                manufacturers: {
                   name: '',
                    address: '',
                    phone: '',
                    email: '',
                    fax: '',
                },
                editButton: 'Edit',
                deleteButton: 'Delete',
                deleteClicked: false,
                item:'',
                index: 0,
                isActive: false,
            }
        },
        created(){
            axios.get('/api/manufacturers')
                .then(res => {
                    this.manufacturers = res.data.data;
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
            classObject: function () {isActive
                return {
                    active: this.isActive,
                }
            },
            cancelDelete(){
                return this.deleteClicked = false;
            },
            DeleteManu(index){
                axios.delete('/api/manufacturers/'+this.item.id)
                    .then(res => {
                        this.manufacturers.splice(this.index, 1)
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
</style>
