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
                            <th style="text-align: center !important;">Unit name</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(i, index) in unit">
                            <td> <input
                                type="text"
                                id="quality"
                                class="form-control label-size-19"
                                name="quality_name"  placeholder="Quality Name"
                                v-model="unit.unit_name = i.unit_name"
                            /></td>
                            <td>
                                <i class="fa fa-check-circle" style="color:blue; cursor:pointer" @click="saveUnit"></i>
                           </td>
                            <td>
                                <i class="fa fa-trash" style="color:red;cursor:pointer" @click="removeQuality(index)"></i>
                          </td>
                        </tr>
                        <tr v-for="(unit, k) in units">
                            <td>{{unit.unit_name}}</td>
                            <td>  <i class="fa fa-trash-o" style="color:red; cursor:pointer"@click="Delete(unit,k)"></i></td>
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
        name: 'calculation-create',
        data(){
            return {
                units: [],
                unit: [],
                k:0,
                index: 0,
                item: '',
            }
        },
        created(){
            axios.get('/api/calculations')
                .then(res => {
                    this.units = res.data.data;
                }).catch(error => {
                console.log(error);
            });
        },
        methods:{
            removeQuality(index){
                this.unit.splice(index, 1);
            },
            addQuality(index){
                this.unit.push({unit_name: ''});
            },
            saveUnit(){
                let formData = new FormData();
                formData.append('unit_name', this.unit.unit_name);
                axios.post('/api/calculations', formData)
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
                axios.delete('/api/calculations/'+this.item.id)
                    .then(res => {
                        this.units.splice(this.k, 1)
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
        width: 50% !important;
    }
    .adv-table table tr :nth-child(2){
        width: 3% !important;
    }

</style>
