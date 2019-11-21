<template>
    <section class="wrapper site-min-height" id="app">
        <notifications group="notifi" position="top left" />

        <section class="panel">
            <header class="panel-heading">
                Quality
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="btn-group">
                            <button @click="addQuality"
                                id="editable-sample_new" class="btn green">
                                    Add New <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                        <tr>
                            <th>Quality name</th>
                            <th>Quality code</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(i, index) in quality">
                            <td> <input
                                type="text"
                                id="quality"
                                class="form-control label-size-19"
                                name="quality_name"  placeholder="Quality Name"
                                v-model="quality.quality_name = i.quality_name"
                            /></td>
                            <td>
                                <input
                                    type="text"
                                    id="quality_code"
                                    class="form-control label-size-19"
                                    name="quality_code"  placeholder="Quality code"
                                    v-model="quality.quality_code = i.quality_code "
                                />
                            </td>
                            <td>
                                <i @click="saveQuality" class="fa fa-check-circle" style="color:blue;cursor:pointer"></i>
                            </td>
                            <td>
                                <i @click="removeQuality(index)" class="fa fa-remove" style="color:red;cursor:pointer"></i>
                            </td>
                        </tr>
                        <tr v-for="(qual, k) in qualitys">
                            <td>{{qual.quality_name}}</td>
                            <td>{{qual.quality_code}}</td>
                            <td>
                                <i class="fa fa-trash-o"  style="color:red; cursor:pointer"  @click="Delete(qual,k)"></i>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </section>

</template>
<script>
    export default {
        name: 'quality-create',
        data(){
            return {
                qualitys: [],
                quality: [],
                k:0,
                index: 0,
                item: '',
            }
        },
        created(){
            axios.get('/api/qualitys')
                .then(res => {
                    this.qualitys = res.data.data;
                }).catch(error => {
                console.log(error);
            });
        },
        methods:{
            removeQuality(index){
                this.quality.splice(index, 1);
            },
            addQuality(index){
                    this.quality.push({quality_name: '',quality_code: ''});
            },
            saveQuality(){
                let formData = new FormData();
                formData.append('quality_code', this.quality.quality_code);
                formData.append('quality_name', this.quality.quality_name);
                axios.post('/api/qualitys', formData)
                    .then(res => {
                        localStorage.setItem(res.data.message.status, res.data.message.content);
                        window.location.href = res.data.url;
                        this.errors = [];
                    })
                    .catch(error => {
                        this.errors = error.response.data.error;
                    });
            },
            Delete(item,k){
                this.item = item;
                this.k = k;
                axios.delete('/api/qualitys/'+this.item.id)
                    .then(res => {
                        this.qualitys.splice(this.k, 1)
                        this.$notify({
                            group: "notifi",
                            type: 'success',
                            text: res.data.message.content,
                            duration: 6000
                        });
                    }).catch(error => {
                    console.log(error);
                });
            }
        }

    }
</script>

<style lang="scss" scoped>
    .adv-table{
        width: 70% !important;
    }
    .adv-table table tr td{
        width: 30% !important;
    }
    .adv-table table tr :nth-child(3){
        width: 3% !important;
    }
    .adv-table table tr :nth-child(4){
        width: 3% !important;
    }

</style>
