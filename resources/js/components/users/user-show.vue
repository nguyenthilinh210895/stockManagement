<template>
    <section class="wrapper site-min-height" id="app">
        <notifications group="notifi" position="top left" />
        <section class="panel">
            <header class="panel-heading">
                Warehouse
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="btn-group">
                            <button id="editable-sample_new" class="btn green">
                                <a href="/warehouses/create">
                                    Add New <i class="fa fa-plus"></i>
                                </a>
                            </button>
                        </div>
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                        <tr>
                            <th>Employ_id</th>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>Birthday</th>
                            <th>Warehouse</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(user, index) in users">
                            <td>{{user.employee_id}}</td>
                            <td>{{user.fullname}}</td>
                            <td>{{user.email}}</td>
                            <td>{{user.phone_number}}</td>
                            <td>{{user.address}}</td>
                            <td>{{user.gender}}</td>
                            <td>{{user.birthday}}</td>
                            <td>{{user.warehouse_name}}</td>
                            <td><a :href="'/users/' +user.id+'/edit'"><i class="fa fa-edit" style="color:blue"></i> </a></td>
                            <td>
                                <i class="fa fa-trash-o"  style="color:red; cursor:pointer" @click="handleDelete(user,index)"></i>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="deleteContainer" v-if="deleteClicked"></div>
                <div class="notification-delete" v-if="deleteClicked">
                    <span>Do you want delete this employee？</span>
                    <div>
                        <table class="table-notify">
                            <tr class="show-infor">
                                <td>User Name：{{item.fullname || ''}}</td>
                            </tr>
                        </table>
                        <hr>
                    </div>
                    <div class="button-message">
                        <button class="accept" @click="DeleteWare">Delete</button>
                        <button class="cancel" @click="cancelDelete">Cancel</button>
                    </div>
                </div>

            </div>
        </section>
    </section>
</template>
<script>
    export default {
        name: 'user-show',
        data(){
            return {
                users: {},
                deleteClicked: false,
                item:'',
                index: 0,
                isActive: false,
            }
        },
        created(){
            axios.get('/api/users')
                .then(res => {
                    this.users = res.data.data;
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
            DeleteWare(index){
                axios.delete('/api/users/'+this.item.id)
                    .then(res => {
                        this.users.splice(this.index, 1)
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
    .adv-table table tr td{
        width: 25% !important;
    }
    .adv-table table tr :nth-child(5){
        width: 3% !important;
    }
    .adv-table table tr :nth-child(6){
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
</style>
