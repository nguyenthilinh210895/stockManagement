<template>
    <section class="wrapper">
        <!-- page start-->
        <div class="row" v-if="user">
            <aside class="profile-nav col-lg-3">
                <section class="panel">
                    <div class="user-heading round">
<!--                        <input type="hidden" name="csrf" value="csrf">-->
<!--                        <input type="hidden" name="_method" >-->
<!--                        <input type="file" name="image" ref="file" v-on:change="handleFileUpload()""  >-->
<!--                        <img src="img/profile-avatar.jpg" alt="">-->
                            <img src="/img/profile-avatar.jpg" alt="Update Avatar" class="icon-svg icon-add">
                        <img v-if="user.image_url " :src="user.image_url" class="photo-menu" :class="{preview: false}">
                        <h1>Jonathan Smith</h1>
                        <p>jsmith@flatlab.com</p>
                    </div>
                    <span class="label-size-33 label-add-new-image"
                          style="padding-left: 35%;color: blue;font-weight: 600;">Change Avatar</span>
                    <input type="file" name="photo" v-on:change="handleSelectFile" class="mouse" ref="file">
                </section>
            </aside>
            <aside class="profile-info col-lg-9">
                <section class="panel">
                    <div class="bio-graph-heading">
                        Your personal information is below. Please update the information when there is a change.
                    </div>
                    <div class="panel-body bio-graph-info">
                        <h1> Profile Info</h1>
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label  class="col-lg-2 control-label">Full Name</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="f-name" placeholder=" ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-lg-2 control-label">Address</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="c-name" placeholder=" ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-lg-2 control-label">Birthday</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="b-day" placeholder=" ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-lg-2 control-label">Gender</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="occupation" placeholder=" ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-lg-2 control-label">Email</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="email" placeholder=" ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-lg-2 control-label">Phone</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="phone" placeholder=" ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-lg-2 control-label">Warehouse</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="warehouse" placeholder=" ">
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-md-3 mixin-label">
                                    <div class="row">
                                        <div class="col-md-9 label-input">Set Password</div>
                                    </div>
                                </label>
                                <div class="col-md-9">
                                    <input class="radio-edit" type="radio" name="editPassword" v-model="required" :value="false" checked> Unchanged
                                    <input class="radio-edit" type="radio" name="editPassword" v-model="required" :value="true"> Change
                                </div>
                            </div>
                            <section v-if="required">
                                <div class="panel panel-primary">
                                    <div class="panel-heading"> Sets New Password & Avatar</div>
                                    <div class="panel-body">
                                        <form class="form-horizontal" role="form">
                                            <div class="form-group">
                                                <label  class="col-lg-2 control-label">Current Password</label>
                                                <div class="col-lg-6">
                                                    <input type="password" class="form-control" id="c-pwd" placeholder=" ">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label  class="col-lg-2 control-label">New Password</label>
                                                <div class="col-lg-6">
                                                    <input type="password" class="form-control" id="n-pwd" placeholder=" ">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label  class="col-lg-2 control-label">Re-type New Password</label>
                                                <div class="col-lg-6">
                                                    <input type="password" class="form-control" id="rt-pwd" placeholder=" ">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </section>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <button type="button" class="btn btn-default">Cancel</button>
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
        props:{
            user: {type:Object, required: true},
        },
        name: "user-profile",
        data(){
            return {
                email: '',
                isActive: true,
                file: '',
                users: null,
                required:false,
                password:{
                    old:'',
                    new:'',
                    re_new:''
                },
                errors: [],
            }
        },
        created() {
            axios.get('/api/showProfile/' + this.user.email)
                .then(res => {
                    this.users = res.data.data;
                    console.log(this.user);
                });
        },
        methods: {
            handleSelectFile(event) {
                this.file = this.$refs.file.files[0];
                let reader = new FileReader();
                reader.addEventListener("load", function () {
                    this.user.image_url  = {'url': reader.result};
                }.bind(this), false);
                if (this.file) {
                    if (/\.(jpe?g|svg|png|gif)$/i.test(this.file.name)) {
                        reader.readAsDataURL(this.file);
                    }
                }
                this.isActive = false;
            },

            editAccount() {
                var formData = new FormData();
                //Add the form data we need to submit
                formData.append('id', this.user_info.id);
                formData.append('fullname', this.user_info.fullname);
                formData.append('katakana_name', this.user_info.katakana_name || '');
                formData.append('address', this.user_info.address || '');
                formData.append('phone_number', this.user_info.phone_number);
                formData.append('department', this.user_info.department || '');
                formData.append('email', this.user_info.email);
                formData.append("image", this.photos);
                if(this.required == true){
                    formData.append("old_password", this.password.old);
                    formData.append("new_password", this.password.new);
                    formData.append("retype_password", this.password.re_new);
                }

                //Make the request to the POST
                axios({
                    method: 'post',
                    url: '/user/edit-account',
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

    .preview {
        display: none;
    }

</style>

