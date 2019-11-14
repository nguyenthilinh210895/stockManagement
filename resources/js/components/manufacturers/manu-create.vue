<template>
    <section class="wrapper site-min-height">
        <section class="panel">
            <header class="panel-heading">Add Manufacturer</header>
            <div class="panel-body">
                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <div class="col-md-2">
                            <label for="name" class="label-size-20">Name</label>
                        </div>
                        <div class="col-md-8">
                            <input
                                type="text"
                                id="name"
                                class="form-control label-size-19"
                                name="name" placeholder="Name"
                                v-model="manufacture.name" required
                            />
                        </div>
                    </div>
                    <p class="errMessage" v-if="errors.name">{{ errors.name[0]}}</p>
                </div>

                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <div class="col-md-2">
                            <label for="address" class="label-size-20">Address</label>
                        </div>
                        <div class="col-md-8">
                            <input
                                type="text"
                                id="address"
                                class="form-control label-size-19"
                                name="address"  placeholder="Address"
                                v-model="manufacture.address"
                            />
                        </div>
                    </div>
                    <p class="errMessage" v-if="errors.address">{{ errors.address[0]}}</p>
                </div>
                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <div class="col-md-2">
                            <label for="phone" class="label-size-20">Phone</label>
                        </div>
                        <div class="col-md-8">
                            <input
                                type="text"
                                id="phone"
                                class="form-control label-size-19"
                                name="ware_phone"  placeholder="Phone number"
                                v-model="manufacture.phone"
                            />
                        </div>
                    </div>
                    <p class="errMessage" v-if="errors.phone">{{ errors.phone[0]}}</p>
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
                                name="email"  placeholder="Email"
                                v-model="manufacture.email"
                            />
                        </div>
                    </div>
                    <p class="errMessage" v-if="errors.email">{{ errors.email[0]}}</p>
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
                                name="fax"  placeholder="Fax"
                                v-model="manufacture.fax"
                            />
                        </div>
                    </div>
                    <p class="errMessage" v-if="errors.email">{{ errors.email[0]}}</p>
                </div>
                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <button style="margin-left: 40%;" @click="handleCreate">Save</button>
                    </div>
                </div>
            </div>
        </section>
    </section>
</template>
<script>
    export default {
        name: "manu-create",
        data() {
            return {
               manufacture: {
                   name: "",
                    address: "",
                    phone: "",
                    email: "",
                    fax: '',
                },
                errors: []
            };
        },
        methods: {
            handleCreate() {
                let formData = new FormData();
                formData.append("name", this.manufacture.name);
                formData.append("address", this.manufacture.address);
                formData.append("phone", this.manufacture.phone);
                formData.append("email", this.manufacture.email || '');
                formData.append("fax", this.manufacture.fax || '');

                axios.post("/api/manufacturers", formData)
                    .then(res => {
                        localStorage.setItem(res.data.message.status, res.data.message.content);
                        window.location.href = res.data.url;
                        this.errors = [];
                    })
                    .catch(error => {
                        console.log(this.error);
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
