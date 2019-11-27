<template>
    <section class="wrapper site-min-height">
        <section class="panel">
            <header class="panel-heading">
               Chỉnh sửa khu vực
            </header>
            <div class="panel-body" v-if="area">
                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <div class="col-md-2">
                            <label for="area_code" class="label-size-20">Mã khu vực</label>
                        </div>
                        <div class="col-md-8">
                            <input
                                type="text"
                                id="area_code"
                                class="form-control label-size-19"
                                name="area_code" placeholder="Nhập vào mã khu vực"
                                v-model="area.area_code"
                            />
                            <p class="errMessage" v-if="errors.area_code">{{ errors.area_code[0]}}</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <div class="col-md-2">
                            <label for="name" class="label-size-20">Tên khu vực</label>
                        </div>
                        <div class="col-md-8">
                            <input
                                type="text"
                                id="name"
                                class="form-control label-size-19"
                                name="area_name" placeholder="Nhập vào tên khu vực"
                                v-model="area.area_name"
                            />
                            <p class="errMessage" v-if="errors.area_name">{{ errors.area_name[0]}}</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-11 offset-1 clearfix">
                    <div class="form-group-cs d-flex">
                        <button style="margin-left: 40%;" @click="handleEdit">Lưu</button>
                    </div>
                </div>
            </div>
        </section>
    </section>
</template>
<script>
    export default {
        name: 'area-edit',
        props: {
            area_id: {type: Number, require: true},
        },
        data(){
            return {
                area: null,
                errors: [],
            }
        },
        created() {
            this.fetchArea();
        },
        methods: {
            fetchArea(){
                axios.get('/api/areas/'+this.area_id)
                    .then(res=>{
                        this.area = res.data.data;
                    })
                    .catch(error=>{
                        console.log(error);
                    });
            },
            handleEdit(){
                let formData = new FormData();
                formData.append('area_code', this.area.area_code);
                formData.append('area_name', this.area.area_name);
                formData.append('_method', 'PUT');
                axios.post('/api/areas/'+this.area_id, formData)
                    .then(res => {
                        localStorage.setItem(res.data.message.status, res.data.message.content);
                        window.location.href = res.data.url;
                        this.errors = [];
                    })
                    .catch(error => {
                        this.errors = error.response.data.error;

                    });
            }
        }

    }
</script>

<style lang="scss" scoped>
    .form-group-cs {
        padding-top: 20px;
    }
</style>
