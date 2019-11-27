<template>
    <section class="wrapper site-min-height">
        <section class="panel">
            <header class="panel-heading">Chỉnh sửa nhà cung cấp</header>
            <div class="panel-body" v-if="manufacture">
                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <div class="col-md-2">
                            <label for="name" class="label-size-20">Tên nhà cung cấp</label>
                        </div>
                        <div class="col-md-8">
                            <input
                                type="text"
                                id="name"
                                class="form-control label-size-19"
                                name="name" placeholder="Nhập tên nhà cung cấp"
                                v-model="manufacture.name" required
                            />
                            <p class="errMessage" v-if="errors.name">{{ errors.name[0]}}</p>

                        </div>
                    </div>
                </div>

                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <div class="col-md-2">
                            <label for="address" class="label-size-20">Địa chỉ</label>
                        </div>
                        <div class="col-md-8">
                            <input
                                type="text"
                                id="address"
                                class="form-control label-size-19"
                                name="address"  placeholder="Nhập địa chỉ"
                                v-model="manufacture.address"
                            />
                            <p class="errMessage" v-if="errors.address">{{ errors.address[0]}}</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <div class="col-md-2">
                            <label for="phone" class="label-size-20">Số điện thoại</label>
                        </div>
                        <div class="col-md-8">
                            <input
                                type="text"
                                id="phone"
                                class="form-control label-size-19"
                                name="ware_phone"  placeholder="Nhập số điện thoại"
                                v-model="manufacture.phone"
                            />
                            <p class="errMessage" v-if="errors.phone">{{ errors.phone[0]}}</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <div class="col-md-2">
                            <label for="email" class="label-size-20">Email</label>
                        </div>
                        <div class="col-md-8">
                            <input
                                type="text"
                                id="email"
                                class="form-control label-size-19"
                                name="email"  placeholder="Nhập địa chỏ email"
                                v-model="manufacture.email"
                            />
                            <p class="errMessage" v-if="errors.email">{{ errors.email[0]}}</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <div class="col-md-2">
                            <label for="fax" class="label-size-20">Fax</label>
                        </div>
                        <div class="col-md-8">
                            <input
                                type="text"
                                id="fax"
                                class="form-control label-size-19"
                                name="fax"  placeholder=""
                                v-model="manufacture.fax"
                            />
                            <p class="errMessage" v-if="errors.fax">{{ errors.fax[0]}}</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <button style="margin-left: 40%;" @click="handleCreate">Lưu</button>
                    </div>
                </div>
            </div>
        </section>
    </section>
</template>
<script>
    export default {
        name: "manu-edit",
        props: {
            manu_id: {type: Number, required: true},
        },
        data() {
            return {
                manufacture: null,
                errors: []
            };
        },
        created() {
            this.fetchManu();
        },
        methods: {
            fetchManu() {
                axios.get('/api/manufacturers/'+ this.manu_id)
                    .then(res => {
                        this.manufacture = res.data.data;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            handleCreate() {
                let formData = new FormData();
                formData.append("name", this.manufacture.name);
                formData.append("address", this.manufacture.address);
                formData.append("phone", this.manufacture.phone);
                formData.append("email", this.manufacture.email || '');
                formData.append("fax", this.manufacture.fax || '');
                formData.append("_method", 'PUT');
                axios.post("/api/manufacturers/"+ this.manu_id, formData)
                    .then(res => {
                        localStorage.setItem(res.data.message.status, res.data.message.content);
                        window.location.href = res.data.url;
                        this.errors = [];
                    })
                    .catch(error => {
                        console.log(error);
                        this.errors = error.response.data.error;

                    });
            }
        }
    };
</script>

<style lang="scss" scoped>
    .form-group-cs {
        padding-top: 20px;
    }
</style>
