<template>
    <section class="wrapper site-min-height">
        <section class="panel">
            <header class="panel-heading">Edit Item Group</header>
            <div class="panel-body">
                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <div class="col-md-2">
                            <label for="zone" class="label-size-20">Zone</label>
                        </div>
                        <div class="col-md-8">
                            <select
                                class="form-control cs-select-form"
                                id="zone"
                                name="zone"
                                v-model="groups.zone"
                            >
                                <option v-for="zone in zone" :value="zone.id">{{ zone.zone_code}}</option>
                            </select>
                            <p class="errMessage" v-if="errors.zone">{{ errors.zone[0]}}</p>
                        </div>
                    </div>
                </div>


                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <div class="col-md-2">
                            <label for="group_code" class="label-size-20">Item group Code</label>
                        </div>
                        <div class="col-md-8">
                            <input
                                type="text"
                                id="group_code"
                                class="form-control label-size-19"
                                name="group_code" placeholder="Item group Code"
                                v-model="groups.group_code" required
                            />
                            <p class="errMessage" v-if="errors.group_code">{{ errors.group_code[0]}}</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <div class="col-md-2">
                            <label for="group_name" class="label-size-20">Item group name</label>
                        </div>
                        <div class="col-md-8">
                            <input
                                type="text"
                                id="group_name"
                                class="form-control label-size-19"
                                name="group_name" placeholder="Item group name"
                                v-model="groups.group_name" required
                            />
                            <p class="errMessage" v-if="errors.group_name">{{ errors.group_name[0]}}</p>

                        </div>
                    </div>
                </div>


                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <button style="margin-left: 40%;" @click="handleEdit">Save</button>
                    </div>
                </div>
            </div>
        </section>
    </section>
</template>
<script>
    export default {
        name: "item-edit",
        props: {
            zone: { type: Array, required: true },
            group_id: {type: Number, required: true},
        },
        data() {
            return {
                groups: null,
                errors: []
            };
        },
        created(){
            this.fetchItemGroup();
        },
        methods: {
            fetchItemGroup() {
                axios.get('/api/items/'+ this.group_id)
                    .then(res => {
                        this.groups = res.data.data;
                        this.groups.zone = res.data.data.zone[0].id;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            handleEdit() {
                let formData = new FormData();
                formData.append("group_code", this.groups.group_code);
                formData.append("group_name", this.groups.group_name);
                formData.append("zone", this.groups.zone);
                formData.append("_method", 'PUT');
                axios.post("/api/items/"+ this.group_id, formData)
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
