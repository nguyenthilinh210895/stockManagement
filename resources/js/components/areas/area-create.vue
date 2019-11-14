<template>
<section class="wrapper site-min-height">
              <section class="panel">
                  <header class="panel-heading">
                    Add Area
                  </header>
                  <div class="panel-body">
                      <div class="col-md-11 offset-1 clearfix">
                          <div class="form-group-cs d-flex">
                              <div class="col-md-2">
                                  <label for="area_code" class="label-size-20">Code</label>
                              </div>
                              <div class="col-md-8">
                                  <input
                                      type="text"
                                      id="area_code"
                                      class="form-control label-size-19"
                                      name="area_code" placeholder="Area Code"
                                      v-model="area.area_code"
                                  />
                              </div>
                          </div>
                          <p class="errMessage" v-if="errors.area_code">{{ errors.area_code[0]}}</p>
                      </div>
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
                                      name="area_name"  placeholder="Area Name"
                                      v-model="area.area_name"
                                  />
                              </div>
                          </div>
                          <p class="errMessage" v-if="errors.area_name">{{ errors.area_name[0]}}</p>
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
        name: 'area-create',
        data(){
            return {
                area:{
                    area_code: '',
                    area_name: ''
                },
                errors: [],

            }
        },
        methods: {
            handleCreate(){
                let formData = new FormData();
                formData.append('area_code', this.area.area_code);
                formData.append('area_name', this.area.area_name);
                axios.post('/api/areas', formData)
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
