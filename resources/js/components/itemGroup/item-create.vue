<template>
    <section class="wrapper site-min-height" id="app">
        <notifications group="notify" position="top left" />
        <section class="panel">
            <header class="panel-heading">Add Item Group</header>
            <div class="panel-body">
                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <div class="col-md-2">
                            <label for="warehouse" class="label-size-20">Zone</label>
                        </div>
                        <div class="col-md-8">
                            <select
                                class="form-control cs-select-form"
                                id="warehouse"
                                name="warehouse"
                                v-model="group.zone"
                            >
                                <option v-for="zone in zone" :value="zone.id">{{ zone.zone_code }}</option>
                            </select>
                        </div>
                    </div>
                    <!--          <p class="errMessage" v-if="errors.warehouse_name">{{ errors.name[0]}}</p>-->
                </div>

                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <div class="col-md-2">
                            <label for="group_code" class="label-size-20">Group Code</label>
                        </div>
                        <div class="col-md-8">
                            <input
                                type="text"
                                id="group_code"
                                class="form-control label-size-19"
                                name="group_code" placeholder="Group Code"
                                v-model="group.group_code" required
                            />
                        </div>
                    </div>
                    <p class="errMessage" v-if="errors.group_code">{{ errors.group_code[0]}}</p>
                </div>

                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <div class="col-md-2">
                            <label for="group_name" class="label-size-20">Group name</label>
                        </div>
                        <div class="col-md-8">
                            <input
                                type="text"
                                id="group_name"
                                class="form-control label-size-19"
                                name="group_name" placeholder="Group Name"
                                v-model="group.group_name" required
                            />
                        </div>
                    </div>
                    <p class="errMessage" v-if="errors.group_code">{{ errors.zone_code[0]}}</p>
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
        name: "item-create",
        props: {
            zone: { type: Array, required: true },
        },
        data() {
            return {
                group: {
                    group_code: '',
                    group_name: '',
                },
                errors: []
            };
        },
        methods: {
            handleCreate() {
                let formData = new FormData();
                formData.append("group_code", this.group.group_code);
                formData.append("group_name", this.group.group_name);
                formData.append("zone", this.group.zone);
                axios.post("/api/items", formData)
                    .then(res => {
                        localStorage.setItem(res.data.message.status, res.data.message.content);
                        window.location.href = res.data.url;
                        this.errors = [];
                    })
                    .catch(error => {
                        console.log(this.error);
                        this.errors = error.response.data.errors;

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
