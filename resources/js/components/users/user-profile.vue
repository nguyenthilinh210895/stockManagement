<template>
    <section class="wrapper">
        <!-- page start-->
        <div class="row" v-if="user">
            <aside class="profile-nav col-lg-3">
                <section class="panel">
                    <div class="row content-cs031">
                        <div class="col-md-12">
                            <div class="wrap-store">
                                <div class="pseudo-table label-size-22">
                                    <div class="feature-image float-right">
                                        <div class="icon-link">
                                            <img src="/img/account.png" alt="Update Avatar" class="default_avatar"/>
                                            <img :src="user.image_url" class="preview" v-show="showPreview">
<!--                                            <span class="label-size-33 label-add-new-image">写真 追加</span>-->
                                            <label for="file" class="btn btn-primary btn-block btn-outlined">Thay đổi Avatar</label>
                                            <input type="file" name="photo" id="file" ref="file"
                                                   @change=" previewImage" style="display: none">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            </aside>
            <aside class="profile-info col-lg-9">
                <section class="panel">
                    <div class="bio-graph-heading">
                        Đây là thông tin cá nhân của bạn. Vui lòng sửa lại khi thông tin của bạn có sự thay đổi.
                    </div>
                    <div class="panel-body bio-graph-info">
                        <h1> Profile Info</h1>
                        <form class="form-horizontal" role="form" onsubmit="return false;">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Mã nhân viên</label>
                                <div class="col-lg-6">
                                    <input type="text" name="employee_id" v-model="user.employee_id"
                                           class="form-control" id="f-name" placeholder=" ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Họ và tên</label>
                                <div class="col-lg-6">
                                    <input type="text" name="fullname" v-model="user.fullname" class="form-control"
                                           id="fullname" placeholder=" ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Địa chỉ</label>
                                <div class="col-lg-6">
                                    <input type="text" name="address" v-model="user.address" class="form-control"
                                           id="address" placeholder=" ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Ngày sinh</label>
                                <div class="col-lg-6">
                                    <input type="text" name="birthday" v-model="user.birthday" class="form-control"
                                           id="b-day" placeholder=" ">
                                </div>
                            </div>
                            <!--                            <div class="form-group">-->
                            <!--                                <label  class="col-lg-2 control-label">Gender</label>-->
                            <!--                                <div class="col-lg-6">-->
                            <!--                                    <input type="text" name="gender" v-model="users.gender" class="form-control" id="gender" placeholder=" ">-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Email</label>
                                <div class="col-lg-6">
                                    <input type="text" name="email" v-model="user.email" class="form-control" id="email"
                                           placeholder=" ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Số điện thoại </label>
                                <div class="col-lg-6">
                                    <input type="text" name="phone_number" v-model="user.phone_number"
                                           class="form-control" id="phone" placeholder=" ">
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-md-3 mixin-label">
                                    <div class="row">
                                        <div class="col-md-9 label-input">Thay đổi mật khẩu</div>
                                    </div>
                                </label>
                                <div class="col-md-9">
                                    <input class="radio-edit" type="radio" name="editPassword" v-model="required"
                                           :value="false" checked> Không đổi
                                    <input class="radio-edit" type="radio" name="editPassword" v-model="required"
                                           :value="true"> Thay đổi
                                </div>
                            </div>
                            <section v-if="required">
                                <div class="panel panel-primary">
                                    <div class="panel-heading"> Thay đổi mật khẩu</div>
                                    <div class="panel-body">
                                        <form class="form-horizontal" role="form">
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Mật khẩu hiện tại</label>
                                                <div class="col-lg-6">
                                                    <input type="password" name="old_password" v-model="password.old"
                                                           class="form-control" id="c-pwd"
                                                           placeholder="Nhập mật khẩu hiện tại">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Mật khẩu mới</label>
                                                <div class="col-lg-6">
                                                    <input type="password" name="new_password" v-model="password.new"
                                                           class="form-control" id="n-pwd"
                                                           placeholder="Nhập mật khẩu mới ">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Nhập lại mật khẩu mới</label>
                                                <div class="col-lg-6">
                                                    <input type="password" name="retype_password"
                                                           v-model="password.re_new" class="form-control" id="rt-pwd"
                                                           placeholder="Nhập lại mật khẩu mới ">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </section>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button @click="editAccount" class="btn btn-success">Chỉnh sửa</button>
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
        props: {
            users: {type: Object, required: true},
        },
        name: "user-profile",
        data() {
            return {
                email: '',
                showPreview: false,
                file: '',
                user: null,
                required: false,
                password: {
                    old: '',
                    new: '',
                    re_new: ''
                },
                errors: [],
            }
        },
        created() {
            axios.get('/api/showProfile/' + this.users.email)
                .then(res => {
                    this.user = res.data.data;
                    console.log(this.user);
                });
        },
        methods: {
            previewImage() {
                this.file = this.$refs.file.files[0];
                let reader = new FileReader();
                reader.addEventListener("load", function () {
                    this.showPreview = true;
                    this.user.image_url = reader.result;
                }.bind(this), false);
                if (this.file) {
                    if (/\.(jpe?g|png|gif)$/i.test(this.file.name)) {
                        reader.readAsDataURL(this.file);
                    }
                }
            },
            editAccount() {
                var formData = new FormData();
                //Add the form data we need to submit
                formData.append('id', this.user.id);
                formData.append('fullname', this.user.fullname);
                formData.append('address', this.user.address || '');
                formData.append('phone_number', this.user.phone_number);
                formData.append('birthday', this.user.birthday || '');
                formData.append('email', this.user.email);
                formData.append("image_url", this.file);
                formData.append("employee_id", this.user.employee_id);
                formData.append("warehouse_id", this.user.warehouse_id);
                if (this.required == true) {
                    formData.append("old_password", this.password.old);
                    formData.append("new_password", this.password.new);
                    formData.append("retype_password", this.password.re_new);
                }

                //Make the request to the POST
                axios({
                    method: 'post',
                    url: '/api/edit-account',
                    data: formData,
                    headers: {'content-type': 'multipart/form-data'}
                })
                    .then(res => {
                        localStorage.setItem(res.data.message.status, res.data.message.content);
                        window.location.reload();
                        //         this.$notify({
                        //           group: "notification",
                        //           type: res.data.message.status,
                        //           text: res.data.message.content,
                        //           duration: 5000
                        //       });
                        //       $(".main-panel").scrollTop(0);
                    })
                    .catch((error) => {
                        this.errors = error.response.data.error;
                    });
            }
        }


    }
</script>

<style scoped>
    .mouse {
        cursor: pointer;
    }
    /*.default_avatar, preview {*/
    /*    position: relative;*/
    /*}*/
    .preview {
        z-index: 1000;
        position: relative;
        width: 250px;
        height: 280px;
        margin-top: -3px;
        margin-left: -3px;
        border: none;

    }
    .default_avatar {
        z-index: -1;
        position: absolute;
    }

    img {
        width: 250px;
        height: 280px;
    }

    label {
        font-size: 15px;
        margin-left: 3px;
        margin-top: -1px;
        text-align: center;
        font-weight: 400;

    }


</style>

